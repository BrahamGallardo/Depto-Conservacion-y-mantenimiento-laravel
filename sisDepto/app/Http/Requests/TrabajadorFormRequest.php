<?php

namespace sisDepartamento\Http\Requests;

use sisDepartamento\Http\Requests\Request;

class TrabajadorFormRequest extends Request
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
            'nombre'=>'required|max:45',
            'email'=>'max:45',
            'telefono'=>'max:15',
            'idtipoTrabajador'=>'max:15',
            'rol'=>'max:15',
            'horario'=>'max:15'
        ];
    }
}
