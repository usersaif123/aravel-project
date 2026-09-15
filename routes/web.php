<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome',
    [\App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/advisor',[\App\Http\Controllers\AdvisorController::class, 'show'])
->middleware('check-age');
Route::get('/acces-refuse', function () {
    echo 'Access Denied ' ;
}) ;
Route::get('/article', [\App\Http\Controllers\ArticleController::class, 'index']);
