<?php

use App\Http\Controllers\API\APIAuthController;
use App\Http\Controllers\API\APICarrerasController;
use App\Http\Controllers\API\APIInscripcionMateriaController;
use App\Http\Controllers\API\APIMateriaController;
use App\Http\Controllers\API\APIUserController;
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

Route::post('login', [APIAuthController::class , 'login']);
Route::post('logout', [APIAuthController::class, 'logout'])->middleware('auth:api');
Route::get('isLoggedIn', [APIAuthController::class, 'isLoggedIn']);

Route::resource('api_user', APIUserController::class)->middleware('auth:api');
Route::resource('api_materias', APIMateriaController::class)->middleware('auth:api');
Route::resource('api_carreras', APICarrerasController::class)->middleware('auth:api');
Route::resource('api_inscripcion_materia', APIInscripcionMateriaController::class)->middleware('auth:api');

