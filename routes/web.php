<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\CreateRequest;
use App\Livewire\RequestList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('requests')
    ->name('requests.')
    ->group(function () {

        Route::get('/', RequestList::class)->name('list');
        Route::get('create', CreateRequest::class)->name('create');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
