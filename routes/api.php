<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserManagmentController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InversionRelationController;
use App\Http\Controllers\PermisionController;
use App\Http\Controllers\StartupController;

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

    Route::post('/create', [UserManagmentController::class, 'register']);
    Route::post('/createFounder', [UserManagmentController::class, 'createFounder']);
    Route::post('/login', [UserManagmentController::class, 'login']);
    Route::post('/getById', [UserManagmentController::class, 'getById']);

    }
);

Route::group(['prefix' => '/folder'], function () {

    Route::post('/create', [FolderController::class, 'create']);
    Route::post('/getById', [FolderController::class, 'getById']);
    Route::post('/deleteById', [FolderController::class, 'deleteById']);
    Route::post('/getByParent', [FolderController::class, 'getByParent']);
    Route::post('/getAllowed', [FolderController::class, 'getFoldersByIdUserWithPermisions']);
    }
);

Route::group(['prefix' => '/inversion'], function () {

    Route::post('/create', [InversionRelationController::class, 'create']);
    Route::post('/getByOwnerId', [InversionRelationController::class, 'getByOwnerId']);
    Route::post('/getByInversorId', [InversionRelationController::class, 'getByInversorId']);
    Route::post('/deleteById', [InversionRelationController::class, 'deleteById']);
    Route::post('/updateById', [InversionRelationController::class, 'updateById']);

    }
);

Route::group(['prefix' => '/file'], function () {

    Route::post('/create', [FileController::class, 'create']);
    Route::post('/getById', [FileController::class, 'getById']);
    Route::post('/getByParent', [FileController::class, 'getByParent']);
    Route::post('/deleteById', [FileController::class, 'deleteById']);
    Route::post('/getAllowed', [FileController::class, 'getFilesByIdUserWithPermisions']);
    Route::post('/download', [FileController::class, 'downloadFileById']);


}
);

Route::group(['prefix' => '/permision'], function () {

    Route::post('/create', [PermisionController::class, 'create']);
    Route::post('/getIfPermisionUserFolder', [PermisionController::class, 'getIfPermisionUserFolder']);
    Route::post('/getIfPermisionUserFile', [PermisionController::class, 'getIfPermisionUserFile']);
    Route::post('/deleteById', [PermisionController::class, 'deleteById']);

    }

);
Route::group(['prefix' => '/startUp'], function () {

    Route::post('/create', [StartupController::class, 'create']);
    Route::post('/getAllowed', [StartupController::class, 'getByIdUser']);

    }

);

Route::group(['prefix' => '/inversor'], function () {

    Route::post('/create', [StartupController::class, 'createInversor']);
    Route::post('/getAllowed', [StartupController::class, 'getInversorsAllowedByStartUpId']);

    }
);

Route::group(['prefix' => '/accesssCode'], function () {
    Route::post('/getByStartUpId', [StartupController::class, 'getAccessCodeByStartUpId']);
    Route::post('/create', [StartupController::class, 'createAccessCode']);
    Route::post('/check', [StartupController::class, 'checkAccessCode']);


    }
);
