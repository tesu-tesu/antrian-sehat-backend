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
Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix'=>'auth','as'=>'auth.'], function (){
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh', 'AuthController@refresh')->name('refresh');
    });

    Route::group(['prefix'=>'user'], function (){
        Route::post('change-password/{user}', 'UserController@changePassword')
            ->name('user.change-password');
        Route::post('change-image/{user}', 'UserController@changeImage')
            ->name('user.change-image');

        Route::get('polymaster/{healthAgency}/', 'HealthAgencyController@userShowPolymaster')
            ->name('user.show-polymaster')->middleware('roleUser:Pasien');
        Route::get('health-agency/{polymaster}/', 'PolyclinicController@userShowHealthAgency')
            ->name('user.show-health-agency')->middleware('roleUser:Pasien');

        Route::post('search/', 'HealthAgencyController@searchHealthAgency')
            ->name('user.search-health-agency')->middleware('roleUser:Pasien');
        Route::get('get-waiting-list/', 'WaitingListController@getWaitingList')
            ->name('user.get-waiting-list')->middleware('roleUser:Pasien');
        Route::post('create-waiting-list/', 'WaitingListController@createWaitingList')
            ->name('user.create-waiting-list')->middleware('roleUser:Pasien');
        Route::get('show-nearest-waiting-list/', 'HomeController@showNearestWaitingList')
            ->name('user.show-nearest-waiting-list')->middleware('roleUser:Pasien');


        Route::get('show-schedule/{polymaster}', 'ScheduleController@showSchedule')
            ->name('user.show-schedule')->middleware('roleUser:Pasien');

    });
    Route::resource('user', 'UserController');
});

Route::group(['prefix'=>'auth','as'=>'auth.'], function (){
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'admin'], function (){
   Route::group(['prefix' => 'health-agency', 'as' => 'health-agency.'], function (){
        Route::get('{healthAgency}/polyclinic', 'HealthAgencyController@adminShowPolyclinic')
            ->name('show-polyclinic');
        Route::get('waiting-list', 'HealthAgencyController@showWaitingList')
            ->name('show-waiting-list');
   });
    Route::resource('health-agency', 'HealthAgencyController')->middleware('roleUser:Admin');

   Route::resource('poly-master', 'PolyMasterController')->middleware(['roleUser:Admin', 'roleUser:Super Admin']);
   Route::resource('schedule', 'ScheduleController')->middleware('roleUser:Admin');
   Route::resource('polyclinic', 'PolyclinicController')->middleware('roleUser:Admin');
   Route::resource('waiting-list', 'WaitingListController')->middleware('roleUser:Admin');
});
