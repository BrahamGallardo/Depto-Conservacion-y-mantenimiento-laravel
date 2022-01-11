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

class OrdenesController extends Controller
{
    public function index(Request $request)
    {//->SELECT('or.num_orden', 'of.unidad', 'or.partida', 'of.programa','pro.proveedor', 'or.fecha')
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


    public function generar(Request $request)
	{
		try {
			$template = new \PhpOffice\PhpWord\TemplateProcessor('OrdenPlantilla.docx');
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
}
