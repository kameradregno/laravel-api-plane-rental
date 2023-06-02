<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\RentController;
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


Route::get('/planes/{id}', [PlaneController::class, 'show']);
Route::get('/planes', [PlaneController::class, 'index']);
Route::post('/planes', [PlaneController::class, 'store']);
Route::patch('/planes/{id}', [PlaneController::class, 'update']);
Route::delete('planes/{id}', [PlaneController::class, 'delete']);
    
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/rents/{id}', [RentController::class, 'show']);
Route::get('/rents', [RentController::class, 'index']);
Route::post('/rents', [RentController::class, 'store']);
Route::patch('/rents/{id}', [RentController::class, 'update']);
Route::delete('/rents/{id}', [RentController::class, 'delete']);