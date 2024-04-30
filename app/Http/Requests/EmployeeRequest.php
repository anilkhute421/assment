<?php

namespace App\Http\Requests;

use App\Helper\CommonHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => 'required|min:3',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:6',
            "building_no"  => 'required',
            "street_name"  => 'required',
            "city"  => 'required',
            "state"  => 'required',
            "country"  => 'required',
            "pincode"  => 'required',
        ];
    }
    
    public function faildValidation(Validator $validator){
      
        CommonHelper::sendError('validation error' , $validator->errors());

    }
}
