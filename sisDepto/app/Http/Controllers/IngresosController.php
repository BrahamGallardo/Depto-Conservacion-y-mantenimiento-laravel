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
                ->SELECT('i.idingreso', 'i.fecha_hora', 'i.archivo', 'i.estado')
                ->where('i.idingreso', 'LIKE', '%' . $query . '%')
                ->orwhere('i.estado', 'LIKE', '%' . $query . '%')
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
            $ingreso->fecha_hora = $mytime->toDateString();
            $ingreso->estado = 'Pendiente';
            $ingreso->save();

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
        $arts = DB::table('detalle_ingreso AS d')
            ->JOIN('articulos AS art', 'd.cod_articulo', '=', 'art.codigo')
            ->JOIN('unidades_articulo AS u', 'art.unidad', '=', 'u.idunidad')
            ->SELECT('art.nombre_articulo', 'd.cantidad', 'd.idingreso', 'u.unidad')
            ->WHERE('d.idingreso', '=', $id)
            ->first();
        return view("almacen.ingresos.show", ["ingresos" => $ingresos, "detalles" => $detalles, "arts" => $arts]);
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

    public function generar(Request $request)
    {
        $detalles = DB::table('detalle_ingreso AS d')
            ->JOIN('articulos AS art', 'd.cod_articulo', '=', 'art.codigo')
            ->JOIN('unidades_articulo AS u', 'art.unidad', '=', 'u.idunidad')
            ->SELECT('art.nombre_articulo', 'd.cantidad', 'art.codigo', 'u.unidad')
            ->WHERE('d.idingreso', '=', $request->get('vingreso') )
            ->get();

        //Aqui inicia el documento
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
        $fuente3 = [
            "name" => "Arial",
            "size" => 10,
            "color" => "000000",
            "bold" => true,
            "alignment" => Jc::CENTER #este no lo centra
        ];
        $estilo = $seccion->addTextRun([
            "alignment" => Jc::RIGHT,
            'lineHeight' => 1.5,
        ]);
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, "es_MX.UTF-8"); #Esta parte no cambia el idioma
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
            "name" => "Arial",
            "size" => 10,
            "color" => "000000"
        ]; 

        // Guardarlo para usarlo más tarde
        $documento->addTableStyle("estilo2", $estiloTabla);
        $tabla = $seccion->addTable("estilo2");
        $tabla->addRow();
        $celda = $tabla->addCell();
        $celda->addText("DESCRIPCIÓN", $fuente3);
        $celda = $tabla->addCell();
        $celda->addText("UNIDAD", $fuente3);
        $celda = $tabla->addCell();
        $celda->addText("CANTIDAD SOLICITADA", $fuente3);
        foreach($detalles as $det) {
            $tabla->addRow(); #Nueva fila
            $celda = $tabla->addCell();
            $celda->addText($det->nombre_articulo);
            $celda = $tabla->addCell();
            $celda->addText($det->cantidad);
            $celda = $tabla->addCell();
            $celda->addText($det->unidad);
        }
        //Hasta aquí
        //inicia pie de pagina
        $estilo = $seccion->addTextRun([
            "alignment" => Jc::BOTH,
            'lineHeight' => 1
        ]);
        $estilo->addTextBreak(1);
        $estilo->addText("En espera de su valoración a lo solicitado, quedo de usted y reciba un cordial saludo.", $fuente2);
        $estilo = $seccion->addTextRun([
            "alignment" => Jc::CENTER
        ]);
        $estilo->addTextBreak(1);
        $estilo->addTextBreak(1);
        $estilo->addTextBreak(1);
        $estilo->addText("A T E N T A M E N T E", $fuente1);
        $estilo->addTextBreak(1);
        $estilo->addTextBreak(1);
        $estilo->addTextBreak(1);
        $estilo->addTextBreak(1);
        $estilo->addText("C. JESUS ANTONIO DIAZ MONTAÑO", $fuente1);
        $estilo->addTextBreak(1);
        $estilo->addText("ENCARGADO DEL ALMACEN DEL DEPARATAMENTO", $fuente1);
        $estilo->addTextBreak(1);
        $estilo->addText("DE CONSERVACION Y MANTENIMIENTO", $fuente1);

        $filename = "Solicitud.docx"; // Nombre del archivo que se va a crear
        $documento->save($filename, "Word2007"); // Guardamos el archivo

        header("Content-Disposition: attachment; filename=$filename"); // Vamos a dar la opcion para descargar el archivo
        readfile($filename);  // leemos el archivo para que se "descargue"
        unlink($filename); // eliminamos el archivo del servidor

    }
}
