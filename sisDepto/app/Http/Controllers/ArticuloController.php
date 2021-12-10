<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Articulos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDepartamento\Http\Requests\ArticuloFormRequest;
use DB;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Style\ListItem;

class ArticuloController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
	}


	public function index(Request $request)
	{
		if ($request) {
			$query = trim($request->get('searchText'));
			$articulos = DB::table('articulos as art')
				->join('tipos_articulo as t', 'art.tipo', '=', 't.idtipo_articulo')
				->join('unidades_articulo as u', 'art.unidad', '=', 'u.idunidad')
				->select('codigo', 'art.nombre_articulo', 't.tipo_articulo', 'art.cantidad', 'u.unidad')
				->where('art.nombre_articulo', 'LIKE', '%' . $query . '%')
				->orderBy('codigo', 'asc')->paginate(9);
			return view('almacen.articulos.index', ["articulos" => $articulos, "searchText" => $query]);
		}
	}

	public function solicitar($id)
	{
		$articulos = Articulos::findOrFail($id);
		$unidad = DB::table('unidades_articulo')->get();
		return view("almacen.articulos.solicitar", ["articulos" => $articulos, "unidad" => $unidad]);
	}

	public function generar(Request $request)
	{
		try {
			$template = new \PhpOffice\PhpWord\TemplateProcessor('plantilla.docx');

			

			$template->setValue('tabla_art', $request->get('mytext'));


			$tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
			$template->saveAs($tempFile);

			$headers = [
				"Content-Type: application/octet-stream",
			];
			return response()->download($tempFile, 'plantilla.docx', $headers)->deleteFileAfterSend(true);
		} catch (\PhpOffice\PhpWord\Exception\Exception $e) {
			return back($e->getCode());
		}
	}

	public function create()
	{
		$tipo = DB::table('tipos_articulo')->get();

		$articulos = DB::table('articulos as art')
			->join('tipos_articulo as t', 'art.tipo', '=', 't.idtipo_articulo')
			->join('unidades_articulo as u', 'art.unidad', '=', 'u.idunidad')
			->select(DB::raw('CONCAT(art.codigo," ",art.nombre_articulo) AS articulo'), 'art.codigo', 't.tipo_articulo', 'u.unidad')
			->get();
		return view("almacen.articulos.create", ["tipo" => $tipo, "articulos" => $articulos]);
	}


	public function store(TrabajadorFormRequest $request)
	{
		$trabajador = new Trabajadores;
		$trabajador->nombre_trabajador = $request->get('nombre');
		$trabajador->email = $request->get('email');
		$trabajador->telefono = $request->get('telefono');
		$trabajador->idtipo_trabajador = $request->get('idtipoTrabajador');
		$trabajador->idrol = $request->get('rol');
		$trabajador->idestado = '1';
		$trabajador->idhorario = $request->get('horario');
		$trabajador->save();
		return Redirect::to('administracion/trabajadores');
	}


	public function show($id)
	{
		return view("administracion.trabajadores.show", ["trabajador" => Trabajadores::findOrFail($id)]);
	}

	public function details($id)
	{
		$trabajadores = Trabajadores::findOrFail($id);
		$tipos = DB::table('tipos_trabajador')->get();
		$roles = DB::table('roles')->get();
		$horarios = DB::table('horarios')->get();
		$estados = DB::table('estados_trabajador')->get();
		return view("administracion.trabajadores.details", ["trabajadores" => $trabajadores, "tipos" => $tipos, "roles" => $roles, "horarios" => $horarios, "estados" => $estados]);
	}
	public function detail($id)
	{
		return Redirect::to('administracion/trabajadores');
	}



	public function edit($id)
	{
		$trabajadores = Trabajadores::findOrFail($id);
		$tipos = DB::table('tipos_trabajador')->get();
		$roles = DB::table('roles')->get();
		$horarios = DB::table('horarios')->get();
		$estados = DB::table('estados_trabajador')->get();
		return view("administracion.trabajadores.edit", ["trabajadores" => $trabajadores, "tipos" => $tipos, "roles" => $roles, "horarios" => $horarios, "estados" => $estados]);
	}


	public function update(TrabajadorFormRequest $request, $id)
	{
		$trabajador = Trabajadores::findOrFail($id);
		$trabajador->nombre_trabajador = $request->get('nombre');
		$trabajador->email = $request->get('email');
		$trabajador->telefono = $request->get('telefono');
		$trabajador->idtipo_trabajador = $request->get('idtipoTrabajador');
		$trabajador->idrol = $request->get('rol');
		$trabajador->idhorario = $request->get('horario');
		$trabajador->update();
		return Redirect::to('administracion/trabajadores');
	}


	public function destroy($id)
	{
		$trabajador = Trabajadores::findOrFail($id);
		$trabajador->idestado = '5';
		$trabajador->update();
		return Redirect::to('administracion/trabajadores');
	}
}
