<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerficationController;
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

Route::group(['middleware' => ['verified', 'adminAuthentication']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});
Route::get('/admin/verify/{token}', [EmailVerficationController::class, 'hittting'])->middleware('signed')->name('admin.email.verify');

Route::get('/email/verify', function () {
    dd('email not verified');
})->middleware('adminAuthentication')->name('verification.notice');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');
