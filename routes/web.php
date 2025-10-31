<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;




Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth'])->name('dashboard');

    

require __DIR__.'/auth.php';

// Split routes
require __DIR__.'/admin.php';
require __DIR__.'/user.php';
