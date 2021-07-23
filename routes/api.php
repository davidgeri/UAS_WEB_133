<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('password', function(){
    return bcrypt('david');
});



//news
Route::get('news', 'API\NewsController@index');
Route::get('news/{data}', 'API\NewsController@show');
// Route Hapus Data
Route::delete('news/{data}', 'API\NewsController@destroy')->middleware('auth:api');
// Route Tambah Data
Route::post('news',  'API\NewsController@store')->middleware('auth:api');
// Route Update Data
Route::patch('news/{id}', 'API\NewsController@update')->middleware('auth:api');


//reporter
Route::get('reporter',  'API\ReporterController@index');
Route::get('reporter/{data}',  'API\ReporterController@show');
// Route Hapus Data
Route::delete('reporter/{data}',  'API\ReporterController@destroy')->middleware('auth:api');
// Route Tambah Data
Route::post('reporter',  'API\ReporterController@store')->middleware('auth:api');
// Route Update Data
Route::patch('reporter/{id}',  'API\ReporterController@update')->middleware('auth:api');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});