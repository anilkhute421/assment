<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            "user_id" => 'required|exists:users,id',
            "name" => 'required|min:3',
            "email" => 'required|email',
            "password" => 'required|min:6',
            "building_no"  => 'required',
            "street_name"  => 'required',
            "city"  => 'required',
            "state"  => 'required',
            "country"  => 'required',
            "pincode"  => 'required',
        ];
    }
}
