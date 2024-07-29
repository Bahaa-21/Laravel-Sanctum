<?php

namespace App\Repository;

use App\Enum\TokenAbility;
use App\Events\UserRegistered;
use App\Models\User;
use App\Helper\Qs;
use App\InterfaceRepository;
use App\InterfaceRepository\InterfaceAuthRepository;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements InterfaceAuthRepository
{

    public function register($file, $image_path, $data)
    {
        if ($data) {
            // create user
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'password' => Hash::make($data['password']),
                'certificate' => $file,
                'profile_photo' => $image_path,
            ]);
            //generate access Token
            $token = $user->createToken('access_token')->plainTextToken;
            //event for send a code for the email
            event(new UserRegistered($user));
            return Qs::api_response(true, 200, "Register Successfully , Plaese verify your email.", ['user' => $user, 'token' => $token]);
        }
        return Qs::api_response(false, 422, "Bad Request", []);
    }

    public function login($data)
    {
        if (Auth::attempt($data)) {
            $user = Auth::user();

            //generate access token
            $accessToken = $user->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));
            //generate refresh token
            $refershToken = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinute(config('sanctum.rt_expiration')));
            return Qs::api_response(
                true,
                200,
                "login successfully",
                [
                    'user' => $user,
                    'token' => $accessToken->plainTextToken,
                    'refershToken' => $refershToken->plainTextToken
                ]
            );
        }
        return Qs::api_response(false, 422, "Bad Request", []);
    }
}
