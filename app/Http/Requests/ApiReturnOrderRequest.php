<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class ApiReturnOrderRequest extends FormRequest
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
            'id'=>'required',
            'reason'=>'required',
            'comment'=>'required',
            'aggree'=>'required',
            'no_of_item'=>'required|int'
        ];
    }

    public function failedValidation(Validator $validate)
    {
        throw new HttpResponseException(response()->json(
            [
                'error'=>true,
                'msg'=>'Validation Error !!',
                'errors'=>$validate->errors()
            ]
        ));
    }
}
