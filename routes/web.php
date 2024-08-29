<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\CategoryPanelController;
use App\Http\Controllers\Panel\DashboardPanelController;
use App\Http\Controllers\Panel\PostPanelController;
use App\Http\Controllers\Panel\UserPanelController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.public.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.public.show');

Route::get('/posts/category', [CategoryController::class, 'index'])->name('category.public.index');
Route::get('/posts/category/{slug}', [CategoryController::class, 'show'])->name('category.public.show');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::prefix('/panel')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardPanelController::class, 'index'])->name('dashboard');
    Route::resources([
        'posts' => PostPanelController::class,
        'categories' => CategoryPanelController::class,
        'users' => UserPanelController::class,
    ]);
    // Search & Create Category from JS
    Route::get('/categories/search', [CategoryPanelController::class, 'search'])->name('categories.search');
    Route::get('/categories/create-from-js', [CategoryPanelController::class, 'createFromJS'])->name('categories.createFromJS');

    // Autosave Post
    Route::post('/posts/autosave', [PostPanelController::class, 'autosave'])->name('posts.autosave');
});

// Profile Account
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
