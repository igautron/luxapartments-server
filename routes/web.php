<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/uploadExcel', [App\Http\Controllers\HomeController::class, 'uploadExcel'])->name('uploadExcel');
Route::post('/uploadImages', [App\Http\Controllers\HomeController::class, 'uploadImages'])->name('uploadImages');
Route::get('/deleteImage/{img_name}', [App\Http\Controllers\HomeController::class, 'deleteImage'])->name('deleteImage');
