<?php

namespace Robust\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'first_name' => 'required| min:1',
            'last_name' => 'required| min:1',
            'user_name' => 'required| min:1',
            'email' => 'required| min:1 |unique:users'.$this->route('users'),
            'role' => 'required',
            'password'=>['required','confirmed'],
            'password_confirmation'=>'required'
        ];
    }
}
