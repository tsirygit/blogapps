<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('homepage', [HomepageController::class,'index'])->name('homepage')->middleware('auth');

route::resource('post', PostController::class);


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
