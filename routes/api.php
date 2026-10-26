<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//public routes
Route::post('/register-user',[AuthController::class,'register']);
Route::post('/login-user',[AuthController::class,'login']);
//Protected routes
Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout-user',[AuthController::class,'logout']);
    Route::post('/create-role',[RoleController::class,'createRole']);
    Route::get('/read-roles',[RoleController::class,'readAll']);
    Route::get('/read-role/{id}',[RoleController::class,'read']);
    Route::post('/update-role/{id}',[RoleController::class,'updateRole']);
    Route::delete('/delete-role/{id}',[RoleController::class,'deleteRole']);

    Route::post('/create-category',[CategoryController::class,'createCategory']);
    Route::get('/read-categories',[CategoryController::class,'readAll']);
    Route::get('/read-category/{id}',[CategoryController::class,'read']);
    Route::post('/update-category/{id}',[CategoryController::class,'updateCategory']);
    Route::delete('/delete-category/{id}',[CategoryController::class,'deleteCategory']);

});



