<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class UserUpdateRequest extends FormRequest
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
            'name'       => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:user,email,' . $this->route('user_id'),',id',
            'role_id'    => 'required|exists:role,id',
            'status'     => 'required|in:1,0'
        ];
    }
}
