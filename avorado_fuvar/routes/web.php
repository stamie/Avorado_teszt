<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/works', [WorkController::class, 'index'])->name('works');   
Route::get('/works/edit/{work}', [WorkController::class, 'edit'])->name('works.edit');
Route::post('/works/update', [WorkController::class, 'update'])->name('works.update');
Route::delete('/works/delete/{work}', [WorkController::class, 'delete'])->name('works.delete');
Route::get('/works/create', [WorkController::class, 'create'])->name('works.create');
Route::post('/works/store', [WorkController::class, 'store'])->name('works.store');
    
require __DIR__.'/auth.php';
