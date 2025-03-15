<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route Middleware

// If the user is logged in, allow access to user-page. If not logged in, denied access 401.

Route::get('/user-page', function () {
    return view('user-page');
})->middleware('is_admin');

// Check Age Middleware (nagloloko pag naka on kasabay ng ibang codes nauna ko po kasi tong ginawa)
// Basically, if below 18 ung age denied, then kapag above 18 access granted.

// Route::get('/{age}', function($age){
//     return "You are allowed to access the page. Your age is: $age";
// })->middleware('AgeCheckMiddleware');

// For Global Middleware, check App/Http/Middleware/LogHttpRequest.php

// Laravel Breeze Starter Kit

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
