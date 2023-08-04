<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SessionTimeLogController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/session-time-logs', [SessionTimeLogController::class, 'index']);

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::post('/session-time-logs', [SessionTimeLogController::class, 'store']);

    Route::delete('/session-time-logs/{id}', [SessionTimeLogController::class, 'destroy']);

});
