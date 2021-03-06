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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::any('/', array( 'as' => 'home', 'uses' => 'UserRegestrationController@index' ));

Auth::routes();



// Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserRegestrationController@index');
Route::get('/users_add', 'UserRegestrationController@create');
Route::post('/users_create', 'UserRegestrationController@store');

Route::get('/get_points', 'UserPointsController@index');
Route::get('/points_add', 'UserPointsController@create');
Route::post('/points_create', 'UserPointsController@store');

Route::get('/get_reference', 'UserPointsController@reference_index');
Route::post('/show_reference', 'UserPointsController@reference');
// });