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

Route::post('login', 'AuthController@login');
Route::post('addemployee','EmployeeApiController@add_employee');
Route::post('updateemployee','EmployeeApiController@updateEmployee');
Route::get('getemployee/{id?}','EmployeeApiController@getEmployee');
Route::post('adddisaction','EmployeeApiController@addDisaction');
Route::get('getdisaction/{id?}','EmployeeApiController@getDisaction');
Route::post('updatedisaction','EmployeeApiController@updateDisaction');
Route::get('deletedisaction/{id?}','EmployeeApiController@destroyDisaction');


