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

Route::get('/notifications/{user_id}', 'NotificationController@getUnreadNotifications')->name('api.unreadNotifications');

Route::put('/notifications/{notification_id}/{user_id}', 'NotificationController@markNotificationAsRead')->name('api.markNotificationAsRead');

Route::get('/employees/quantity', 'EmployeeController@getEmployeeQuantity');
//Route::apiResource('employees', 'EmployeeController');

Route::get('/pending_events/{year}/{month}','EventListController@getPendingEvents')->name('api.pendingEvents');

Route::get('/breakfastList' , 'BreakfastListController@getBreakfastEmployeeList')->name('api.breakfastList');

Route::post('/twilio','TwilioController@messageResponse')->name('twilio');

Route::get('/breakfastHistorial', 'BreakfastHistorialCrontroller@getBreakfastHistorial')->name('api.breakfastHistorial');

Route::get('/filePickerComponent', 'FilePickerController@getFilePicker')->name('api.filePicker');
Route::put('/saveProfileFilePickerComponent', 'FilePickerController@setFilePicker')->name('api.setFilePicker');
Route::get('/events/{slug}' , 'EventController@getEvent')->name('api.eventDescription');
