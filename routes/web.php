<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\admin;

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

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/create', [AuthController::class, 'create'])->name('create');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('listings', ListController::class)->middleware(['auth', 'admin']);


Route::get('/not-admin', function () {
    return view('notAdmin');
})->name('notAdmin')->middleware(['auth']);