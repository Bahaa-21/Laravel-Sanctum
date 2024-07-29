<?php

namespace App\Http\Controllers\Api\auth;

use App\Enum\TokenAbility;
use App\Helper\Qs;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequset;
use App\Http\Requests\SignupRequest;
use App\InterfaceRepository\InterfaceAuthRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class AuthController extends Controller
{
    protected $authRepo;
    public function __construct(InterfaceAuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function login(LoginRequset $request)
    {
        $data = $request->validated();
        return $this->authRepo->login($data);
    }

    //*/api/register
    public function register(SignupRequest $request)
    {

        $data = $request->validated();
        $file_path = $request->file('certificate')->store('Uplaods', 'public');
        $image_path = $request->file('profile_photo')->store('Uplaods', 'public');
        return $this->authRepo->register($file_path, $image_path, $data);
    }

    public function refreshToken(Request $request)
    {
        $ac_token = $request->user()->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));
        return Qs::api_response(true, 200, "Token generate", ['access Token' => $ac_token]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($request->user()->token()->id);
        return response()->json('Logged out successfully', 200);
    }
}
