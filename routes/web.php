<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $posts = Post::getAllPublic();

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        "posts" => $posts
    ]);
});

Route::get('/inicio', function () {

    $posts = Post::getAllVisible();

    return Inertia::render('Inicio',[
        "posts"=>$posts
    ]);
})->middleware(['auth', 'verified'])->name('inicio');


Route::get('/mis-posts', [PostController::class,'index'])->middleware(['auth', 'verified'])->name('mis-posts');
Route::get('/posts/create', [PostController::class,'create'])->middleware(['auth', 'verified'])->name('post.create');
Route::post('/posts/store',[PostController::class,'store'])->middleware(['auth', 'verified'])->name('post.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
