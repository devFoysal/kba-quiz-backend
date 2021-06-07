<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class NewQuestionRequest extends FormRequest
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
            'thumbnail' => 'required|file|max:350|mimes:jpeg,jpg,png,gif',
            'thumbnail_bn' => 'required|file|max:350|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
        ];
    }
}
