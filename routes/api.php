<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// API routes
Route::get('/users', [UserController::class, 'index'])->name('index.users');

