<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserInfoController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


/*Route::resource('tasks', TaskController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('user-info', UserInfoController::class);
})*/;


Route::middleware(['auth', 'role:admin', 'role:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users');
    Route::get('/report', [AdminController::class, 'userReports'])->name('user-report');
    Route::get('/financial-report', [AdminController::class, 'financialReports'])->name('financial-report');
    Route::get('/user/{userId}', [AdminController::class, 'userProfile'])->name('user');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::resource('user-info', UserInfoController::class);
});
