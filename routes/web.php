<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/sach','App\Http\Controllers\BookController@sach');
Route::get('/sach/theloai/{id}','App\Http\Controllers\BookController@theloai');
Route::get('/sach/chitiet/{id}',"App\Http\Controllers\BookController@chitiet");

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
Route::get('/order','App\Http\Controllers\BookController@order')->name('order');
Route::post('/cart/add','App\Http\Controllers\BookController@cartadd')->name('cartadd');
Route::post('/cart/delete','App\Http\Controllers\BookController@cartdelete')->name('cartdelete');
Route::post('/order/create','App\Http\Controllers\BookController@ordercreate')
->middleware('auth')->name('ordercreate');
