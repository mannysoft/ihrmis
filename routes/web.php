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

Route::group(['prefix' => 'api/v1', 'middleware' => 'api'], function () {
    Route::get('groups', 'Api\GroupController@index');
    Route::post('groups', 'Api\GroupController@store');
    Route::get('groups/{id}', 'Api\GroupController@show');

    //Route::get('companies/create', 'Api\CompanyController@create');
    Route::get('companies', 'Api\CompanyController@index');
    Route::post('companies/{id}', 'Api\CompanyController@update');
    Route::post('companies', 'Api\CompanyController@store');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/deductions', 'TestController@index');
