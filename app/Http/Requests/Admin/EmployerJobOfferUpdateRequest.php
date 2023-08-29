<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class EmployerJobOfferUpdateRequest extends FormRequest
{
    private $route;

    public function __construct(Route $route){
        $this->route = $route;
    }

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
            'category'          => 'bail|required|in:Prácticas,Empleo,Becas/Pasantías',
            'title'             => 'bail|required|max:200',
            'title_complement'  => 'max:200',
            'description'       => 'required|max:10000',
            'introduction'      => 'required|max:700',
            'workday'           => 'bail|required|in:Medio tiempo,Tiempo completo,Por horas',
            'area_id'           => 'required',
            'type_salary'       => 'bail|required|in:A tratar,Fijo,Rango',
            'salary_min'        => 'bail|sometimes|nullable|required_if:type_salary,fijo,Rango|numeric',
            'salary_max'        => 'bail|sometimes|nullable|numeric|gt:salary_min',
            'type_validity'     => 'bail|required|in:Por definir,Definido,Indefinido',
            'countrie_id'       => 'bail|required|exists:countrie,id',
            //'district_code'     => 'bail|sometimes|nullable|required_if:countrie_id,173|exists:geolocation,id',
            'college_id'        => 'required|array|min:1',
            'college_id.*'      => 'exists:college_career,id',
            'vacancies'         => 'bail|required|numeric'  ,
            'finish_date'       => 'bail|required|after:today|date',
            'status'            => 'bail|required|in:1,2,3',
            'publication_date'  => 'date',
            'is_postulable'    => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'salary_max.gt'         => ' el campo Monto Max. no puede ser menor a Monto Min',
            'finish_date.after'     => ' La fecha de cierre debe se mayor a la fecha de hoy ',
        ];
    }
}
