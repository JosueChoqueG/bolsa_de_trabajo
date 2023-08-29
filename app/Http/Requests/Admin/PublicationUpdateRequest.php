<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PublicationUpdateRequest extends FormRequest
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

  
    public function rules()
    {
        return [
            'title'             => 'bail|required|max:200',
            'description'       => 'required|max:30000',
            'event_date'        => 'bail|sometimes|nullable|date',
            'cost'              => 'bail|sometimes|nullable|numeric',
            'type'              => 'bail|required|in:Evento,Artículo de Interés,Orientación',
            'status'            => 'bail|required|in:0,1', 
        ];
    }
}
