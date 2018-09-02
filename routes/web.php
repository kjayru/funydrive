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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('admin/profile','Admin\ProfileController');
Route::resource('admin/servicios','Admin\ServiceController');
Route::resource('admin/photo','Admin\PhotoController');

Route::resource('admin/solicitudes','Admin\SolicitudesController');

Route::get('admin/categorias','Admin\ServiceController@getcategory')->name('admin.categorias');
Route::post('admin/setcat','Admin\ServiceController@setcategory');
Route::put('admin/updatecat/{id}','Admin\ServiceController@updatecategory');
Route::delete('admin/borrarcat/{id}','Admin\ServiceController@borrarcat');


Route::put('admin/estado/{id}','Admin\ProfileController@estado');
Route::put('admin/estadocat/{id}','Admin\ServiceController@estadocat');
Route::put('admin/estadoparent/{id}','Admin\ServiceController@estadoparent');

//super
Route::resource('admin/listclientes','Admin\ListclientController');
Route::resource('admin/listasociados','Admin\ListpartnerController');
Route::resource('admin/listsolicitudes','Admin\ListrequestController');
Route::resource('admin/entorno','Admin\EnvironmentController');

Route::get('/admin','AdminController@index');