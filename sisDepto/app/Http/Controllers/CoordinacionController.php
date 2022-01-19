<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Fondo;

class CoordinacionController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
    public function index()
    {
        $id=1;
        $recurso=Fondo::findOrFail($id);
        return view('administracion.coordinacion.index', ["recurso" => $recurso]);
    }
}







