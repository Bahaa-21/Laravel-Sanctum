<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequset extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => "sometimes|email|string",
            'phone_number' => "sometimes|string",
            'password' => "required|min:10"
        ];
    }
}
