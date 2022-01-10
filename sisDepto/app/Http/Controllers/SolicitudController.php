<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\Solicitudes;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDepartamento\Http\Requests\SolicitudFormRequest;
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

class SolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /* SQL
    SELECT soli.idsolicitud, soli.asunto, soli.unidad, soli.fecha_limite, soli.estado 
    FROM `solicitudes` AS soli WHERE soli.estado='En proceso';
    */
    public function index(Request $request)
    {
        if ($request) {
            $fecha =  Carbon::now('America/Mexico_City');
            $fecha2 = $fecha->addDay(15);
            $fechahoy = $fecha->toDateString();
            $fechasemana = $fecha2->toDateString();
            $query = trim($request->get('searchText'));
            $solicitudes = DB::table('solicitudes AS soli')
                ->SELECT('soli.idsolicitud', 'soli.asunto', 'soli.unidad', 'soli.fecha_limite', 'soli.estado')
                ->where('soli.estado', 'LIKE', '%' . $query . '%')
                ->orwhere('soli.unidad', 'LIKE', '%' . $query . '%')
                ->orwhere('soli.idsolicitud', 'LIKE', '%' . $query . '%')
                ->orwhere('soli.asunto', 'LIKE', '%' . $query . '%')
                ->orderBy('soli.idsolicitud', 'desc')->paginate(12);
            return view('administracion.solicitudes.index', ["solicitudes" => $solicitudes, "fechasemana" => $fechasemana, "fechahoy" => $fechahoy, "searchText" => $query]);
        }
    }

    public function create()
    {
        return view("administracion.solicitudes.create");
    }

    public function store(SolicitudFormRequest $request)
    {
        $solicitud=new Solicitudes;
		$solicitud->asunto=$request->get('asunto');
		$solicitud->unidad=$request->get('unidad');
		$solicitud->jurisd_sanit=$request->get('jurisd_sanit');
		$solicitud->compromiso=$request->get('compromiso');
		$solicitud->fecha_limite=$request->get('fecha_limite');
        $solicitud->estado=$request->get('estado');
		$solicitud->actualizacion=$request->get('actualizacion');
        $solicitud->comentarios=$request->get('comentarios');
		$solicitud->save(); /* update*/
		return Redirect::to('administracion/solicitudes');
    }

    public function edit($id){
		$solicitud=Solicitudes::findOrFail($id);
    	return view("administracion.solicitudes.edit",["solicitud"=>$solicitud]);
    }

    public function update(SolicitudFormRequest $request, $id){
    	$solicitud=Solicitudes::findOrFail($id);
        $solicitud->asunto=$request->get('asunto');
		$solicitud->unidad=$request->get('unidad');
		$solicitud->jurisd_sanit=$request->get('jurisd_sanit');
		$solicitud->compromiso=$request->get('compromiso');
		$solicitud->fecha_limite=$request->get('fecha_limite');
        $solicitud->estado=$request->get('estado');
		$solicitud->actualizacion=$request->get('actualizacion');
        $solicitud->comentarios=$request->get('comentarios');
    	$solicitud->update();
    	return Redirect::to('administracion/solicitudes');
    }

    public function show($id)
	{
        $solicitud=Solicitudes::findOrFail($id);
		return view("administracion.solicitudes.details", ["solicitud" => $solicitud]);
	}

    public function destroy($id){
    	$solicitud=Solicitudes::findOrFail($id);
    	$solicitud->estado='No procede';
    	$solicitud->update();
    	return Redirect::to('administracion/solicitudes');
    }
}
