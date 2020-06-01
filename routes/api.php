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

Route::pattern('id', '[0-9]+');

Route::group(['prefix' => 'auth'], function () {

    Route::post('token', 'AuthController@login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::delete('token', 'AuthController@logout');
        Route::get('permissions', 'AuthController@permissions');
        Route::get('roles', 'AuthController@roles');
        Route::get('teams', 'AuthController@teams');
    });
});

// Punishment module : 'middleware' => 'auth:api',
Route::group(['prefix' => 'punishments'], function () {

    Route::group(['prefix' => 'chores'], function () {
        Route::get('/', 'Punishment\ChoreController@index');
        Route::get('/search', 'Punishment\ChoreController@search');
        Route::post('/', 'Punishment\ChoreController@create');
        Route::get('/{id}', 'Punishment\ChoreController@find');
        Route::match(['post', 'put'], '/{id}', 'Punishment\ChoreController@update');
        Route::delete('/{id}', 'Punishment\ChoreController@destroy');
    });

    Route::group(['prefix' => 'infractions'], function () {
        Route::get('/', 'Punishment\InfractionController@index');
        Route::get('/search', 'Punishment\InfractionController@search');
        Route::post('/', 'Punishment\InfractionController@create');
        Route::get('/{id}', 'Punishment\InfractionController@find');
        Route::match(['post', 'put'], '/{id}', 'Punishment\InfractionController@update');
        Route::delete('/{id}', 'Punishment\InfractionController@destroy');
    });

    Route::group(['prefix' => 'sanctions'], function () {
        Route::get('/', 'Punishment\SanctionController@index');
        Route::get('/search', 'Punishment\SanctionController@search');
        Route::post('/', 'Punishment\SanctionController@create');
        Route::get('/{id}', 'Punishment\SanctionController@find');
        Route::match(['post', 'put'], '/{id}', 'Punishment\SanctionController@update');
        Route::delete('/{id}', 'Punishment\SanctionController@destroy');
    });

});