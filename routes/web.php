<?php

use App\Models\User;
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
Route::get('/test' , function(){
    return User::all();
});
Route::controller(MessageController::class)->middleware(['auth'])->group(function () {
    Route::get('/' , 'index')->name('index');
    Route::get('/show/message/{name}' , 'showMessage')->name('show.message');
    Route::post('/send/message' , 'sendMessage')->name('send.message');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/edit/status', [MessageController::class, 'editStatus'])->name('edit.status');
Route::get('/out', function(){
    auth()->logout();
});
