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


//bienvenida al iniciar sesion
//Route::get('/', 'BienvenidaController@show');

//ruta para Dashboard
Route::get('/', 'LoginController@index');
//Rutas para vistas del usuario
Route::get('/contacto', 'BienvenidaController@contacto');
Route::post('/mail', 'BienvenidaController@mail');

Route::get('/password/email', 'Auth\PasswordController@getEmail');
Route::post('/password/email', 'Auth\PasswordController@postEmail');

Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset');

Route::group( ['middleware' => 'auth'],
    function(){
      //Entradas
			Route::get('bienvenida/', 'BienvenidaController@show');

      //Admin
    Route::get('/admin', 'MenuController@admin');

    //Rutas Menu informacion documentada
    Route::get('/infdocumentos', 'MenuinfController@infdocumentos');
    Route::get('/infestrategia', 'MenuinfController@infestrategia');
    Route::get('/infprocesos', 'MenuinfController@infprocesos');
    Route::get('/infriesgos', 'MenuinfController@infriesgos');
    Route::get('/infrecursos', 'MenuinfController@infrecursos');
    Route::get('/infoperacion', 'MenuinfController@infoperacion');
    Route::get('/infevaluacion', 'MenuinfController@infevaluacion');
    Route::get('/infmejora', 'MenuinfController@infmejora');

    //Rutas submenus de informacion documentada
    Route::get('/recpersonal', 'MenuinfController@recpersonal');
    Route::get('/recinfraestructura', 'MenuinfController@recinfraestructura');
    Route::get('/recmedicion', 'MenuinfController@recmedicion');

    Route::get('/evacontrol', 'MenuinfController@evacontrol');
    Route::get('/evaincidentes', 'MenuinfController@evaincidentes');
    Route::get('/evainternas', 'MenuinfController@evainternas');
    Route::get('/operacioninf', 'MenuinfController@operacioninf');

    //Rutas para administrador
    //Empresas
    Route::get('/perfil','AdministradosController@index');
    Route::get('/empresas','AdministradosController@empresas');
    Route::post('empresas/store', 'AdministradosController@empresastore');
		Route::delete('empresas/destroy/{id}', 'AdministradosController@empresasdestroy');
    Route::post('empresas/edit/{id}', 'AdministradosController@empresasedit');

    //Usuarios
    Route::get('/usuarios','AdministradosController@usuarios');
    Route::post('usuarios/store', 'AdministradosController@usuariostore');
    Route::delete('usuarios/destroy/{id}', 'AdministradosController@usuariosdestroy');
    Route::post('usuarios/edit/{id}', 'AdministradosController@usuariosedit');

    //Documentos (Mostrar, crear y editar)
    Route::get('/documentada/{id}','InformaciondocController@mostrar');
    Route::get('/documento/{id}','InformaciondocController@ver');
    Route::post('/documentada/store', 'InformaciondocController@store');
    Route::delete('/documentada/destroy/{id}', 'InformaciondocController@destroy');
    Route::post('/documentada/edit/{id}', 'InformaciondocController@editM');
    Route::get('/documentada/{id}/edit', 'InformaciondocController@edit');
    Route::get('/documentada/{id}/edit2', 'InformaciondocController@edit2');
    Route::get('/documentada/{id}/edit23', 'InformaciondocController@edit23');

    //Admin documentos
    Route::get('/documentada', 'AdministradosController@documentos');
    Route::post('/aprobacion/{id}', 'InformaciondocController@aprobar');
    Route::post('/denegar/{id}', 'InformaciondocController@denegar');
    Route::post('/aprobartodo', 'InformaciondocController@aprobartodo');

    Route::get('/documentoseliminados', 'AdministradosController@doceliminados');
    Route::delete('/doceliminar/destroy/{id}', 'InformaciondocController@doceliminar');


    Route::post('cambioempresa/edit', 'BienvenidaController@cambioempresa');
    }
);


Route::get('admin/auth/login', [
	'uses' => 'Auth\AuthController@getLogin',
	'as'	=>	'admin.auth.login'
]);


Route::post('admin/auth/login', [
	'uses' => 'Auth\AuthController@postLogin',
	'as'	=>	'admin.auth.login'
]);


Route::get('admin/auth/logout', [
	'uses' => 'Auth\AuthController@getLogout',
	'as'	=>	'admin.auth.logout'
]);
