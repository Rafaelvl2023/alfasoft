<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;

Route::get('/', function () {
    return view('contatos');
})->name('contatos');

Route::get('/login', [AuthController::class, 'index'])->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/formRegistro', function () {
        return view('formRegistro');
    })->name('formRegistro');

    Route::get('/adminContatos', function () {
        return view('adminContatos');
    })->name('adminContatos');

    Route::get('/adminContatos', [ContatoController::class, 'index'])->name('adminContatos');
    Route::post('/', [ContatoController::class, 'store'])->name('contatos.store');
    Route::delete('/{id}', [ContatoController::class, 'destroy'])->name('contatos.destroy');
    Route::get('/{id}/edit', [ContatoController::class, 'edit'])->name('contatos.edit');
    Route::put('/{id}', [ContatoController::class, 'update'])->name('contatos.update');
});
