<?php

namespace sisDepartamento\Http\Controllers;

use sisDepartamento\Http\Requests;
use Illuminate\Http\Request;
use sisDepartamento\Solicitudes;
use DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    protected function downloadFile($src)
    {
        if(is_file($src)){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $content_type = finfo_file($finfo, $src);
            finfo_close($finfo);
            $file_name = basename($src).PHP_EOL;
            $size = filesize($src);
            header("Content-Type: $content_type");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $size");
            readfile($src);
            return true;
        } else{
            return false;
        }
    }
    public function download(){
        if(!$this->downloadFile(public_path()."/documentos/Ayuda/Ayuda.pdf")){
            return redirect()->back();
        }
    }
    public function index()
    {
        $atendidos = DB::table('solicitudes as soli')
            ->SELECT(DB::raw('COUNT(soli.estado) AS atendidos'))
            ->WHERE('soli.estado', '=', 'Atendido')
            ->first();
        $proceso = DB::table('solicitudes as soli')
            ->SELECT(DB::raw('COUNT(soli.estado) AS proceso'))
            ->WHERE('soli.estado', '=', 'En proceso')
            ->first();
        $cumplido = DB::table('solicitudes as soli')
            ->SELECT(DB::raw('COUNT(soli.estado) AS cumplidos'))
            ->WHERE('soli.estado', '=', 'Cumplido')
            ->first();
        $detalleat = DB::table('detalle_solicitud')
            ->join('solicitudes as soli', 'soli.idsolicitud', '=', 'detalle_solicitud.solicitud')
            ->SELECT(DB::raw('COUNT(soli.estado) AS atendidos'))
            ->WHERE('soli.estado', '=', 'Atendido')
            ->first();
        $detallepro = DB::table('detalle_solicitud')
            ->join('solicitudes as soli', 'soli.idsolicitud', '=', 'detalle_solicitud.solicitud')
            ->SELECT(DB::raw('COUNT(soli.estado) AS proceso'))
            ->WHERE('soli.estado', '=', 'En proceso')
            ->first();
        $detallecum = DB::table('detalle_solicitud')
            ->join('solicitudes as soli', 'soli.idsolicitud', '=', 'detalle_solicitud.solicitud')
            ->SELECT(DB::raw('COUNT(soli.estado) AS cumplidos'))
            ->WHERE('soli.estado', '=', 'Cumplido')
            ->first();
        return view(
            '/home',
            [
                "atendidos" => $atendidos, "proceso" => $proceso, "cumplido" => $cumplido,
                "detalleat" => $detalleat, "detallepro" => $detallepro, "detallecum" => $detallecum
            ]
        );
    }
}
