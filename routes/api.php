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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'as' => ''], function () {
    Route::apiResource('cities', \App\Http\Controllers\Api\CityController::class);
    Route::get('/all-cities', [
        'as' => 'cities.all',
		'uses' => '\App\Http\Controllers\Api\CityController@all'
    ]);

    // Route::apiResource('jobs',+ \App\Http\Controllers\Api\Admin\JobController::class);
    // Route::get('/all-jobs', [
    //     'as' => 'jobs.all',
    //     'uses' => '\App\Http\Controllers\Api\Admin\JobController@all'
    // ]);

    // Route::apiResource('permissions', \App\Http\Controllers\Api\Admin\PermissionController::class);
    // Route::apiResource('roles', \App\Http\Controllers\Api\Admin\RoleController::class);
    // Route::apiResource('users', \App\Http\Controllers\Api\Admin\UserController::class);
    // Route::apiResource('proposals', \App\Http\Controllers\Api\Admin\ProposalController::class);
});
