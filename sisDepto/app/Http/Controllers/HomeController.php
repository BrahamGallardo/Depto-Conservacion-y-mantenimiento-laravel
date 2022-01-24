<?php

namespace sisDepartamento\Http\Controllers;

use sisDepartamento\Http\Requests;
use Illuminate\Http\Request;
use sisDepartamento\Solicitudes;
use DB;

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
