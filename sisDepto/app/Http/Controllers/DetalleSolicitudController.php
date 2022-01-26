<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\DetalleSolicitud;
use Illuminate\Support\Facades\Redirect;
use sisDepartamento\Http\Requests\DetalleSolicitudFormRequest;
use DB;
use sisDepartamento\Solicitudes;

class DetalleSolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $seguimientos = DB::table('detalle_solicitud as ds')
                ->join('trabajadores as tra', 'ds.trabajador', '=', 'tra.idtrabajador')
                ->join('solicitudes as soli', 'ds.solicitud', '=', 'soli.idsolicitud')
                ->select('iddetalle_solicitud', 'solicitud', 'egreso', 'tra.nombre_trabajador', 'tra.idtrabajador', 'fecha', 'soli.estado')
                ->where('tra.nombre_trabajador', 'LIKE', '%' . $query . '%')
                ->orwhere('iddetalle_solicitud', 'LIKE', '%' . $query . '%')
                ->orderBy('iddetalle_solicitud', 'desc')->paginate(9);
            return view('administracion.seguimientos.index', ["seguimientos" => $seguimientos, "searchText" => $query]);
        }
    }

    public function create()
    {
        $trabajadores = DB::table('trabajadores as tr')
            ->SELECT(DB::raw('CONCAT(tr.idtrabajador, " - ", tr.nombre_trabajador) AS trabajador'), 'tr.idtrabajador')
            ->WHERE('tr.idestado', '!=', '5')
            ->get();
        $solicitudes = DB::table('solicitudes')
            ->WHERE('estado', '!=', 'No procede')
            ->WHERE('estado', '!=', 'Cumplido')
            ->get();
        $egresos = DB::table('egresos as e')
            ->SELECT(DB::raw('CONCAT(e.idegreso," - ",e.razon) AS egreso'), 'e.idegreso')
            ->get();
        $descripciones = DB::table('detalle_solicitud')
            ->select('descripcion','solicitud')
            ->get();
        return view("administracion.seguimientos.create", ["descripciones"=>$descripciones,"trabajadores" => $trabajadores, "solicitudes" => $solicitudes, "egresos" => $egresos]);
    }

    public function store(DetalleSolicitudFormRequest $request)
    {
        $detalle = new DetalleSolicitud();
        $detalle->solicitud = $request->get('solicitud');
        $detalle->egreso = $request->get('egreso');
        $detalle->trabajador = $request->get('trabajador');
        $detalle->fecha = $request->get('fecha');
        $detalle->total = $request->get('total');
        $detalle->documento = $request->get('documento');
        $detalle->descripcion = $request->get('descripcion');
        $detalle->save(); /* update*/

        if ($request->get('estado') != "") {
            $solicitud = Solicitudes::findOrFail($detalle->solicitud);
            $solicitud->estado = $request->get('estado');
            $solicitud->update();
        }

        return Redirect::to('administracion/seguimiento');
    }
    /*
        Consulta sql
        SELECT d.solicitud, soli.asunto, soli.compromiso, soli.estado, d.egreso, tra.nombre_trabajador, d.fecha, d.total, d.folio, d.documento, soli.actualizacion, soli.comentarios
        FROM detalle_solicitud AS d
        JOIN solicitudes AS soli ON d.solicitud = soli.idsolicitud
        JOIN trabajadores AS tra ON d.trabajador = tra.idtrabajador
        WHERE d.iddetalle_solicitud = 2;
        */
    public function show($id)
    {
        $detalle = DB::table('detalle_solicitud AS d')
            ->JOIN('solicitudes AS soli', 'd.solicitud', '=', 'soli.idsolicitud')
            ->JOIN('trabajadores AS tra', 'd.trabajador', '=', 'tra.idtrabajador')
            ->SELECT('d.iddetalle_solicitud', 'd.solicitud', 'soli.asunto', 'soli.compromiso', 'soli.estado', 'd.egreso', 'tra.nombre_trabajador', 'd.fecha', 'd.total', 'd.documento', 'soli.actualizacion', 'soli.comentarios', 'd.descripcion')
            ->WHERE('d.iddetalle_solicitud', '=', $id)
            ->first();

        return view("administracion.seguimientos.show", ["detalle" => $detalle]);
    }

    public function edit($id)
    {
        $detalle = DetalleSolicitud::findOrFail($id);
        $estado = DB::table('detalle_solicitud as ds')
            ->join('solicitudes as soli', 'soli.idsolicitud', '=', 'ds.solicitud')
            ->SELECT('soli.estado', 'soli.unidad', 'soli.asunto')
            ->where('iddetalle_solicitud', '=', $id)
            ->first();
        $trabajadores = DB::table('trabajadores as tr')
            ->SELECT(DB::raw('CONCAT(tr.idtrabajador, " - ", tr.nombre_trabajador) AS trabajador'), 'tr.idtrabajador')
            ->WHERE('tr.idestado', '!=', '5')
            ->get();
        $solicitudes = DB::table('solicitudes')
            ->WHERE('estado', '!=', 'No procede')
            ->WHERE('estado', '!=', 'Cumplido')
            ->get();
        $egresos = DB::table('egresos as e')
            ->SELECT(DB::raw('CONCAT(e.idegreso," - ",e.razon) AS egreso'), 'e.idegreso')
            ->get();
        return view("administracion.seguimientos.edit", ["detalle" => $detalle, "trabajadores" => $trabajadores, "solicitudes" => $solicitudes, "egresos" => $egresos, "estado" => $estado]);
    }

    public function update(DetalleSolicitudFormRequest $request, $id)
    {
        $detalle = DetalleSolicitud::findOrFail($id);
        $detalle->solicitud = $request->get('solicitud');
        $detalle->egreso = $request->get('egreso');
        $detalle->trabajador = $request->get('trabajador');
        $detalle->fecha = $request->get('fecha');
        $detalle->total = $request->get('total');
        $detalle->documento = $request->get('documento');
        $detalle->descripcion = $request->get('descripcion');
        $detalle->update();
        $solicitud = Solicitudes::findOrFail($detalle->solicitud);
        $solicitud->estado = $request->get('estado');
        $solicitud->update();
        return $this->show($id);
    }
    public function buscar()
    {

        return Redirect::to('administracion/seguimiento');
    }
}
