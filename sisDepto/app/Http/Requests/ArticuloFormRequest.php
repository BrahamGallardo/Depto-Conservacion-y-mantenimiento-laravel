<?php

namespace sisDepartamento\Http\Requests;

use sisDepartamento\Http\Requests\Request;

class ArticuloFormRequest extends Request
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
            
            'nombre'=>'required|max:100',
            'idtipoArticulo'=>'max:50',
            'idtipoUnidad'=>'max:25',
            'cantidad'=>'max:15',
            'ubicación'=>'max:40',
            'observaciones'=>'max:250'
        ];
    }
}
