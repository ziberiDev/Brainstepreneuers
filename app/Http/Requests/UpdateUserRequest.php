<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:13|min:3',
            'last_name'  => 'nullable|string|max:13|min:3',
            'accademy_id'  => 'nullable|exists:accademies,id',
            'biography' => 'nullable|string|min:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'email'  => 'nullable|string|email',
            'skills|*' => 'nullable|exists:skills,id|min:5|max:10',
        ];
    }
}
