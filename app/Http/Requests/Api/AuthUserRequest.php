<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Http\Exceptions\HttpResponseExeption;
use Validator;
use Illuminate\Support\Facades\Auth;
class AuthUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   /* public function authorize()
    {
        return true;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email'=>'required',
            'password'=>'required|min:6'
        ];
    }

   /* public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success' => false,

            'message' => 'Validation errors',

            'data' => $validator->errors()

        ]));

    }


    public function messages()

    {

        return [
            'username.required'=>'username required',
            'password.required'=>'password required'

        ];
    }*/

}
