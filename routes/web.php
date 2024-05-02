<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'loginPage']);
Route::get('/register', [AdminController::class, 'index']);
Route::post('/registerForm', [AdminController::class, 'register'])->name('admin.register');
Route::post('/loginForm', [AdminController::class, 'login'])->name('admin.login');


Route::group(['middleware' => ['adminAuthentication']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});
