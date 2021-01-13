<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

//shows all posted images
Route::get('/', [ImageController::class, 'index']);

Auth::routes();

//page to post images
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//post image
Route::post('/image', [ImageController::class, 'post']);

//delete image
Route::delete('/image/{id}', [ImageController::class, 'remove']);