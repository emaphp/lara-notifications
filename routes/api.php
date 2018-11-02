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
Route::get('/employees/breakfast-list', 'EmployeeController@getBreakfastList')->name('api.theBreakfastClub');
//Route::apiResource('employees', 'EmployeeController');

Route::get('/pending_events/{year}/{month}','EventListController@getPendingEvents')->name('api.pendingEvents');
