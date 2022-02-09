<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Articulos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDepartamento\Http\Requests\ArticuloFormRequest;
use DB;

use PhpOffice\PhpWord\SimpleType\Jc;

class ArticuloController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	/* Consulta sql 
	SELECT art.codigo, art.nombre_articulo, t.tipo_articulo , art.cantidad, u.unidad 
	FROM `articulos` AS art 
	JOIN tipos_articulo AS t 
	ON `art`.`tipo` = t.idtipo_articulo 
	JOIN unidades_articulo AS u 
	ON art.unidad = u.idunidad;
	*/
	public function index(Request $request)
	{
		if ($request) {
			$query = trim($request->get('searchText'));
			$articulos = DB::table('articulos as art')
				->join('tipos_articulo as t', 'art.tipo', '=', 't.idtipo_articulo')
				->join('unidades_articulo as u', 'art.unidad', '=', 'u.idunidad')
				->select('codigo', 'art.nombre_articulo', 't.tipo_articulo', 'art.cantidad', 'u.unidad')
				->where('art.nombre_articulo', 'LIKE', '%' . $query . '%')
				->orwhere('t.tipo_articulo', 'LIKE', '%' . $query . '%')
				->orderBy('codigo', 'asc')->paginate(9);
			return view('almacen.articulos.index', ["articulos" => $articulos, "searchText" => $query]);
		}
	}
	/*
	SELECT  art.numero_articulo
	FROM `articulos` AS art 
	WHERE art.tipo = 1
	ORDER BY art.numero_articulo DESC;
	*/
	public function create()
	{
		$electricos = DB::table('articulos as art')
			->select(DB::raw('MAX(art.numero_articulo) AS num'))
			->where('art.tipo', '=', '1')
			->orderBy('art.numero_articulo', 'desc')->get();
		$plomeria = DB::table('articulos as art')
			->select(DB::raw('MAX(art.numero_articulo) AS num'))
			->where('art.tipo', '=', '2')
			->orderBy('art.numero_articulo', 'desc')->get();
		$varios = DB::table('articulos as art')
			->select(DB::raw('MAX(art.numero_articulo) AS num'))
			->where('art.tipo', '=', '3')
			->orderBy('art.numero_articulo', 'desc')->get();
		$dentales = DB::table('articulos as art')
			->select(DB::raw('MAX(art.numero_articulo) AS num'))
			->where('art.tipo', '=', '4')
			->orderBy('art.numero_articulo', 'desc')->get();
		$limpieza = DB::table('articulos as art')
			->select(DB::raw('MAX(art.numero_articulo) AS num'))
			->where('art.tipo', '=', '5')
			->orderBy('art.numero_articulo', 'desc')->get();
		$papeleria = DB::table('articulos as art')
			->select(DB::raw('MAX(art.numero_articulo) AS num'))
			->where('art.tipo', '=', '6')
			->orderBy('art.numero_articulo', 'desc')->get();
		$refris = DB::table('articulos as art')
			->select(DB::raw('MAX(art.numero_articulo) AS num'))
			->where('art.tipo', '=', '7')
			->orderBy('art.numero_articulo', 'desc')->get();
		$herra = DB::table('articulos as art')
			->select(DB::raw('MAX(art.numero_articulo) AS num'))
			->where('art.tipo', '=', '8')
			->orderBy('art.numero_articulo', 'desc')->get();
		$tipos = DB::table('tipos_articulo')->get();
		$unidad = DB::table('unidades_articulo')->get();
		return view(
			"almacen.articulos.create",
			[
				"tipos" => $tipos, "unidad" => $unidad,
				"electricos" => $electricos, "plomeria" => $plomeria,
				"varios" => $varios, "dentales" => $dentales,
				"limpieza" => $limpieza, "papeleria" => $papeleria,
				"refris" => $refris, "herra" => $herra,
			]
		);
	}

	public function store(ArticuloFormRequest $request)
	{
		$articulo = new Articulos;
		$articulo->codigo = $request->get('codigo');
		$articulo->nombre_articulo = $request->get('nombre');
		$articulo->tipo = $request->get('idtipoArticulo');
		$articulo->unidad = $request->get('idtipoUnidad');
		$articulo->cantidad = $request->get('cantidad');
		$articulo->ubicacion = $request->get('ubicacion');
		$articulo->observaciones = $request->get('observaciones');
		$articulo->numero_articulo = $request->get('number');
		$articulo->save(); /* update*/
		return Redirect::to('almacen/articulos');
	}

	public function show($id)
	{
		$articulos = DB::table('articulos as art')
			->JOIN('unidades_articulo AS uni', 'art.unidad', '=', 'uni.idunidad')
			->JOIN('tipos_articulo AS t', 'art.tipo', '=', 't.idtipo_articulo')
			->select('codigo', 'nombre_articulo', 't.tipo_articulo', 'tipo', 'uni.unidad as nombre_unidad', 'art.unidad', 'cantidad', 'ubicacion', 'observaciones')
			->where('codigo', '=', '' . $id . '')->first();
		$tipos = DB::table('tipos_articulo')->get();
		$unidad = DB::table('unidades_articulo')->get();
		return view("almacen.articulos.details", ["articulos" => $articulos, "tipos" => $tipos, "unidad" => $unidad]);
	}

	public function edit($codigo)
	{
		$articulos = DB::table('articulos as art')
			->select('codigo', 'nombre_articulo', 'tipo', 'unidad', 'cantidad', 'ubicacion', 'observaciones')
			->where('codigo', '=', '' . $codigo . '')->first();
		$tipos = DB::table('tipos_articulo')->get();
		$unidad = DB::table('unidades_articulo')->get();
		return view("almacen.articulos.edit", ["articulos" => $articulos, "tipos" => $tipos, "unidad" => $unidad]);
	}


	public function update(ArticuloFormRequest $request, $id)
	{
		$articulo = Articulos::findOrFail($id);
		$articulo->nombre_articulo = $request->get('nombre');
		$articulo->tipo = $request->get('idtipoArticulo');
		$articulo->unidad = $request->get('idtipoUnidad');
		$articulo->cantidad = $request->get('cantidad');
		$articulo->ubicacion = $request->get('ubicacion');
		$articulo->observaciones = $request->get('observaciones');
		$articulo->update();
		return $this->show($id);
	}

}
