<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Route;

class UpdateEmployee extends FormRequest
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

        $id = Route::input('employee');
        return [
            'first_name' => 'required|string|min:3|max:190',
            'last_name' => 'required|string|min:3|max:190',
            'company' => 'required|integer|min:1',
            'email' => ['nullable','email',Rule::unique('employees', 'email')->ignore($id)],
            'phone' => ['nullable','numeric','digits_between:9,13',Rule::unique('employees', 'phone')->ignore($id)],
        ];
    }
}
