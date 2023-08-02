<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserManagmentController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\InversionRelationController;
use App\Http\Controllers\PermisionController;

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
    Route::post('/getById', [UserManagmentController::class, 'getById']);


    }
);

Route::group(['prefix' => '/folder'], function () {
    
    Route::post('/create', [FolderController::class, 'create']);
    Route::post('/getById', [FolderController::class, 'getById']);
    Route::post('/deleteById', [FolderController::class, 'deleteById']);

    }
);

Route::group(['prefix' => '/folder'], function () {
    
    Route::post('/create', [InversionRelationController::class, 'create']);
    Route::post('/getByOwnerId', [InversionRelationController::class, 'getByOwnerId']);
    Route::post('/getByInversorId', [InversionRelationController::class, 'getByInversorId']);
    Route::post('/deleteById', [InversionRelationController::class, 'deleteById']);
    Route::post('/updateById', [InversionRelationController::class, 'updateById']);
   
    }
);

Route::group(['prefix' => '/permision'], function () {
    
    Route::post('/create', [PermisionController::class, 'create']);
    Route::post('/getIfPermisionUserFolder', [PermisionController::class, 'getIfPermisionUserFolder']);
    Route::post('/deleteById', [PermisionController::class, 'deleteById']);
   
    }
);
