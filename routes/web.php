<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

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

Route::prefix('dashboard-sensor')->group(function () {
    // Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/index', [SensorController::class, 'index'])->name('admin.dashboard');
    // Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
});