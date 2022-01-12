<?php

namespace sisDepartamento\Http\Requests;

use sisDepartamento\Http\Requests\Request;

class OrdenesFormRequest extends Request
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
            'unidad'=>'required|max:55',
            'partida'=>'required|max:30',
            'nombre_unidad'=>'max:100',
            'programa'=>'max:6',
            'proveedor'=>'required|max:85',
            'domicilio'=>'max:120',
            'fecha'=>'max:25'
        ];
    }
}
