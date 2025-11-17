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


Route::get('/works', [WorkController::class, 'index'])->name('works.index');   //Munkák listája
Route::get('/works/edit/{work}', [WorkController::class, 'edit'])->name('works.edit'); //Adin editje
Route::patch('/works/update', [WorkController::class, 'update'])->name('works.update'); //Adin updatje
Route::get('/works/editcarrier/{work}', [WorkController::class, 'editcarrier'])->name('works.editcarrier'); //Carrier editje
Route::patch('/works/updatecarrier', [WorkController::class, 'updatecarrier'])->name('works.updatecarrier'); //Carrier updatje
Route::get('/works/delete/{work}', [WorkController::class, 'delete'])->name('works.delete'); //Munka törlése adminnak
Route::get('/works/create', [WorkController::class, 'create'])->name('works.create'); //Munka törlése adminnak
Route::post('/works/store', [WorkController::class, 'store'])->name('works.store');
});    
require __DIR__.'/auth.php';
