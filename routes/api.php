<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ApplyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CompanyController;

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

Route::middleware(['auth:company'])->get('/company', function (Request $request) {
    return $request->user();
});

Route::group([ 'as' => ''], function () {
    // city
    Route::apiResource('cities', \App\Http\Controllers\Api\CityController::class);
    Route::name('cities.')->prefix('city')->group(function () {
        Route::get('/all', [CityController::class, 'all'])->name('all');
    });
    //category
    Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class);
    Route::name('categories.')->prefix('category')->group(function () {
        Route::get('/all', [CategoryController::class, 'all'])->name('all');
    });
    //position
    Route::apiResource('positions', \App\Http\Controllers\Api\PositionController::class);
    Route::name('positions.')->prefix('position')->group(function () {
        Route::get('/all', [PositionController::class, 'all'])->name('all');
    });


    //Job
    Route::name('job.')->prefix('job')->group(function () {
        Route::post('/create', [JobController::class, 'create'])->name('create');
        Route::put('/edit/{id}', [JobController::class, 'edit'])->name('edit');
        Route::delete('/delete/{id}', [JobController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [JobController::class, 'detail'])->name('detail');
        Route::get('/get-all-jobs', [JobController::class, 'getAllJobs']);
        Route::get('get-company-jobs/{company_id}', [JobController::class, 'getCompanyJobs']);
        Route::get('filter-jobs', [JobController::class, 'filterJobs']);
    });

    //Apply
    Route::name('apply.')->prefix('apply')->group(function () {
        Route::post('/create', [ApplyController::class, 'create'])->name('create');
        Route::delete('/delete/{id}', [ApplyController::class, 'delete'])->name('delete');
        Route::get('/list-by-job/{job_id}', [ApplyController::class, 'listByJob']);
        Route::get('/list-by-company/{company_id}', [ApplyController::class, 'listByCompany']);
        Route::get('/list-by-user/{user_id}', [ApplyController::class, 'listByUser']);
    });

    //User
    Route::name('user.')->prefix('user')->group(function () {
        Route::put('/update-profile', [UserController::class, 'updateProfile']);
    });

    //Company
    Route::name('company.')->prefix('company')->group(function () {
        Route::put('/update-info', [CompanyController::class, 'updateInfo']);
    });


});
