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


Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::get('/','AdminController@index');
    Route::get('/registrowork','Admin\RegisterController@index');
    Route::post('/registrowork','Admin\RegisterController@registrowork');    
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
    Route::resource('/listasociados','Admin\ListpartnerController');
    Route::resource('/listsolicitudes','Admin\ListrequestController');
    Route::resource('/entorno','Admin\EnvironmentController');

    Route::get('/marca','Admin\CarController@index');
    Route::get('/modelo','Admin\CarController@modelcar');
});
Route::resource('/servicios','ServiceController');