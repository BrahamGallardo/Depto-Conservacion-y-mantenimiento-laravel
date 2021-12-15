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
	ON art.unidad = u.idunidad;*/
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

	//Puede esliminarse este metodo
	public function generar2(Request $request)
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
	
	// Puede eliminarse este método
	public function generar3(Request $request)
	{
		try {
			$template = new \PhpOffice\PhpWord\TemplateProcessor('plantilla.docx');
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
	/*public function generar(Request $request)
	{
		$documento = new \PhpOffice\PhpWord\PhpWord();
		$propiedades = $documento->getDocInfo();
		$propiedades->setCreator("Jesus");
		$propiedades->setTitle("Solicitud");
		$seccion = $documento->addSection();
		$fuente1 = [
			"name" => "Calibri",
			"size" => 11,
			"color" => "000000",
			"bold" => true,
		];
		$fuente2 = [
			"name" => "Calibri",
			"size" => 11,
			"color" => "000000",
			"bold" => false,
		];
		$estilo = $seccion->addTextRun([
			"alignment" => Jc::RIGHT,
			'lineHeight' => 1.5,
		]);
		date_default_timezone_set('America/Mexico_City');
		setlocale(LC_ALL, "es_MX.UTF-8");
		$meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");

		$estilo->addText("OAXACA DE JUÁREZ, OAX. A ", $fuente1);
		$estilo->addText(date("d"), $fuente1);
		$estilo->addText(" DE ", $fuente1);
		$estilo->addText($meses[date('n') - 1], $fuente1);
		$estilo->addText(" DE ", $fuente1);
		$estilo->addText(date("Y"), $fuente1);
		$estilo->addTextBreak(1);

		$estilo = $seccion->addTextRun([
			"alignment" => Jc::LEFT,
			'lineHeight' => 1,
		]);

		$estilo->addText("ING. GIOVANNY RODRIGUEZ REYES", $fuente1);
		$estilo->addTextBreak(1);
		$estilo->addText("DEL DEPARTAMENTO DE CONSERVACION", $fuente1);
		$estilo->addTextBreak(1);
		$estilo->addText("Y MANTENIMIENTO, OAX.", $fuente1);
		$estilo->addTextBreak(1);
		$estilo->addText("P R E S E N T E.", $fuente1);
		//$estilo->addTextBreak(1);

		$estilo = $seccion->addTextRun([
			"alignment" => Jc::RIGHT,
			'lineHeight' => 1,
		]);
		$estilo->addText("AT´N. LIC. KAREN BERENICE RIVERA CRUZ", $fuente1);
		$estilo->addTextBreak(1);
		$estilo->addText("COORDINADORA ADMINISTRATIVA", $fuente1);
		$estilo->addTextBreak(1);
		$estilo->addText("DEL DEPTO. DE CONSERVACION Y MANTTO. ", $fuente1);
		$estilo->addTextBreak(1);
		$estilo->addText("AT´N. ING. PAULINO LOPEZ MODESTO", $fuente1);
		$estilo->addTextBreak(1);
		$estilo->addText("JEFE DE LA OFICINA DE MANTTO.", $fuente1);
		$estilo->addTextBreak(1);

		$estilo = $seccion->addTextRun([
			"alignment" => Jc::BOTH
		]);
		$estilo->addText("Por este conducto, hago de su conocimiento la lista de materiales que se han agotado en su totalidad, y que se requieren para que el personal técnico que labora en este departamento a su digno cargo, pueda contar con lo mínimo necesario para brindar los servicios que son requeridos en las distintas Unidades Médicas y Administrativas dependientes de los Servicios de Salud de Oaxaca.", $fuente2);
		$estilo->addTextBreak(1);
		// Guardarlo para usarlo más tarde

		//Aqui inicia la tabla
		//$seccion = $documento->addSection();
		$estiloTabla = [
			"borderColor" => "000000",
			"alignment" => Jc::CENTER,
			"borderSize" => 10,
		];
		// Guardarlo para usarlo más tarde
		$documento->addTableStyle("estilo2", $estiloTabla);
		$tabla = $seccion->addTable("estilo2");
		$tabla->addRow();
		$celda = $tabla->addCell();
		$celda->addText("DESCRIPCIÓN");
		$celda = $tabla->addCell();
		$celda->addText("UNIDAD");
		$celda = $tabla->addCell();
		$celda->addText("CANTIDAD A SOLICITAR");
		for ($fila = 0; $fila < $request->get('mytext'); $fila++) {
			$tabla->addRow(); #Nueva fila
			$auxart=$request->get('idarticulo[1]');
			$auxcan=$request->get('cantidad[1]');
			$auxuni=$request->get('mytext');
			$celda = $tabla->addCell();
			$celda->addText(sprintf("%d", $auxart));
			$celda = $tabla->addCell();
			$celda->addText(sprintf("%d", $auxcan));
			$celda = $tabla->addCell();
			$celda->addText(sprintf("%d", $auxuni));
			
		}
		/Hasta aquí

		//Esta parte es solo de ejemplo
		$documento->addTableStyle("estilo2", $estiloTabla);
		$tabla = $seccion->addTable("estilo2");
		for ($fila = 0; $fila < $request->get('mytext'); $fila++) {
			$tabla->addRow();
			for ($numeroCelda = 0; $numeroCelda < 5; $numeroCelda++) {
				$celda = $tabla->addCell();
				$celda->addText(sprintf("Posición %d x %d", $fila, $numeroCelda));
			}
		}

		$filename = "myfile.docx"; // Nombre del archivo que se va a crear
		$documento->save($filename, "Word2007"); // Guardamos el archivo

		header("Content-Disposition: attachment; filename=$filename"); // Vamos a dar la opcion para descargar el archivo
		readfile($filename);  // leemos el archivo para que se "descargue"
		unlink($filename); // eliminamos el archivo del servidor


	}*/


	/* SQL
	SELECT CONCAT( art.codigo, " ", art.nombre_articulo ) 
	AS articulo, art.codigo, art.nombre_articulo, t.tipo_articulo, u.unidad 
	FROM articulos as art 
	JOIN tipos_articulo as t 
	ON art.tipo = t.idtipo_articulo 
	JOIN unidades_articulo as u 
	ON art.unidad = u.idunidad;
	*/
	public function create()
	{
		$tipo = DB::table('tipos_articulo')->get();

		$articulos = DB::table('articulos as art')
			->join('tipos_articulo as t', 'art.tipo', '=', 't.idtipo_articulo')
			->join('unidades_articulo as u', 'art.unidad', '=', 'u.idunidad')
			->select(DB::raw('CONCAT(art.codigo," ",art.nombre_articulo) AS articulo'),'art.nombre_articulo', 'art.codigo', 't.tipo_articulo', 'u.unidad')
			->get();
		return view("almacen.articulos.create", ["tipo" => $tipo, "articulos" => $articulos]);
	}


	//A partir de acá no ocupo codigo
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
