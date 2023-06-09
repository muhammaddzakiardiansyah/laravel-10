<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/auth/login', [LoginController::class, 'authenticate']);

Route::group(['middleware' => 'auth.api'], function() {
    Route::post('/v1/auth/logout', [LoginController::class, 'logout']);
    Route::post('/v1/consultation', [ConsultationController::class, 'createConsultation']);
});

