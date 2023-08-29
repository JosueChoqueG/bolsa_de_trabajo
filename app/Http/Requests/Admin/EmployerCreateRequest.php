<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployerCreateRequest extends FormRequest
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
            'ruc'                 => 'bail|required|digits:11|unique:employer,ruc',
            'name'                => 'bail|required:max:100',
            'tradename'           => 'bail|required:max:100',
            'address'             => 'bail|required|max:300',
            'email'               => 'bail|required|email|max:50|unique:employer,email',
            'sector_id'           => 'required|exists:sector,id',
            'description'         => 'bail|required|max:500',
            'logo'                => 'bail|sometimes|nullable|image|mimes:jpeg,png|max:1000',
            'web_page'            => 'bail|sometimes|nullable|max:200',
            'contact_name'        => 'bail|required:max:50',
            'contact_lastname'    => 'bail|required:max:50',
            'contact_role'        => 'bail|required:max:100',
            'contact_first_phone' => 'bail|required:max:30',
            'contact_second_phone' => 'bail|sometimes|nullable|max:30',
        ];
    }
}
