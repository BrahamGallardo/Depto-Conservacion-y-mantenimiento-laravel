<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Solicitudes;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDepartamento\Http\Requests\OrdenesFormRequest;
use DB;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Style\ListItem;
use PhpOffice\PhpWord\SimpleType\Jc;
use Carbon\Carbon;
use sisDepartamento\Ordenes;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use sisDepartamento\Articulos;

class OrdenesController extends Controller
{
	public function index(Request $request)
	{
		if ($request) {
			$query = trim($request->get('searchText'));
			$ordenes = DB::table('ordenes AS orden')
				->JOIN('oficinas as of', 'of.num_oficina', '=', 'orden.unidad')
				->JOIN('partidas as par', 'par.num_partida', '=', 'orden.partida')
				->JOIN('proveedores as pro', 'pro.rfc', '=', 'orden.proveedor')
				->SELECT('orden.num_orden', 'of.unidad', 'orden.concepto', 'pro.proveedor', 'orden.fecha')
				->where('of.unidad', 'LIKE', '%' . $query . '%')
				->orwhere('orden.concepto', 'LIKE', '%' . $query . '%')
				->orderBy('orden.num_orden', 'desc')->paginate(9);
			return view('administracion.ordenes.index', ["ordenes" => $ordenes, "searchText" => $query]);
		}
	}

	public function create()
	{
		$oficinas = DB::table('oficinas AS of')
			->SELECT(DB::raw('CONCAT(of.num_oficina," - ",of.unidad) AS oficinas'), 'of.num_oficina', 'of.unidad', 'of.nombre_corto', 'of.programa')
			->get();
		$partidas = DB::table('partidas AS par')
			->SELECT(DB::raw('CONCAT(par.num_partida," - ",par.nombre_partida) AS partidas'), 'par.num_partida')
			->get();
		$proveedores = DB::table('proveedores')->get();
		return view('administracion.ordenes.create', ["oficinas" => $oficinas, "partidas" => $partidas,"proveedores" => $proveedores]);
	}

	public function store(OrdenesFormRequest $request)
	{
		$orden = new Ordenes;
		$orden->unidad = $request->get('num_unidad');
		$orden->partida = $request->get('partida');
		$orden->concepto = $request->get('concepto');
		$orden->proveedor = $request->get('rfc');
		$orden->descripcion = $request->get('descripcion');
		$orden->fecha = $request->get('fecha');
		$orden->save(); /* update*/
		return Redirect::to('administracion/ordenes');
	}

	public function show($id)
	{
		$ordenes = DB::table('ordenes AS orden')
			->JOIN('oficinas as of', 'of.num_oficina', '=', 'orden.unidad')
			->JOIN('partidas as par', 'par.num_partida', '=', 'orden.partida')
			->JOIN('proveedores as pro', 'pro.rfc', '=', 'orden.proveedor')
			->SELECT('orden.num_orden', 'of.unidad', 'orden.partida', 'of.nombre_corto', 'of.programa', 'orden.concepto', 'pro.proveedor', 'pro.domicilio', 'orden.descripcion')
			->WHERE('orden.num_orden', '=', $id)
			->first();
		return view('administracion.ordenes.show', ["ordenes" => $ordenes]);
	}

	public function generar(Request $request)
	{
		try {
			$template = new \PhpOffice\PhpWord\TemplateProcessor('OrdenPlantilla.docx');
			$documento = new \PhpOffice\PhpWord\PhpWord();
			$cont = $request->get('mytext');
			for ($fila = 0; $fila < $cont; $fila++) {
				$template->setValue('tabla_art', $cont);
				$tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
				$template->saveAs($tempFile);

				$headers = [
					"Content-Type: application/octet-stream",
				];
				return response()->download($tempFile, 'plantilla.docx', $headers)->deleteFileAfterSend(true);
			}
		} catch (\PhpOffice\PhpWord\Exception\Exception $e) {
			return back($e->getCode());
		}
	}
}
