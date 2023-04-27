<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/eventos/data', [EventoController::class, 'data'])->name('evento.data');
Route::post('/eventos/borrar/{id}', [EventoController::class, 'destroy'])->name('evento.destroy');
Route::resource('/eventos', 'App\Http\Controllers\EventoController');

Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::resource('users', UserController::class);
});
