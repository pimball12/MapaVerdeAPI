<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContributorController;
use App\Http\Controllers\GardenController;
use App\Http\Controllers\GardenImageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
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


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('images/display/{file}', [ImageController::class, 'display']);
Route::post('images/storage64', [ImageController::class, 'storage64']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('gardens', GardenController::class);
    Route::apiResource('garden_images', GardenImageController::class)->except(['update']);
    Route::apiResource('messages', MessageController::class)->except(['update']);
    Route::apiResource('contributors', ContributorController::class);
});
