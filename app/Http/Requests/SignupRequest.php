<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{

    public function rules(): array
    {

        return [
            'username' => 'required|string|max:255|unique:users',
            'email' => "required|email|string|unique:users",
            'phone_number' => "required|min:10",
            'password' => "required|min:10",
            'c_password' => "required|same:password",
            'profile_photo' => 'sometimes|image|mimes:png,jpg,jpeg|max:2048',
            'certificate' => 'sometimes|file|mimes:pdf|max:2048'
        ];
    }
}
