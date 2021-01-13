<?php
//use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;



Route::get('/', [ImageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/image', [ImageController::class, 'post']);

Route::delete('/image/{id}', [ImageController::class, 'remove']);