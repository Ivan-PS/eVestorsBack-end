<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagmentController;



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
Route::group(['prefix' => '/user'], function () {
    Route::post('/create', [UserManagmentController::class, 'create']);
    Route::post('/createTest', [UserManagmentController::class, 'createTest']);
    Route::post('/login', [UserManagmentController::class, 'login']);
    }
);

