<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MoniteurController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\StudentController;

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

// admin routes
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');
Route::middleware('auth')->group(function () {
    Route::get('/ajouter-eleve', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/ajouter-eleve', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/editer-eleve/{eleve}', [AdminController::class, 'edit'])->name('admin.editUser');
    Route::post('/editer-eleve/{eleve}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
});

// eleve route
Route::middleware(['auth'])->group(function () {
    Route::resource('students', StudentController::class);
});

// moniteur route
Route::middleware(['auth'])->group(function () {
    Route::resource('moniteurs', MoniteurController::class);
});

// voiture route 
Route::middleware(['auth'])->group(function () {
    Route::resource('cars', CarController::class);
});


require __DIR__.'/auth.php';
