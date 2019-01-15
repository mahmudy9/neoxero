<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Route;

class UpdateCompany extends FormRequest
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

        $id = Route::input('company');

        return [
            'name' => 'required|string|min:6|max:190',
            'email' => ['nullable','email',Rule::unique('companies', 'email')->ignore($id)],
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100|max:1900',
            'website' => ['nullable','url','max:190',Rule::unique('companies', 'website')->ignore($id)],
        ];
    }
}
