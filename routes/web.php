<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    return view('pruebas');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inicial', 'SesionController@index');

Route::group(['prefix'=>'distribuidor','middleware'=>'auth'],function(){

	route::get('envios/enviar_parcial',[
		'uses' =>'EnviosController@enviar_parcial',
		'as'   =>	'envios.enviar_parcial'
	]);
	
	route::get('envios/{id}/enviar',[
		'uses' =>'EnviosController@enviar',
		'as'   =>	'envios.enviar'
	]);

	route::get('envios/{id}/envio_parcial',[
		'uses' =>'EnviosController@envio_parcial',
		'as'   =>	'envios.envio_parcial'
	]);

	route::get('envios/modal_parcial',[
		'uses' =>'EnviosController@modal_parcial',
		'as'   =>	'envios.modal_parcial'
	]);

	route::get('envios/index_aprobados',[
		'uses' =>'EnviosController@index_aprobados',
		'as'   =>	'envios.index_aprobados'
	]);

	route::get('envios/{id}/aprobar',[
		'uses' =>'EnviosController@aprobar',
		'as'   =>	'envios.aprobar'
	]);

	route::get('envios/{id}/renovar_chassis',[
		'uses' =>'EnviosController@renovar_chassis',
		'as'   =>	'envios.renovar_chassis'
	]);

	route::get('envios/index_espera',[
		'uses' =>'EnviosController@index_espera',
		'as'   =>	'envios.index_espera'
	]);

	route::get('envios/{id}/aprobacion',[
		'uses' =>'EnviosController@aprobacion',
		'as'   =>	'envios.aprobacion'
	]);

	route::get('envios/{id}/espera',[
		'uses' =>'EnviosController@espera',
		'as'   =>	'envios.espera'
	]);

	route::get('envios/{id}/addDetalle',[
		'uses' =>'EnviosController@addDetalle',
		'as'   =>	'envios.addDetalle'
	]);	

	route::get('envios/{id}/detalle',[
		'uses' =>'EnviosController@detalle',
		'as'   =>	'envios.detalle'
	]);

	route::get('envios/{id}/{id2}/quitar_detalle',[
		'uses' =>'EnviosController@quitar_detalle',
		'as'   =>	'envios.quitar_detalle'
	]);

	route::get('envios/{id2}/{id}quitar_chassis',[
		'uses' =>'EnviosController@quitar_chassis',
		'as'   =>	'envios.quitar_chassis'
	]);

	route::get('envios/{id}editar_detalle',[
		'uses' =>'EnviosController@editar_detalle',
		'as'   =>	'envios.editar_detalle'
	]);
	route::get('envios/{id}update_detalle',[
		'uses' =>'EnviosController@update_detalle',
		'as'   =>	'envios.update_detalle'
	]);
	
	route::get('envios/{id}/{id2}/detalle_all',[
		'uses' =>'EnviosController@detalle_all',
		'as'   =>	'envios.detalle_all'
	]);

	route::resource('envios','EnviosController');
	
	route::resource('principal','PrincipalController');
	route::resource('vehiculos','VehiculosController');

	route::get('stock',[
		'uses' =>'VehiculosController@stock',
		'as'   =>	'vehiculos.stock'
	]);

	route::get('{id}/{id2}/{id4}/modelos',[
		'uses' => 'VehiculosController@modelos', 
		'as'   => 'vehiculos.modelos'
	]);

	route::get('{id}/{id2}/{id3}/{id4}/master',[
		'uses' => 'VehiculosController@master', 
		'as'   => 'vehiculos.master'
	]);

	route::get('{id}/{id1}/{id2}/{id3}/{id4}/det_vehiculos',[
		'uses' => 'VehiculosController@det_vehiculos', 
		'as'   => 'vehiculos.det_vehiculos'
	]);

	route::resource('stocks','AsignacionStocksController');

	
});