<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//route untuk bagian login
Route::group(['middleware' => ['api']], function(){
    Route::post('auth/register','AuthController@Register');
    Route::post('auth/login','AuthController@Login');



        //route untuk bagian crud
        Route::group(['middleware' => ['jwt.auth']], function(){

              //untuk nampilin data siswa 
              Route::get('/profile','UserController@show');
              //untuk crud Mata Pelajaran
              Route::get('/mapel','MapelController@index');
              Route::get('/mapel/{slug}','MapelController@show');
              Route::post('/mapel','MapelController@store');
              Route::put('/mapel/{id}','MapelController@update');
              Route::delete('/mapel/{id}','MapelController@destroy');

              //Absen
              Route::post('/absen','AbsenController@store');


        });


});
