<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;

// API routes



// 
// Ruta za dohvacanje svih korisnika
Route::get('/users', [UserController::class, 'index'])->name('index.users');
// Ruta za dohvacanje korisnika po broju
Route::get('/users/{number}', [UserController::class, 'showUsersByNumber']);
// Ruta za dohvacanje korisnika po ID-u
Route::get('/user/{id}', [UserController::class, 'getUserById']);

// Ruta za update korisnika po ID-u
Route::middleware('auth.token')->group(function () {
    Route::put('/user/{id}', [UserController::class, 'updateUser']);
});
Route::put('/user/{id}', [UserController::class, 'updateUser'], );
// Ruta za brisanje korisnika
// Ruta za registraciju korisnika
Route::post('/register', [AuthController::class, 'registerNewUser'])->name('register.user');
Route::post('/login', [AuthController::class, 'login'])->name('login.user');
// Ruta za brisanje korisnika, parametar je ID za obrisat po indexu
Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('delete.user');

