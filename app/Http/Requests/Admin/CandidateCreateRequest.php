<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CandidateCreateRequest extends FormRequest
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
            'document'        => 'bail|required|digits:8|unique:candidate,document',
            'name'            => 'bail|required:max:50',
            'first_lastname'  => 'bail|required:max:50',
            'second_lastname' => 'bail|required|max:50',
            'gender'          => 'bail|in:M,F',
            'birthdate'       => 'bail|required|date',
            'civil_status'    => 'bail|in:Soltero(a),Casado(a),Conviviente,Divorciado(a),Viudo(a)',
            'email'           => 'bail|required|email|max:50|unique:candidate,email',
            'disability'      => 'bail|in:Ninguno,Para ver,Para oír,Para hablar,Para usar extremidades,Otros',
            'status'          => 'bail|in:1,0',
            'photo'           => 'bail|sometimes|nullable|image|mimes:jpeg,png|max:1000',
            'first_phone'     => 'bail|required:max:15',
            'second_phone'    => 'bail|sometimes|nullable|max:15',
        ];
    }
}
