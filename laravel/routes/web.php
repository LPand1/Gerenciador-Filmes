<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/filme')->group(function() {
    Route::get('', [FilmeController::class, 'index'])->name('filme.index');
    Route::get('/create', [FilmeController::class, 'create'])->name('filme.create');
    Route::post('/create', [FilmeController::class, 'create']);
    Route::get('/edit{filme}', [FilmeController::class, 'edit'])->name('filme.edit');
    Route::put('/edit{filme}', [FilmeController::class, 'edit']);
    Route::delete('/delete/{filme}', [FilmeController::class, 'delete']);
    
    Route::prefix('/trash')->group(function () {
        Route::get('', [FilmeController::class, 'trash'])->name('filme.trash');
        Route::get('/{filme}/restore', [FilmeController::class, 'restore'])->withTrashed()->name('filme.trash.restore');
        Route::get('/{filme}/delete', [FilmeController::class, 'deleteDefinitivo'])->withTrashed()->name('filme.trash.delete');
        Route::delete('/{filme}/delete', [FilmeController::class, 'deleteDefinitivo'])->withTrashed();
    });
});

Route::prefix('/categoria')->group(function() {
    Route::get('', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::get('/create', [CategoriaController::class, 'create'])->name('categoria.create');
    Route::post('/create', [CategoriaController::class, 'create']);
    Route::get('/edit{categoria}', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::put('/edit{categoria}', [CategoriaController::class, 'edit']);
    Route::delete('/delete/{categoria}', [CategoriaController::class, 'delete']);

    Route::prefix('/trash')->group(function () {
        Route::get('', [CategoriaController::class, 'trash'])->name('categoria.trash');
        Route::get('/{categoria}/restore', [CategoriaController::class, 'restore'])->withTrashed()->name('categoria.trash.restore');
        Route::get('/{categoria}/delete', [CategoriaController::class, 'deleteDefinitivo'])->withTrashed()->name('categoria.trash.delete');
        Route::delete('/{categoria}/delete', [CategoriaController::class, 'deleteDefinitivo'])->withTrashed();
    });
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');