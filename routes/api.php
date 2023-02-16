<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ApplyController;

use App\Http\Controllers\CompanyAuth\CompanyAuthController;
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

Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);

Route::post('company-login', [CompanyAuthController::class,'login']);
Route::post('company-register', [CompanyAuthController::class,'register']);

Route::group(['middleware' => 'api'], function(){
    Route::post('logout',  [AuthController::class,'logout']);
    Route::post('refresh',  [AuthController::class,'refresh']);
    Route::post('me',  [AuthController::class,'me']);
    Route::get('user', [AuthController::class,'user']);

    Route::post('forgot-password',  [ForgotPasswordController::class,'sendEmail']);
    Route::post('reset-password', [ResetPasswordController::class,'passwordResetProcess']);

    Route::post('company-logout',  [CompanyAuthController::class,'logout']);
    Route::post('company-refresh',  [CompanyAuthController::class,'refresh']);
    Route::get('company', [CompanyAuthController::class,'company']);

    Route::post('company-forgot-password',  [CompanyForgotPasswordController::class,'sendEmail']);
    Route::post('company-reset-password', [CompanyResetPasswordController::class,'passwordResetProcess']);
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

});
