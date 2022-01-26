<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('administracion/trabajadores', 'TrabajadorController');
Route::resource('administracion/solicitudes', 'SolicitudController');
Route::resource('administracion/seguimiento', 'DetalleSolicitudController');
Route::resource('administracion/ordenes', 'OrdenesController');
Route::resource('administracion/proveedores', 'ProveedoresController');
Route::resource('administracion/coordinacion', 'CoordinacionController');
Route::resource('almacen/articulos', 'ArticuloController');
Route::resource('almacen/ingresos', 'IngresosController');
Route::resource('almacen/egresos', 'EgresosController');
Route::resource('seguridad/usuario', 'UsuarioController');

Route::resource('evento', 'ControllerEvent');
Route::get('evento/details/{id}','ControllerEvent@details');
Route::get('evento/index','ControllerEvent@index');
Route::get('evento/index/{month}','ControllerEvent@index_month');
Route::post('evento/calendario','ControllerEvent@calendario');

Route::get('almacen/solicitar/{id}', 'ArticuloController@solicitar');
Route::get('seguimiento/buscar', 'DetalleSolicitudController@buscar');
Route::get('/download', 'IngresosController@generar');
Route::get('/downloadorden', 'OrdenesController@generar');
Route::get('/activar/{id}','IngresosController@activar');
Route::auth();

Route::get('/home', 'HomeController@index');
