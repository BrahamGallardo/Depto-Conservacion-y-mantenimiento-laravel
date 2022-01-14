<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Http\Requests\ProveedoresFormRequest;
use sisDepartamento\Proveedores;
use Illuminate\Support\Facades\Redirect;

class ProveedoresController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
    public function create(Request $request)
    {
        return view('administracion.ordenes.proveedor');
    }
    public function store(ProveedoresFormRequest $request)
	{
		$proveedor = new Proveedores();
		$proveedor->rfc = $request->get('rfc');
		$proveedor->proveedor = $request->get('proveedor');
		$proveedor->domicilio = $request->get('domicilio');
		$proveedor->save(); /* update*/
		return Redirect::to('administracion/ordenes/create');
	}
}
