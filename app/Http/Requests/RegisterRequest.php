<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            "username" => ["required", "min:4", "max:12", Rule::unique('users', 'username')],
            "email" => ["required", 'email', Rule::unique('users', 'email')],
            "password" => ["required", "min:4"],
            "cpassword" => ["required", "min:4", "same:password"],
        ];
    }
    public function messages() {
        return [
            "username.required" => "The username field is required.",
            "username.min" => "The username must be at least :min characters.",
            "username.max" => "The username may not be greater than :max characters.",
            "username.unique" => "The username is already taken.",
            "email.required" => "The email field is required.",
            "email.email" => "Please enter a valid email address.",
            "email.unique" => "The email address is already taken.",
            "password.required" => "The password field is required.",
            "password.min" => "The password must be at least :min characters.",
            "password.confirmed" => "The passwords do not match.",
            "cpassword.required" => "The confirm password field is required.",
            "cpassword.min" => "The confirm password must be at least :min characters.",
            "cpassword.same" => "The passwords do not match",
        ];
    }
}
