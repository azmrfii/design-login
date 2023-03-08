<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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
// Route for login
Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('processlogin', [LoginController::class, 'processLogin'])->name('processlogin');
// Route login as masyarakat
Route::group(['middleware' => ['auth:masyarakat', 'isActive']], function() {
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
// Route login as Users [Admin && Petugas]
Route::group(['middleware' => ['auth:web', 'isActive', 'checkLevel:admin,petugas']], function() {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
