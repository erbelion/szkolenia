<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

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
    if(Auth::user())
        return view('user.home');
    else
        return view('guest.home');
});

Route::get('/logowanie', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/rejestracja', function () {
    return view('auth.register');
})->middleware('guest');


// Route::get('logowanie', [LoginController::class, 'showLoginForm']);
