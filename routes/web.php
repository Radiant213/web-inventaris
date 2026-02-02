<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [ItemController::class, 'index'])->name('home');

// Guest Routes (not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/borrowings', [BorrowController::class, 'store'])->name('borrowings.store');
    Route::get('/riwayat', [BorrowController::class, 'history'])->name('history');
});

// Admin Routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [BorrowController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/approve/{id}', [BorrowController::class, 'approve'])->name('admin.approve');
    Route::post('/reject/{id}', [BorrowController::class, 'reject'])->name('admin.reject');
    Route::post('/returned/{id}', [BorrowController::class, 'returned'])->name('admin.returned');
    
    // Items Management
    Route::get('/items', [AdminItemController::class, 'index'])->name('admin.items.index');
    Route::post('/items', [AdminItemController::class, 'store'])->name('admin.items.store');
    Route::get('/items/{id}/edit', [AdminItemController::class, 'edit'])->name('admin.items.edit');
    Route::put('/items/{id}', [AdminItemController::class, 'update'])->name('admin.items.update');
    Route::delete('/items/{id}', [AdminItemController::class, 'destroy'])->name('admin.items.destroy');
    
    // Categories Management
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
});
