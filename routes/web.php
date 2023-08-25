<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\VerificationController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/registration', [CustomAuthController::class, 'registration']);
Route::post('/register', [CustomAuthController::class, 'register'])->name('register'); 
Route::get('/verify/{token}', [VerificationController::class, 'verify'])->name('verify');
Route::post('/verify/resend', [VerificationController::class, 'resend'])->name('verify.resend');

