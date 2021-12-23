<?php

namespace sisDepartamento\Http\Requests;

use sisDepartamento\Http\Requests\Request;

class EgresoFormRequest extends Request
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
            'trabajador'=>'required|max:20',
            'cantidad'=>'max:20',
            'cod_articulo'=>'max:20',
            'prazon'=>'max:180',
            'parchivo'=>'max:25'
        ];
    }
}
