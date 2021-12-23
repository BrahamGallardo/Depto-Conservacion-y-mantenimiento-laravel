<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Egresos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDepartamento\Http\Requests\EgresoFormRequest;
use DB;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Style\ListItem;
use PhpOffice\PhpWord\SimpleType\Jc;
use Carbon\Carbon;
use sisDepartamento\DetalleEgreso;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use sisDepartamento\Articulos;

class EgresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $egresos = DB::table('egresos AS e')
                ->SELECT('e.idegreso', 'e.fecha', 'e.razon', 'e.archivo','e.comentarios')
                ->where('e.idegreso', 'LIKE', '%' . $query . '%')
                ->orwhere('e.razon', 'LIKE', '%' . $query . '%')
                ->orderBy('e.idegreso', 'desc')->paginate(9);
            return view('almacen.egresos.index', ["egresos" => $egresos, "searchText" => $query]);
        }
    }
    public function create()
    {
        $tipo = DB::table('tipos_articulo')->get();
        $trabajadores = DB::table('trabajadores as tra')
        ->SELECT(DB::raw('CONCAT(tra.idtrabajador, " ", tra.nombre_trabajador) AS trabajador'), 'tra.idtrabajador')
        ->GET();

        $articulos = DB::table('articulos as art')
            ->join('tipos_articulo as t', 'art.tipo', '=', 't.idtipo_articulo')
            ->join('unidades_articulo as u', 'art.unidad', '=', 'u.idunidad')
            ->select(DB::raw('CONCAT(art.codigo," ",art.nombre_articulo) AS articulo'),'art.cantidad', 'art.nombre_articulo', 'art.codigo', 't.tipo_articulo', 'u.unidad')
            ->get();
        return view("almacen.egresos.create", ["tipo" => $tipo, "articulos" => $articulos, "trabajadores" => $trabajadores]);
    }

    public function store(EgresoFormRequest $request)
    {
            //code...
            DB::beginTransaction();
            $egreso = new Egresos;
            $mytime = Carbon::now('America/Mexico_City');
            $egreso->fecha = $mytime->toDateString();
            $egreso->trabajador = $request->get('trabajador');
            $egreso->razon = $request->get('prazon');
            $egreso->archivo = $request->get('parchivo');
            $egreso->comentarios = $request->get('comentarios');
            $egreso->save();

            $cantidad = $request->get('cantidad');
            $codigo = $request->get('codigo');

            $cont = 0;
            while ($cont < count($codigo)) {
                $detalle = new DetalleEgreso();
                $detalle->idegreso = $egreso->idegreso;
                $detalle->cod_articulo = $codigo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->save();
                $cont = $cont + 1;
            }

            DB::commit();
       
            //throw $th;
            DB::rollback();
        
        return Redirect::to('almacen/egresos');
    }

    public function show($id)
    {
        $egreso = DB::table('egresos AS e')
            ->JOIN('detalle_egreso as de', 'de.iddetalle_egreso', '=', 'e.idegreso')
            ->JOIN('trabajadores as tra', 'tra.idtrabajador', '=', 'e.trabajador')
            ->SELECT('e.idegreso', 'e.fecha', 'e.trabajador', 'e.razon', 'e.archivo', 'e.comentarios', 'tra.nombre_trabajador')
            ->WHERE('e.idegreso', '=', $id)
            ->first();
        /* Consulta sql
            SELECT articulos.codigo ,`articulos`.`nombre_articulo`, detalle_ingreso.cantidad, unidades_articulo.unidad 
            FROM `detalle_ingreso` 
            JOIN articulos ON detalle_ingreso.cod_articulo = articulos.codigo 
            JOIN unidades_articulo ON articulos.unidad = unidades_articulo.idunidad 
            WHERE detalle_ingreso.idingreso = 4;
            */
        $detalles = DB::table('detalle_egreso AS d')
            ->JOIN('articulos AS art', 'd.cod_articulo', '=', 'art.codigo')
            ->JOIN('unidades_articulo AS u', 'art.unidad', '=', 'u.idunidad')
            ->SELECT('art.nombre_articulo', 'd.cantidad', 'art.codigo', 'u.unidad')
            ->WHERE('d.idegreso', '=', $id)
            ->get();
        $arts = DB::table('detalle_egreso AS d')
            ->JOIN('articulos AS art', 'd.cod_articulo', '=', 'art.codigo')
            ->JOIN('unidades_articulo AS u', 'art.unidad', '=', 'u.idunidad')
            ->SELECT('art.nombre_articulo', 'd.cantidad', 'd.idegreso', 'u.unidad')
            ->WHERE('d.idegreso', '=', $id)
            ->first();
        return view("almacen.egresos.show", ["egreso" => $egreso, "detalles" => $detalles, "arts" => $arts]);
    }

}
