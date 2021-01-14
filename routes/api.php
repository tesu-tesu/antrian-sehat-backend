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
    //Authentication
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh', 'AuthController@refresh')->name('refresh');
    });

    //User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::post('change-password/{user}', 'UserController@changePassword')
            ->name('change-password');
        Route::post('change-image/{user}', 'UserController@changeImage')
            ->name('change-image');
        Route::get('current', 'UserController@getCurrent')
            ->name('get-current');
        Route::get('residence-number', 'UserController@getResidenceNumber')
            ->name('get-residence-number');
        Route::get('booked-residence-number', 'UserController@getBookedResidenceNumber')
            ->name('get-booked-residence-number');
        Route::get('role-admin', 'UserController@getRoleAdmin')
            ->name('get-role-admin');
    });
    Route::resource('user', 'UserController');

    //Poly Master
    Route::group(['prefix' => 'poly-master', 'as' => 'poly-master.'], function () {
        Route::get('of-poly/{polyclinic}', 'PolyMasterController@getPolymasterOfPolyclinic')
            ->name('get-polymaster-of-polyclinic');
        Route::get('all', 'PolyMasterController@getAllPolyMaster')
            ->name('get-all-poly-master');
    });
    Route::resource('poly-master', 'PolyMasterController');

    //Health Agency
    Route::group(['prefix' => 'health-agency', 'as' => 'health-agency.'], function () {
        Route::get('of-poly/{polymaster}', 'HealthAgencyController@getHAOfPolymaster')
            ->name('get-ha-of-polymaster');
        Route::post('search-name', 'HealthAgencyController@searchName')
            ->name('search-name');
        Route::post('search-poly-contains', 'HealthAgencyController@searchPolyContains')
            ->name('search-poly-contains');
        Route::get('all', 'HealthAgencyController@getAllHealthAgency')
            ->name('get-all-health-agency');
    });
    Route::resource('health-agency', 'HealthAgencyController');

    //Waiting List
    Route::group(['prefix' => 'waiting-list', 'as' => 'waiting-list.'], function () {
        Route::get('current-regist/{schedule}/{date}', 'WaitingListController@getCurrentRegist')
            ->name('get-current-regist');
        Route::get('nearest', 'WaitingListController@getNearest')
            ->name('get-nearest');
        Route::get('today', 'WaitingListController@getToday')
            ->name('get-today');
        Route::get('past', 'WaitingListController@getPast')
            ->name('get-past');
        Route::get('future', 'WaitingListController@getFuture')
            ->name('get-future');
        Route::get('admin-menu', 'WaitingListController@getAdminMenu')
            ->name('get-admin-menu');
        Route::post('change-status/{waiting_list}/{status}', 'WaitingListController@changeStatus')
            ->name('change-status');
        Route::post('check-patient-qrcode/{qr_code}', 'WaitingListController@checkPatientQRCode')
            ->name('check-patient-qrcode');
    });
    Route::resource('waiting-list', 'WaitingListController');

    //Schedule
    Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
        Route::get('of-poly/{polymaster}', 'ScheduleController@getScheduleOfPolymaster')
            ->name('get-schedule-of-polymaster');
        Route::get('of-ha/{healthAgency}', 'ScheduleController@getSchedulePolyclinicOfHA')
            ->name('get-schedule-of-ha');
    });
    Route::resource('schedule', 'ScheduleController');

    //Polyclinic
    Route::resource('polyclinic', 'PolyclinicController');
});

//Authentication
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
});
