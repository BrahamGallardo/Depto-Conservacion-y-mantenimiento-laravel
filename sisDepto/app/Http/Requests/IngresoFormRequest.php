<?php

namespace sisDepartamento\Http\Requests;

use sisDepartamento\Http\Requests\Request;

class IngresoFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo_comprobante'=>'required|max:20',
            'num_comprobante'=>'required|max:10',
            'idarticulo'=>'required',
            'cantidad'=>'required',
            'precio_compra'=>'required'
        ];
    }
}
