<?php

use App\Api\Http\Controllers\CompanyController;
use App\Api\Http\Controllers\EmployeeController;
use App\Api\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
    return $request->user();
});

Route::group(['prefix' => '', 'as' => 'api.', 'middleware' => ['auth.actions']], function() {
    Route::group(['prefix' => 'companies', 'middleware' => 'auth:sanctum', 'as' => 'companies.'], function() {
        Route::get('', [CompanyController::class, 'index'])->name('index');

        Route::group(['prefix' => '{companyId}', 'middleware' => ['company.membership']], function() {
            Route::group(['prefix' => 'projects', 'as' => 'projects.'], function() {
                Route::get('', [ProjectController::class, 'index'])->name('index');
                Route::post('', [ProjectController::class, 'store'])->name('store');

                Route::group(['prefix' => '{projectId}', 'middleware' => ['project.membership']], function() {
                    Route::put('', [ProjectController::class, 'update'])->name('update');
                    Route::delete('', [ProjectController::class, 'delete'])->name('delete');
                });
            });

            Route::group(['prefix' => 'employees', 'as' => 'employees.'], function() {
                Route::get('', [EmployeeController::class, 'index'])->name('index');
                Route::post('', [EmployeeController::class, 'store'])->name('store');

                Route::group(['prefix' => '{employeeId}'], function() {
                    Route::put('', [EmployeeController::class, 'update'])->name('update');
                    Route::delete('', [EmployeeController::class, 'delete'])->name('delete');
                });
            });
        });
    });
});
