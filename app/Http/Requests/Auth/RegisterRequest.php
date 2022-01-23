<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email'    => 'required|string|email|max:255|unique:users,email',
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:255',
            'password' => 'required|string|min:8|max:8|confirmed',
        ];
    }

    public function register() {
        $user = User::where('phone',$this->phone)->first();

        $user->update($this->validated());

        return $user;
    }
}
