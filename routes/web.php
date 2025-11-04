<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/movie', [App\Http\Controllers\MovieController::class, 'index']);



Route::get('/login', function () {
    return view('login'); 
});

Route::get('/register', function () {
    return view('register'); 
});


