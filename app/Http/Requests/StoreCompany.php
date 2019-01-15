<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompany extends FormRequest
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
            'name' => 'required|string|max:190|min:6',
            'email' => 'nullable|email|unique:companies,email',
            'logo' => 'image|nullable|dimensions:min_width=100,min_height=100|max:1900',
            'website' => 'url|nullable|max:190|unique:companies,website',
        ];
    }
}
