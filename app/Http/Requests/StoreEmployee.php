<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
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
            'first_name' => 'string|required|min:3|max:190',
            'last_name' => 'string|required|min:3|max:190',
            'company' => 'required|integer|min:1',
            'email' => 'nullable|email|unique:employees,email',
            'phone' => 'nullable|numeric|digits_between:9,13|unique:employees,phone'
        ];
    }
}
