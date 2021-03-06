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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('addemployee','EmployeeController');
//Route::post('/addemployee','EmployeeController@add_employee')->name('addemployee');
Route::get('/editemployee/{id?}','EmployeeController@editEmployee')->name('editemployee');
Route::post('/updateemployee','EmployeeController@updateEmployee')->name('updateemployee');
Route::get('/employee','EmployeeController@getEmployee')->name('viewemployee');
Route::post('/employee','EmployeeController@addDisaction')->name('adddisaction');
Route::get('/disaction/{id?}','EmployeeController@getDisaction')->name('viewdisaction');
Route::get('/editdisaction/{id?}','EmployeeController@editDisaction')->name('editdisaction');
Route::post('/updatedisaction/{id?}','EmployeeController@updateDisaction')->name('updatedisaction');
Route::get('/deletedisaction/{id?}','EmployeeController@destroyDisaction')->name('deletedisaction');
