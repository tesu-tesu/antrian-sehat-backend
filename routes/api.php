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

    Route::resource('user', 'UserController');
    Route::group(['prefix'=>'user'], function (){
        Route::post('change-password/{user}', 'UserController@changePassword')
            ->name('user.change-password');
        Route::post('change-image/{user}', 'UserController@changeImage')
            ->name('user.change-image');

        Route::get('polymaster/{healthAgency}/', 'HealthAgencyController@userShowPolymaster')
            ->name('user.show-polymaster')->middleware('isPasien');
        Route::get('health-agency/{polymaster}/', 'PolyclinicController@userShowHealthAgency')
            ->name('user.show-health-agency')->middleware('isPasien');
    });
});

Route::group(['prefix'=>'auth','as'=>'auth.'], function (){
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'admin'], function (){
   Route::group(['prefix' => 'health-agency', 'as' => 'health-agency.'], function (){
        Route::get('{healthAgency}/polyclinic', 'HealthAgencyController@adminShowPolyWithSchedule')
            ->name('show-poly-with-schedule');
        Route::get('waiting-list', 'HealthAgencyController@showWaitingList')
            ->name('show-waiting-list');
   });
    Route::resource('health-agency', 'HealthAgencyController')->middleware('isAdmin');

   Route::resource('poly-master', 'PolyMasterController')->middleware(['isAdmin', 'isSuperAdmin']);
   Route::resource('schedule', 'ScheduleController')->middleware('isAdmin');
   Route::resource('polyclinic', 'PolyclinicController')->middleware('isAdmin');
   Route::resource('waiting-list', 'WaitingListController')->middleware('isAdmin');
});
