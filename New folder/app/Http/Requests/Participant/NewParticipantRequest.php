<?php

namespace App\Http\Requests\Participant;

use Illuminate\Foundation\Http\FormRequest;

class NewParticipantRequest extends FormRequest
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
            'fullName' => 'required',
            'email' => 'required|email|unique:participants,email',
            'avatar' =>  'sometimes|mimes:jpg,jpeg,png|max:300',
            'contactNumber' => 'required|digits:11|unique:participants,contactNumber',
            'address' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'password' => 'required|min:6',
        ];
    }
}