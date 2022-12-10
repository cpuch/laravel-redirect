<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RedirectController;
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
    // return redirect()->route('link.index');
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('link')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [LinkController::class, 'index'])->name('link.index');
    Route::get('/create', [LinkController::class, 'create'])->name('link.create');
    Route::post('/create', [LinkController::class, 'store'])->name('link.store');
    Route::get('/edit/{link}', [LinkController::class, 'edit'])->name('link.edit');
    Route::put('/edit/{link}', [LinkController::class, 'update'])->name('link.update');
    Route::delete('/delete/{link}', [LinkController::class, 'destroy'])->name('link.destroy');
});

Route::get('/{code}', [RedirectController::class, 'redirect'])->name('link.redirect');