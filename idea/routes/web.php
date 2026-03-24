<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [SessionsController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeaController::class, 'index']);
    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.index');
});
