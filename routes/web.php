<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware('isguest')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('index');
    Route::get('/register', [TodoController::class, 'register']);
    Route::get('/login', [TodoController::class, 'login']);
    Route::post('/register', [TodoController::class, 'registerAccount']);
    Route::post('/login/auth', [TodoController::class, 'auth'])->name('login.auth');
});

Route::get('/logout', [TodoController::class, 'logout'])->name('logout.io');

Route::middleware('islogin')->group(function () {
    Route::prefix('/todo')->name('todo.')->group(function () {
        Route::get('/', [TodoController::class, 'home'])->name('index');
        Route::get('/create', [TodoController::class, 'create'])->name('create');
        Route::get('/complated', [TodoController::class, 'complated'])->name('complated');
        Route::post('/create-new', [TodoController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('edit');
        // method route untuk ubah data di db itu patch/put
        Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
        // method route untuk menghapus data di database itu delete
        Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('delete');
        Route::patch('/completed/{id}', [TodoController::class, 'updateCompleted'])->name('update-completed');
    });
});
