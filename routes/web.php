<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;

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

Route::middleware('auth', 'admin')->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index']);
    Route::get('admin/projects', [ProjectsController::class, 'index'])->name('admin.projects');
    Route::get('admin/projects/create', [ProjectsController::class, 'create'])->name('admin.projects.create');
    Route::post('admin/projects/save', [ProjectsController::class, 'save'])->name('admin.projects.save');
    Route::get('admin/projects/edit/{id}', [ProjectsController::class, 'edit'])->name('admin.projects.edit');
    Route::put('admin/projects/update/{id}', [ProjectsController::class, 'update'])->name('admin.projects.update');
    Route::delete('admin/projects/delete/{id}', [ProjectsController::class, 'delete'])->name('admin.projects.delete');
});

require __DIR__ . '/auth.php';

// Route::get('admin/dashboard', [HomeController::class, 'index']);
// Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);
