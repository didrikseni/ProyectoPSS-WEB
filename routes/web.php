<?php

use App\Http\Controllers\MateriaCorrelativaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MesaExamenController;
use App\Http\Controllers\NotaController;

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

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

Route::resource('/User', UserController::class);
Route::get('User/confirmation/{user}', [UserController::class, 'confirmation']);

Route::resource('/materias', 'App\Http\Controllers\MateriaController');
Route::get('/materia/profesor', 'App\Http\Controllers\MateriaController@edit_professor');
Route::put('/materia/profesor', 'App\Http\Controllers\MateriaController@update_professor');
Route::resource('/correlativas', 'App\Http\Controllers\MateriaCorrelativaController');
Route::resource('/inscripcion_materia', 'App\Http\Controllers\InscripcionEnMateriaController');
Route::get('/correlatividad/debil/{materia}', [MateriaCorrelativaController::class, 'indexCorrelativasDebiles']);
Route::get('/correlatividad/fuerte/{materia}', [MateriaCorrelativaController::class, 'indexCorrelativasFuertes']);

Route::resource('/Carreras', 'App\Http\Controllers\CarrerasController');
Route::resource('/carreras_materias', 'App\Http\Controllers\MateriasCarrerasController');
Route::resource('/inscripcion_carrera', 'App\Http\Controllers\InscriptoEnCarreraController');
Route::get('/Carreras/{carrera}/materias','App\Http\Controllers\CarrerasController@showMaterias');

Route::resource('/MesaExamen', 'App\Http\Controllers\MesaExamenController');
Route::get('MesaExamen/confirmation/{mesa}', [MesaExamenController::class, 'confirmation']);
Route::get('MesaExamen/inscripcion/{mesa}', [MesaExamenController::class, 'inscripcion']);
Route::get('MesaExamen/desinscripcion/{mesa}', [MesaExamenController::class, 'desinscripcion']);

Route::resource('/Nota', 'App\Http\Controllers\NotaController');
Route::get('/final/nota/create', 'App\Http\Controllers\NotaController@createFinal');
Route::post('/notafinal', 'App\Http\Controllers\NotaController@storeFinal');
