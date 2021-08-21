<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'accademy_id'  => 'required|exists:accademies,id',
            'biography' => 'required|string|min:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'email'  => 'required|string|email',
            'password' => 'required|string|min:8',
        ];
    }
}
