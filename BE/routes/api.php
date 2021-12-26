<?php

use App\Http\Controllers\LessonsController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::apiResource('/auth', UsersController::class);
Route::post('/login', [UsersController::class,'Login']);
Route::apiResource('/lessons', LessonsController::class);
Route::apiResource('/exams', ExamsController::class);
Route::apiResource('/files', FilesController::class);
Route::apiResource('/types', TypesController::class);
Route::post('/answer', [ExamsController::class, 'answer']);
