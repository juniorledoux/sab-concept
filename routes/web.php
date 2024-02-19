<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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


// Route::get('/', 'index')->name('home');


// Route::get('/', [HomeController::class, 'index']);
// Route::get('/', function () {
//     return redirect('/dashboard');
// })->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard')->middleware('auth');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts')->middleware('auth');
Route::post('/contacts/add', [ContactController::class, 'add'])->name('contact-add')->middleware('auth');
Route::get('/contacts-delete/{id}', [ContactController::class, 'destroy'])->name('contact-delete')->middleware('auth');
Route::get('/contacts-edit/{id}', [ContactController::class, 'edit'])->name('contact-edit')->middleware('auth');
Route::put('/contacts-update/{id}', [ContactController::class, 'update'])->name('contact-update')->middleware('auth');

Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/management/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/management/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/management/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
Route::post('/management/users-add', [UserController::class, 'add'])->name('users-add')->middleware('auth');
Route::get('/management/users-delete/{id}', [UserController::class, 'destroy'])->name('users-delete')->middleware('auth');
Route::get('/users-edit/{id}', [UserController::class, 'edit'])->name('users-edit')->middleware('auth');
Route::put('/users-edit/update/{id}', [UserController::class, 'update'])->name('users-update')->middleware('auth');

Route::get('/', function () {
    return view('index');
});
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::get('/check-email', [VerificationController::class, 'show'])->name('verification-notice');

Route::get('/dashboard', function () {
    if(Auth::user()->email_verified_at==null) return redirect('/email/verify');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verification-email');
})->name('verification.notice');
