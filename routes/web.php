<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Login Route
Route::get('/login', function () {
    return view('login');
})->name('login');

// Register Route
Route::get('/register', function () {
    return view('register');
})->name('register');

// Dashboard route with webmaster check
// Route::get('/dashboard', function (Request $request) {
//     $user = $request->session()->get('user');
    
//     if (!$user || $user['role'] !== 'webmaster') {
//         return redirect('/login')->with('error', 'Access denied. Only webmasters can access the dashboard.');
//     }
    
//     return view('dashboard', ['user' => $user]);
// })->name('dashboard')->middleware('web');

// Dashboard route with debugging
// Route::prefix('users')->middleware(['user.auth'])->group(function () {
//     Route::post('/webmaster/create', [UserController::class, 'createWebmaster']);
//     Route::get('/', [UserController::class, 'getAllUsers']);
//     Route::get('/{id}', [UserController::class, 'getUserById']);
//     Route::put('/{id}', [UserController::class, 'updateUser']);
//     Route::delete('/{id}', [UserController::class, 'deleteUser']);
//     Route::put('/{id}/status', [UserController::class, 'updateOnlineStatus']);
// });


Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/dashboard', function (Request $request) {
    \Log::info('Dashboard route accessed');
    \Log::info('Session data:', ['user' => $request->session()->get('user')]);
    
    $user = $request->session()->get('user');
    
    if (!$user) {
        \Log::warning('No user in session');
        return redirect('/login')->with('error', 'Please login first.');
    }
    
    if ($user['role'] !== 'webmaster') {
        \Log::warning('User is not webmaster:', ['role' => $user['role']]);
        return redirect('/login')->with('error', 'Access denied. Only webmasters can access the dashboard.');
    }
    
    \Log::info('Rendering dashboard for user:', ['user' => $user]);
    return view('dashboard', ['user' => $user]);
})->middleware(['web'])->name('dashboard');

// Add these routes
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/user', function (Request $request) {
    return response()->json([
        'user' => $request->session()->get('user')
    ]);
})->name('user.current');

// User Management Routes
Route::prefix('users')->middleware(['auth'])->group(function () {
    Route::post('/webmaster/create', [UserController::class, 'createWebmaster']);
    Route::get('/', [UserController::class, 'getAllUsers']);
    Route::get('/{id}', [UserController::class, 'getUserById']);
    Route::put('/{id}', [UserController::class, 'updateUser']);
    Route::delete('/{id}', [UserController::class, 'deleteUser']);
    Route::put('/{id}/status', [UserController::class, 'updateOnlineStatus']);
});

// Form Routes
Route::get('/form', function () {
    return view('form');
})->name('form.show');

Route::post('/form', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string'
    ]);

    return back()->with('success', 'Form submitted successfully!');
})->name('form.submit');