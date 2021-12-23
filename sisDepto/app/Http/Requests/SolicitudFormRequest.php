<?php

namespace sisDepartamento\Http\Requests;

use sisDepartamento\Http\Requests\Request;

class SolicitudFormRequest extends Request
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
            'asunto'=>'required',
            'unidad'=>'max:150',
            'jurisd_sanit'=>'max:7',
            'compromiso'=>'required',
            'fecha_limite'=>'max:15',
            'estado'=>'max:25',
        ];
    }
}
