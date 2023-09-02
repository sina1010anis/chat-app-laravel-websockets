<?php

use App\Http\Controllers\ProductController;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//return auth()->logout();
Route::get('/test', [MessageController::class, 'time']);
Route::controller(MessageController::class)->middleware(['auth'])->group(function () {
    Route::get('/' , 'index')->name('index');
    Route::get('/show/message/{name}' , 'showMessage')->name('show.message');
    Route::post('/send/message' , 'sendMessage')->name('send.message');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/edit/status', [MessageController::class, 'editStatus'])->name('edit.status');
Route::get('/out', function () {
    auth()->logout();
});

Route::get('/show' , [ProductController::class, 'show'])->name('show.product');
Route::get('/edit/product/{product}' , [ProductController::class, 'edit_product'])->name('edit.product');
Route::view('/new' , 'file_test')->name('new.product');

Route::post('/new/product' , [ProductController::class, 'new_product'])->name('new.product.post');
Route::post('/edit/product/{product}' , [ProductController::class, 'edit_product_post'])->name('edit.product.post');

