<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerficationController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Http\Request;

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
Route::get('/login', [HomeController::class, 'loginPage'])->name('login.page');
Route::get('/register', [AdminController::class, 'index']);
Route::post('/registerForm', [AdminController::class, 'register'])->name('admin.register');
Route::post('/loginForm', [AdminController::class, 'login'])->name('admin.login');


//Email Verification Routes
Route::group(['middleware' => ['verified', 'adminAuthentication']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});
Route::get('/admin/verify/{token}', [EmailVerficationController::class, 'hittting'])->middleware('signed')->name('admin.email.verify');

Route::get('/email/verify', function () {
    dd('email not verified');
})->middleware('adminAuthentication')->name('verification.notice');


//Password Reset Routes
Route::get('/forgot-password', [PasswordResetController::class, 'index'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'forgetPassword'])->name('password.email');
Route::get('/reset-password/{token}',[PasswordResetController::class, 'resetPasswordIndex'])->name('password.reset');
Route::post('/reset-password',[PasswordResetController::class, 'resetPassword'])->name('password.update');
