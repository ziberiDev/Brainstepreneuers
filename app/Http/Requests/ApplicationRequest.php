<?php

namespace App\Http\Requests;

use App\Models\ProjectApplication;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
        $users = ProjectApplication::where('project_id', request('project_id'))->get('user_id');
        $newA = array_reduce(collect($users)->toArray(), function ($new, $item) {
            $new[] = $item['user_id'];
            return $new;
        });
        return [
            'user_id' => Rule::notIn($newA),
            'message' => 'required|string|min:10|max:200'
        ];
    }

    public function messages()
    {
        return [
            'user_id.not_in' => 'You have alredy applied'
        ];
    }
}
