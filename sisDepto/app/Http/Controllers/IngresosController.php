<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Ingreso;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDepartamento\Http\Requests\IngresoFormRequest;
use DB;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Style\ListItem;
use PhpOffice\PhpWord\SimpleType\Jc;
use Carbon\Carbon;
use sisDepartamento\DetalleIngreso;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use sisDepartamento\Articulos;

class IngresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $ingresos = DB::table('ingreso AS i')
                ->JOIN('detalle_ingreso as di', 'di.iddetalle_ingreso', '=', 'i.idingreso')
                ->SELECT('i.idingreso', 'i.fecha_hora', 'di.archivo', 'i.estado')
                ->where('i.idingreso', 'LIKE', '%' . $query . '%')
                ->orderBy('i.idingreso', 'desc')->paginate(9);
            return view('almacen.ingresos.index', ["ingresos" => $ingresos, "searchText" => $query]);
        }
    }
    public function create()
    {
        $tipo = DB::table('tipos_articulo')->get();

        $articulos = DB::table('articulos as art')
            ->join('tipos_articulo as t', 'art.tipo', '=', 't.idtipo_articulo')
            ->join('unidades_articulo as u', 'art.unidad', '=', 'u.idunidad')
            ->select(DB::raw('CONCAT(art.codigo," ",art.nombre_articulo) AS articulo'), 'art.nombre_articulo', 'art.codigo', 't.tipo_articulo', 'u.unidad')
            ->get();
        return view("almacen.ingresos.create", ["tipo" => $tipo, "articulos" => $articulos]);
    }
    public function store(IngresoFormRequest $request)
    {
        try {
            //code...
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
            $mytime = Carbon::now('America/Mexico_City');
            $ingreso->fecha_hora = $mytime->toDateTimeString();
            $ingreso->estado = 'Pendiente';
            $ingreso->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $codigo = $request->get('codigo');

            $cont = 0;
            while ($cont < count($codigo)) {
                $detalle = new DetalleIngreso();
                $detalle->idingreso = $ingreso->idingreso;
                $detalle->cod_articulo = $codigo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->save();

                $cont = $cont + 1;
            }

            DB::commit();
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
        }
        return Redirect::to('almacen/ingresos');
    }
    public function show($id)
    {
        $ingresos = DB::table('ingreso AS i')
            ->JOIN('detalle_ingreso as di', 'di.iddetalle_ingreso', '=', 'i.idingreso')
            ->SELECT('i.idingreso', 'i.tipo_comprobante', 'i.fecha_hora', 'i.estado')
            ->WHERE('i.idingreso', '=', $id)
            ->first();
        /* Consulta sql
            SELECT articulos.codigo ,`articulos`.`nombre_articulo`, detalle_ingreso.cantidad, unidades_articulo.unidad 
            FROM `detalle_ingreso` 
            JOIN articulos ON detalle_ingreso.cod_articulo = articulos.codigo 
            JOIN unidades_articulo ON articulos.unidad = unidades_articulo.idunidad 
            WHERE detalle_ingreso.idingreso = 4;
            */
        $detalles = DB::table('detalle_ingreso AS d')
            ->JOIN('articulos AS art', 'd.cod_articulo', '=', 'art.codigo')
            ->JOIN('unidades_articulo AS u', 'art.unidad', '=', 'u.idunidad')
            ->SELECT('art.nombre_articulo', 'd.cantidad', 'art.codigo', 'u.unidad')
            ->WHERE('d.idingreso', '=', $id)
            ->get();
        return view("almacen.ingresos.show", ["ingresos" => $ingresos, "detalles" => $detalles]);
    }
    public function destroy($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->estado = 'Cancelado';
        $ingreso->update();
        return Redirect::to('almacen/ingresos');
    }
    public function activar($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $codigos = DB::table('detalle_ingreso AS di')
            ->JOIN('articulos AS art', 'di.cod_articulo', '=', 'art.codigo')
            ->SELECT('art.codigo as codigo')
            ->WHERE('di.idingreso', '=', $id)
            ->get();

        foreach ($codigos as $canti) {
            if ($ingreso->estado != 'Realizado') {
                $cont = 0;
                $articulo = Articulos::findOrFail($canti->codigo);
                $newcantidad = DB::table('detalle_ingreso AS di')
                    ->JOIN('articulos AS art', 'di.cod_articulo', '=', 'art.codigo')
                    ->SELECT('art.cantidad')
                    ->WHERE('di.cod_articulo', '=', $canti->codigo)
                    ->get();
                $oldcantidad = DB::table('detalle_ingreso AS di')
                    ->JOIN('articulos AS art', 'di.cod_articulo', '=', 'art.codigo')
                    ->SELECT('di.cantidad')
                    ->WHERE('di.cod_articulo', '=', $canti->codigo)
                    ->get();
                var_dump($newcantidad);
                var_dump($oldcantidad);
                $cantidadtotal = $newcantidad[$cont]->cantidad + $oldcantidad[$cont]->cantidad;
                $articulo->cantidad = $cantidadtotal;
                $articulo->update();
                $cont = $cont + 1;
            }
        }

        $ingreso->estado = 'Realizado';
        $ingreso->update();
        return Redirect::to('almacen/ingresos');
    }
}
