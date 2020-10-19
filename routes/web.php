<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/User', [UserController::class, 'index']);
Route::get('/User/create', [UserController::class, 'create']);
Route::get('User/confirmation/{user}', [UserController::class, 'confirmation']);
Route::post('/User', [UserController::class, 'store']);

Route::resource('/materias', 'App\Http\Controllers\MateriaController');
Route::resource('/correlativas', 'App\Http\Controllers\MateriaCorrelativaController');
