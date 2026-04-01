<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/sach','App\Http\Controllers\BookController@sach');
Route::get('/sach/theloai/{id}','App\Http\Controllers\BookController@theloai');
Route::get('/sach/chitiet/{id}',"App\Http\Controllers\BookController@chitiet");

//yêu cầu 4.
Route::post('/bookview','App\Http\Controllers\BookController@bookview')->name("bookview");


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
