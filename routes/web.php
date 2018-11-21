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
    Route::get('/', function () {
        return view('/home');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.' ], function () {
        Route::any('adminer', '\Miroc\LaravelAdminer\AdminerAutologinController@index');

        Route::resource('tags', 'Admin\TagController');
        Route::resource('employees', 'Admin\EmployeeController');
        Route::resource('events', 'Admin\EventController');
        Route::resource('places', 'Admin\PlaceController');

        Route::get('/breakfast/add_user', 'Admin\BreakfastController@view_add_user')->name('breakfast.view_add_user');
        Route::get('/breakfast/remove_user', 'Admin\BreakfastController@view_remove_user')->name('breakfast.view_remove_user');
        Route::get('/breakfast/reassign_delegate', 'Admin\BreakfastController@view_reassign_delegate')->name('breakfast.view_reassign_delegate');
        Route::post('/breakfast/add', 'Admin\BreakfastController@add_user')->name('breakfast.add_user');
        Route::post('/breakfast/remove', 'Admin\BreakfastController@remove_user')->name('breakfast.remove_user');
        Route::post('/breakfast/reassign', 'Admin\BreakfastController@reassign_delegate')->name('breakfast.reassign_delegate');
        Route::get('/breakfast/exportXLS', 'Admin\BreakfastController@exportXLS')->name('breakfast.exportXLS'); 
        Route::get('/breakfast/exportCSV', 'Admin\BreakfastController@exportCSV')->name('breakfast.exportCSV'); 
        Route::resource('breakfast', 'Admin\BreakfastController');
    });

    Route::group(['middleware' => 'employee'], function () {
        Route::resource('notifications', 'Employee\NotificationController');
        Route::resource('profile', 'Employee\ProfileController');
        Route::resource('events', 'Employee\EventController');
        Route::get('/breakfast', function() {
            return view('/employee/breakfast/index');
        })->name('breakfast');
    });


   

});
