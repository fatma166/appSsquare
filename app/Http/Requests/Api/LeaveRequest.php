<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Http\Exceptions\HttpResponseExeption;
use Validator;
use Illuminate\Support\Facades\Auth;
class LeaveRequest extends FormRequest
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
            //
            'leave_from'=>'required|after:yesterday|date_format:Y-m-d H:i:s',
            'leave_to'=>'required|after_or_equal:from|date_format:Y-m-d H:i:s',
        ];
    }
   /* public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success' => false,

            'message' => 'Validation errors',

            'data' => $validator->errors()

        ]));

    }*/
}
