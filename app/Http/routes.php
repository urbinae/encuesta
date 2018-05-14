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
/*
Route::get('/', function () {
    return view('welcome_auth');
});
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/buscarEncuesta/{id}', 'HomeController@buscarEncuesta')->name('buscarEncuesta');
Route::get('/realizar_encuesta/{id}', 'HomeController@encuesta')->name('realizar_encuesta');

// rest para encuestas
//Route::resource('encuesta','EncuestaController');
Route::resource('encuestas', 'EncuestaController');
Route::get('encuestas', [
	'as' => 'encuestas.index',
	'uses' => 'EncuestaController@index'
]);
// rest para preguntas
Route::resource('pregunta','PreguntaController');

// rest para respuesta
Route::resource('respuesta','RespuestaController');

// las encuestas para motrar en el data table
Route::get('/indexDataTable', 'EncuestaController@indexDataTable')->name('indexDataTable');


Route::auth();

//Route::get('/home', 'HomeController@index');
