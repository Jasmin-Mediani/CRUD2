<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

/* Rotte articoli */

Route::get('/', [App\Http\Controllers\ArticoloController::class, 'index'])->name('articoli.index');
Route::get('/crea-articolo', [App\Http\Controllers\ArticoloController::class, 'create'])->name('articoli.create');
Route::post('/crea-articolo' , [App\Http\Controllers\ArticoloController::class, 'store'])->name('articoli.store');
Route::get('articoli/{articolo}', [App\Http\Controllers\ArticoloController::class, 'show'])->name('articoli.show');
Route::delete('articoli/{articolo}', [App\Http\Controllers\ArticoloController::class, 'destroy'])->name('articoli.delete');
Route::get('/modifica-articolo/{articolo}', [App\Http\Controllers\ArticoloController::class, 'edit'])->name('articoli.edit');
Route::patch('/aggiorna-articolo/{articolo}', [App\Http\Controllers\ArticoloController::class, 'update'])->name('articoli.update');

/*Rotte categorie*/

Route::get('/categorie', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorie.index');
Route::get('/crea-categoria', [App\Http\Controllers\CategoriaController::class, 'create'])->name('categorie.create');
Route::post('/crea-categoria', [App\Http\Controllers\CategoriaController::class, 'store'])->name('categorie.store');
Route::delete('categorie/{categoria}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('categorie.delete');
Route::get('/modifica-categoria/{categoria}', [App\Http\Controllers\CategoriaController::class, 'edit'])->name('categorie.edit');
Route::put('/aggiorna-categoria/{categoria}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('categorie.update');

