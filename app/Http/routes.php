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

      //Reportes
      Route::get('Dashboard', 'DashboardController@index');
      Route::post('Dashboard', 'DashboardController@dashdatos');
      Route::get('DashboardMejora/', 'DashboardController@mejora');
      Route::post('mejora/post', 'DashboardController@mejoraPost');
			//ruta para los controladores de objetivos
			Route::get('objetivos/create', 'ObjetivosController@create');
			Route::post('/objetivos/store', 'ObjetivosController@store');
			Route::post('objetivos/destroy/{id}', 'ObjetivosController@destroy');
      Route::post('/objetivos/edit/{id}','ObjetivosController@edit');

			Route::get('objetivos/visual','ObjetivosControllerVisual@create');
      Route::get('/objetivo/registro/{id}','ObjetivosControllerVisual@show');
			//rutas para los controladores de indicadores
			//Route::get('/', 'IndicadoressController@index');
			Route::get('indicadores/create', 'IndicadoressController@create');
			Route::post('/indicadores/store', 'IndicadoressController@store');
			Route::post('indicadores/destroy/{id}', 'IndicadoressController@destroy');
      Route::post('/indicadores/edit/{id}','IndicadoressController@edit');
      Route::get('/indicadores/{id}/edit','IndicadoressController@editM');
      Route::get('/indicadores/{id}/edit2','IndicadoressController@editM2');
      Route::get('/indicadores/{id}/edit23','IndicadoressController@editM23');

			//ruta para abcriesgos
			Route::get('abcriesgos/create', 'AbcriesgosController@create');
			Route::post('abcriesgos/store', 'AbcriesgosController@store');
			Route::delete('abcriesgos/destroy/{id}', 'AbcriesgosController@destroy');
      Route::post('abcriesgos/edit/{id}', 'AbcriesgosController@edit');


			//ruta para quejas
			Route::get('quejas/create', 'QuejasController@create');
			Route::post('quejas/store', 'QuejasController@store');
      Route::post('quejas/delete/{id}', 'QuejasController@destroy');
      Route::post('quejas/edit/{id}', 'QuejasController@edit');

			//rutas para no conformidades
			Route::get('noconformidad/create', 'NoconformidadesController@create');
			Route::post('noconformidad/store', 'NoconformidadesController@store');
      Route::post('noconformidad/edit/{id}', 'NoconformidadesController@edit');
      Route::delete('noconformidad/delete/{id}', 'NoconformidadesController@destroy');

			//ruta para procesos
			Route::get('procesos/create', 'ProcesosController@create');
		// ruta para controladores de procesosQ
		//Route::get('/procesos/create',function() {  return view('procesos');});
		Route::get('/procesos/visual','ProcesosControllerVisual@create');
		Route::get('/procesos/create','ProcesosController@create');
		Route::post('/procesos/store','ProcesosController@store');
		Route::post('/procesos/edit/{id}','ProcesosController@show');
		Route::post('/procesos/edit/{id}','ProcesosController@edit');
		Route::post('/procesos/delete/{id}','ProcesosController@destroy');
		Route::get('/procesos/visual/{id}','ProcesosControllerVisual@visualzip');
    Route::get('/procesos/registro/{id}','ProcesosControllerVisual@show');
    Route::get('/bizagi/{id}','ProcesosControllerVisual@ver');


		//ruta para Resultados
		Route::get('/resultado/index','ResultadoController@index');
		Route::get('resultado/create', 'ResultadoController@create');
		Route::post('resultado/store', 'ResultadoController@store');
		Route::delete('resultado/destroy/{id}', 'ResultadoController@destroy');
    Route::get('/resultado/registro/{id}','ResultadoController@show');
    Route::post('/resultado/edit/{id}','ResultadoController@edit');


    //Rutas del menu
    Route::get('/objetivosindicadores', 'MenuController@objetivos');
    Route::get('/riesgos', 'MenuController@riesgos');
    Route::get('/mejoras', 'MenuController@mejoras');
    Route::get('/admin', 'MenuController@admin');
    Route::get('/infdocumentada', 'MenuController@infdocumentada');
    //Route::get('/Promejoras', 'MenuController@promejoras');

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

    //Rutas para analisis Riesgo
    //ruta para mapa de calor
    Route::get('/mapadecalor','mapadecalorController@index');
    Route::post('/mapadecalor','mapadecalorController@indexfiltros');

    Route::get('/riesgos/create', 'AnalisisriesgosController@create');
    Route::get('/analisisrisk/registro/{id}','AnalisisriesgosController@show');
    Route::post('/analisisrisk/store','AnalisisriesgosController@store');
    Route::delete('/analisisrisk/destroy/{id}','AnalisisriesgosController@destroy');
    Route::post('/analisisrisk/edit/{id}','AnalisisriesgosController@edit');

    //rutas para acciones correctivas
    Route::get('/accioncorrectiva','AccionescorrectivasControllerVisual@index');
    Route::post('/accioncorrectiva/store','AccionescorrectivasControllerVisual@store');
    Route::get('/subirevidencia','AccionescorrectivasControllerVisual@subirevidencia');
    Route::get('/subirevidencia/evidencia/{id}','AccionescorrectivasControllerVisual@show');
    Route::post('/guardar/evidencia','AccionescorrectivasControllerVisual@guardarevidiencia');
    Route::get('/accioncorrectiva/descarga','AccionescorrectivasControllerVisual@descargar');

    //Rutas para administrador
    // Productos y servicios
    Route::get('/productos','AdministradosController@productos');
    Route::post('productos/store', 'AdministradosController@productostore');
		Route::delete('productos/destroy/{id}', 'AdministradosController@productosdestroy');
    Route::post('productos/edit/{id}', 'AdministradosController@productosedit');

    //Clientes
    Route::get('/clientes','AdministradosController@clientes');
    Route::post('clientes/store', 'AdministradosController@clientestore');
		Route::delete('clientes/destroy/{id}', 'AdministradosController@clientesdestroy');
    Route::post('clientes/edit/{id}', 'AdministradosController@clientesedit');

    //Areas
    Route::get('/areas','AdministradosController@areas');
    Route::post('areas/store', 'AdministradosController@areastore');
		Route::delete('areas/destroy/{id}', 'AdministradosController@areasdestroy');
    Route::post('areas/edit/{id}', 'AdministradosController@areasedit');


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

    //mejoras
    Route::get('/Promejoras','MejorasController@index');
    Route::get('/lean/create','MejorasController@leancreate');
    Route::post('/lean/guardar','MejorasController@guardaretapa');
    Route::delete('/etapa/eliminaretapa/{id}','MejorasController@eliminaretapa');
    Route::delete('/mejora/delete/{id}', 'MejorasController@eliminarmejora');

    //sixsigma
    Route::get('/sigma/create','MejorasController@sigmacreate');

    //alta de bpm
    Route::get('/bpm/create','MejorasController@bpmcreate');

    //storelean
    Route::post('/lean/storelean','MejorasController@storelean');
    Route::get('/subiretapa/etapa/{id}','MejorasController@subiretapas');
    Route::post('/modificar/lean/{id}','MejorasController@modificarlean');

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


    Route::post('cambioempresa/edit', 'BienvenidaController@cambioempresa');
    //Ruta crear noticia
    Route::post('/administrados/noticiastore', 'AdministradosController@noticiastore');
    Route::get('/administrados/noticiastore', function(){

      return redirect('/Bienvenida');
    });
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