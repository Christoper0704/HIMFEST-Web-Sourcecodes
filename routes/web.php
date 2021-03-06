<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MemberController;
use Illuminate\Notifications\Channels\MailChannel;

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
    return view('register_member');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/auth/save',[MainController::class, 'save'])->name('auth.save');
Route::post('/auth/check',[MainController::class, 'check'])->name('auth.check');
Route::get('/auth/logout',[MainController::class, 'logout'])->name('auth.logout');

Route::get('/admin/dashboard',[MainController::class, 'dashboard']);
Route::get('/auth/login',[MainController::class, 'login'])->name('auth.login');
Route::get('/auth/register-team',[MainController::class, 'registerteam'])->name('auth.register-team');
Route::get('/admin/settings',[MainController::class,'settings']);
Route::get('/admin/profile',[MainController::class,'profile']);
Route::get('/admin/staff',[MainController::class,'staff']);
Route::get('/auth/register-member',[MainController::class, 'registermember'])->name('auth.register-member');

Route::get('/upload-file', [FileUpload::class, 'createForm']);
Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');

