<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Oficinas;
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
use sisDepartamento\Proveedores;

class OrdenesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
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
		return view('administracion.ordenes.create', ["oficinas" => $oficinas, "partidas" => $partidas, "proveedores" => $proveedores]);
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
		//Update de nombre y programa de las oficinas
		$oficinas = Oficinas::findOrFail($request->get('num_unidad'));
		$oficinas->nombre_corto = $request->get('nombre_unidad');
		$oficinas->programa = $request->get('programa');
		$oficinas->update();
		//Update de domicilio de proveedores
		$proveedores = Proveedores::findOrFail($request->get('rfc'));
		$proveedores->domicilio = $request->get('domicilio');
		$proveedores->update();
		return Redirect::to('administracion/ordenes');
	}

	public function show($id)
	{
		$ordenes = DB::table('ordenes AS orden')
			->JOIN('oficinas as of', 'of.num_oficina', '=', 'orden.unidad')
			->JOIN('partidas as par', 'par.num_partida', '=', 'orden.partida')
			->JOIN('proveedores as pro', 'pro.rfc', '=', 'orden.proveedor')
			->SELECT('orden.num_orden', 'of.num_oficina', 'of.unidad', 'orden.partida', 'of.nombre_corto', 'of.programa', 'orden.concepto', 'pro.proveedor', 'pro.domicilio', 'orden.descripcion', 'orden.fecha')
			->WHERE('orden.num_orden', '=', $id)
			->first();
		return view('administracion.ordenes.show', ["ordenes" => $ordenes]);
	}

	public function edit($id)
	{
		$orden = DB::table('ordenes AS orden')
			->JOIN('oficinas as of', 'of.num_oficina', '=', 'orden.unidad')
			->JOIN('partidas as par', 'par.num_partida', '=', 'orden.partida')
			->JOIN('proveedores as pro', 'pro.rfc', '=', 'orden.proveedor')
			->SELECT('orden.num_orden', 'orden.unidad AS num', 'of.unidad', 'orden.partida', 'of.nombre_corto', 'of.programa', 'orden.concepto', 'orden.proveedor AS rfc', 'pro.proveedor', 'pro.domicilio', 'orden.descripcion', 'orden.fecha')
			->WHERE('orden.num_orden', '=', $id)
			->first();
		$oficinas = DB::table('oficinas AS of')
			->SELECT(DB::raw('CONCAT(of.num_oficina," - ",of.unidad) AS oficinas'), 'of.num_oficina', 'of.unidad', 'of.nombre_corto', 'of.programa')
			->get();
		$partidas = DB::table('partidas AS par')
			->SELECT(DB::raw('CONCAT(par.num_partida," - ",par.nombre_partida) AS partidas'), 'par.num_partida')
			->get();
		$proveedores = DB::table('proveedores')->get();
		return view('administracion.ordenes.edit', ["orden" => $orden, "oficinas" => $oficinas, "partidas" => $partidas, "proveedores" => $proveedores]);
	}

	public function update(OrdenesFormRequest $request, $id)
	{
		$orden = Ordenes::findOrFail($id);
		$orden->unidad = $request->get('num_unidad');
		$orden->partida = $request->get('partida');
		$orden->concepto = $request->get('concepto');
		$orden->proveedor = $request->get('rfc');
		$orden->descripcion = $request->get('descripcion');
		$orden->fecha = $request->get('fecha');
		$orden->update(); /* update*/
		//Update de nombre y programa de las oficinas
		$oficinas = Oficinas::findOrFail($request->get('num_unidad'));
		$oficinas->nombre_corto = $request->get('nombre_unidad');
		$oficinas->programa = $request->get('programa');
		$oficinas->update();
		//Update de domicilio de proveedores
		$proveedores = Proveedores::findOrFail($request->get('rfc'));
		$proveedores->domicilio = $request->get('domicilio');
		$proveedores->update();
		return $this->show($id);
	}

	public function generar(Request $request)
	{
		try {
			$template = new \PhpOffice\PhpWord\TemplateProcessor('OrdenPlantilla.docx');
			$meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
			$fecha = Carbon::parse($request->get('fecha'));
			$mfecha = $meses[$fecha->month - 1];
			$dfecha = $fecha->day;
			$afecha = $fecha->year;
			$template->setValue('dia', $dfecha);
			$template->setValue('mes', $mfecha);
			$template->setValue('año', $afecha);
			$num = "";
			if ($request->get('num_orden') < 10) {
				$num = "00" . $request->get('num_orden');
			}
			if ($request->get('num_orden') >= 10 && $request->get('num_orden') < 100) {
				$num = "0" . $request->get('num_orden');
			}
			if ($request->get('num_orden') >= 10 && $request->get('num_orden') >= 100) {
				$num = $request->get('num_orden');
			}

			$template->setValue('id', $num);
			$template->setValue('clave', $request->get('unidad'));
			$template->setValue('partida', $request->get('partida'));
			$template->setValue('unidad', $request->get('nombre_unidad'));
			$template->setValue('programa', $request->get('programa'));
			$template->setValue('concepto', $request->get('concepto'));
			$template->setValue('proveedor', $request->get('proveedor'));
			$template->setValue('domicilio', $request->get('domicilio'));
			$template->setValue('descripcion', $request->get('descripcion'));
			$tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
			$template->saveAs($tempFile);

			$headers = [
				"Content-Type: application/octet-stream",
			];
			return response()->download($tempFile, 'Orden.docx', $headers)->deleteFileAfterSend(true);
		} catch (\PhpOffice\PhpWord\Exception\Exception $e) {
			return back($e->getCode());
		}
	}
}
