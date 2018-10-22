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

// This route has the auth middleware defined in the constructor
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);


Route::group(['middleware' => 'verified'], function () {
    Route::get('/profile', function () {

    });
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function(){
        return view("/home");
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.' ], function () {
        Route::any('adminer', '\Miroc\LaravelAdminer\AdminerAutologinController@index');

        Route::resource('tags', 'Admin\TagController');
        Route::resource('employees', 'Admin\EmployeeController');
        Route::resource('events', 'Admin\EventController');
    });

    Route::group(['prefix' => 'employee', 'middleware' => 'employee'], function () {
    
    });

});
