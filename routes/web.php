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
Route::get('login/{driver}','Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback','Auth\LoginController@handleProviderCallback');

Route::get('/', 'HomeController@index');
Route::get('/getpostal/{code}','HomeController@getPostal');
Route::post('/getmodel','HomeController@getModel');
Route::get('/getservice/{id}/edit','HomeController@getservice');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/verificar', 'HomeController@verifyUser');
Route::get('/pruebagcm','HomeController@pruebdesarrollo');



Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::get('/','AdminController@index')->name('admin');
    Route::get('/registrowork','Admin\RegisterController@index')->name('admin.registrojob');
    //Route::post('/registrowork','Admin\RegisterController@registrowork');    
    Route::resource('/profile','Admin\ProfileController');
    Route::resource('/servicios','Admin\ServiceController');
    Route::resource('/photo','Admin\PhotoController');  
    Route::resource('/solicitudes','Admin\SolicitudesController');  
    Route::get('/categorias','Admin\ServiceController@getcategory')->name('admin.categorias');
    Route::post('/setcat','Admin\ServiceController@setcategory');
    Route::put('/updatecat/{id}','Admin\ServiceController@updatecategory');
    Route::delete('/borrarcat/{id}','Admin\ServiceController@borrarcat');  
    Route::put('/estado/{id}','Admin\ProfileController@estado');
    Route::put('/estadocat/{id}','Admin\ServiceController@estadocat');
    Route::put('/estadoparent/{id}','Admin\ServiceController@estadoparent');
    
    //super
    Route::resource('/listclientes','Admin\ListclientController');

    Route::put('/listclientes/estado/{id}','Admin\ListclientController@estado');


    Route::resource('/listasociados','Admin\ListpartnerController');
    Route::resource('/listsolicitudes','Admin\ListrequestController');
    Route::resource('/entorno','Admin\EnvironmentController');

    Route::get('/marca','Admin\CarController@index');
    Route::get('/marca/{id}','Admin\CarController@getmarca');
    Route::get('/marca/{id}/edit','Admin\CarController@editmarca');
    Route::post('/marca','Admin\CarController@storemarca');
    Route::put('/marca/{id}','Admin\CarController@updatemarca');
    Route::delete('/marca/{id}','Admin\CarController@deletemarca');

    Route::get('/modelo','Admin\CarController@modelcar');
    Route::get('/modelo/{id}','Admin\CarController@getmodelo');
    Route::get('/modelo/{id}/edit','Admin\CarController@editmodelo');
    Route::post('/modelo','Admin\CarController@storemodelo');
    Route::put('/modelo/{id}','Admin\CarController@updatemodelo');
    Route::delete('/modelo/{id}','Admin\CarController@deletemodelo');

    Route::get('/getyear/{id}','Admin\CarController@getyear');

    //asociado
    Route::get('/dashboard','Admin\DashAsociadoController@index')->name('admin.dashboard');
    Route::post('/responder','Admin\RegisterController@responderJob');
    Route::post('/rechazar','Admin\RegisterController@rechazarJob');
    Route::get('/orden/{any}/edit','Admin\RegisterController@editarJob');
    Route::put('/actualizar/{any}','Admin\RegisterController@updateJob');
    Route::get('/getfecha/{any}','Admin\RegisterController@getFecha');
    Route::patch('/cambiofecha/{any}','Admin\RegisterController@actualizarFecha');
    Route::get('/estados','Admin\ListrequestController@estados');
    Route::put('/cambioestado/{any}','Admin\ListrequestController@cambioestado');
    Route::get('/valorar','Admin\ListrequestController@getmensajes');
    Route::put('/setvalorar/{any}','Admin\ListrequestController@setvalorar');
});
Route::resource('/servicios','ServiceController');
Route::post('/buscarservicio','HomeController@buscarservicio');