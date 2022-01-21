<?php

namespace sisDepartamento\Http\Requests;

use sisDepartamento\Http\Requests\Request;

class DetalleSolicitudFormRequest extends Request
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
            'solicitud'=>'required|max:25',
            'egreso'=>'max:25',
            'trabajador'=>'required|max:50',
            'fecha'=>'required|max:25',
            'total'=>'max:25',
            'documento'=>'max:50',
        ];
    }
}
