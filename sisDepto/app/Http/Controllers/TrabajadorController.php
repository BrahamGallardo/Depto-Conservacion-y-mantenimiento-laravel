<?php

namespace sisDepartamento\Http\Controllers;

use Illuminate\Http\Request;

use sisDepartamento\Trabajadores;
use sisDepartamento\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisDepartamento\Http\Requests\TrabajadorFormRequest;
use DB;

class TrabajadorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

	
    public function index(Request $request){
    	if($request){
    		$query = trim($request->get('searchText'));
    		$trabajadores=DB::table('trabajadores as t')
			->join('roles as r', 't.idrol','=','r.idrol')
			->join('estados_trabajador as et', 't.idestado','=','et.idestado_trabajador')
			->select('idtrabajador','t.nombre_trabajador','r.nombre_rol','et.estado_trabajador','email')
			->where('t.nombre_trabajador','LIKE','%'.$query.'%')
			->where('estado_trabajador','!=','Inactivo')
			->orderBy('idtrabajador','desc')->paginate(7);
    		return view('administracion.trabajadores.index',["trabajadores"=>$trabajadores,"searchText"=>$query]);
    	}

    }


    public function create(){
		$tipos=DB::table('tipos_trabajador')->get();
		$roles=DB::table('roles')->get();
		$horarios=DB::table('horarios')->get();
    	return view("administracion.trabajadores.create",["tipos"=>$tipos,"roles"=>$roles,"horarios"=>$horarios]);
    }


	public function store(TrabajadorFormRequest $request){
		$trabajador=new Trabajadores;
		$trabajador->nombre_trabajador=$request->get('nombre');
		$trabajador->email=$request->get('email');
		$trabajador->telefono=$request->get('telefono');
		$trabajador->idtipo_trabajador=$request->get('idtipoTrabajador');
		$trabajador->idrol=$request->get('rol');
		$trabajador->idestado='1';
        $trabajador->idhorario=$request->get('horario');
		$trabajador->save();
		return Redirect::to('administracion/trabajadores');
    }


    public function show($id){
    	return view("administracion.trabajadores.show",["trabajador"=>Trabajadores::findOrFail($id)]);
    }


    public function edit($id){
		$trabajadores=Trabajadores::findOrFail($id);
    	$tipos=DB::table('tipos_trabajador')->get();
		$roles=DB::table('roles')->get();
		$horarios=DB::table('horarios')->get();
		$estados=DB::table('estados_trabajador')->get();
    	return view("administracion.trabajadores.edit",["trabajadores"=>$trabajadores,"tipos"=>$tipos,"roles"=>$roles,"horarios"=>$horarios,"estados"=>$estados]);
    }


    public function update(TrabajadorFormRequest $request, $id){
    	$trabajador=Trabajadores::findOrFail($id);
        $trabajador->nombre_trabajador=$request->get('nombre');
		$trabajador->email=$request->get('email');
		$trabajador->telefono=$request->get('telefono');
		$trabajador->idtipo_trabajador=$request->get('idtipoTrabajador');
		$trabajador->idrol=$request->get('rol');
        $trabajador->idhorario=$request->get('horario');
    	$trabajador->update();
    	return Redirect::to('administracion/trabajadores');

    }


    public function destroy($id){
    	$trabajador=Trabajadores::findOrFail($id);
    	$trabajador->idestado='5';
    	$trabajador->update();
    	return Redirect::to('administracion/trabajadores');
    }


}
