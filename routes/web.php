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

use App\Http\Middleware\CheckAdmin;

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.' ], function () {
        Route::any('adminer', '\Miroc\LaravelAdminer\AdminerAutologinController@index');
        Route::resource('employees', 'Admin\EmployeeController');
    });

    Route::group(['prefix' => 'employee', 'middleware' => 'employee'], function () {
    
    });

});


Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/profile', function () {

})->middleware('verified');