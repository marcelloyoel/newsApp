<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'doRegister']);

Route::group(['middleware' => 'auth'], function (){
    Route::resource('/users', UserController::class)->middleware('admin');
    Route::group(['middleware' => 'author'], function (){
        Route::resource('/posts', PostController::class)->middleware('auth');
        Route::get('/createSlug', [PostController::class, 'createSlug'])->middleware('auth');
    });
});



Route::get('{post:slug}', [HomeController::class, 'show']);
