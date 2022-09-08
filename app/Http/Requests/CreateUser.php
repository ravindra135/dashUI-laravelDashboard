<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|min:5',
            'email'     => 'required|unique:users',
            'username'  => 'unique:users,username|string|nullable|min:4',
            'password'  => 'required|min:5|confirmed',
        ];
    }
}
