<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Http\Requests;
use sisDepartamento\DetalleSolicitud;
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

class DetalleSolicitudController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query = trim($request->get('searchText'));
    		$seguimientos=DB::table('detalle_solicitud as ds')
			->join('trabajadores as tra', 'ds.trabajador','=','tra.idtrabajador')
            ->join('solicitudes as soli', 'ds.solicitud','=','soli.idsolicitud')
			->select('iddetalle_solicitud','solicitud','egreso','tra.nombre_trabajador', 'tra.idtrabajador','fecha', 'soli.estado')
            ->where('tra.nombre_trabajador','LIKE','%'.$query.'%')
            ->orwhere('iddetalle_solicitud','LIKE','%'.$query.'%')
			->orderBy('iddetalle_solicitud','desc')->paginate(9);
    		return view('administracion.seguimientos.index',["seguimientos"=>$seguimientos,"searchText"=>$query]);
    	}
    }

    public function create(){
		$trabajadores=DB::table('trabajadores as tr')
        ->SELECT(DB::raw('CONCAT(tr.idtrabajador, " - ", tr.nombre_trabajador) AS trabajador'), 'tr.idtrabajador')
        ->WHERE('tr.idestado', '!=', '5')
        ->get();
		$solicitudes=DB::table('solicitudes')
        ->WHERE('estado', '!=', 'No procede')
        ->WHERE('estado', '!=', 'Cumplido')
        ->get();
		$egresos=DB::table('egresos as e')
        ->SELECT(DB::raw('CONCAT(e.idegreso," - ",e.razon) AS egreso'), 'e.idegreso')
        ->get();
    	return view("administracion.seguimientos.create",["trabajadores"=>$trabajadores,"solicitudes"=>$solicitudes,"egresos"=>$egresos]);
    }

	public function store(TrabajadorFormRequest $request){
		
    }

    public function show($id){
    	
    }

	public function details($id){
		
    }

	public function detail($id){
		
    }
	
    public function edit($id){
		
    }

    public function update(TrabajadorFormRequest $request, $id){
    	

    }

    public function destroy($id){
    	
    }
}
