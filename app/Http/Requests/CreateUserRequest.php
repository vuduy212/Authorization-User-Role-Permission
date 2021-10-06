<?php

namespace App\Http\Requests;

use App\Rules\StrLengthRule;
use App\Rules\SuperRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => [
                'required',
                new StrLengthRule()
            ],
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ];
    }
}
