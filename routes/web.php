<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



use Illuminate\Http\Request;

Route::get('/form', [FormController::class, 'show'])->name('form.show');

Route::post('/form', [FormController::class, 'submit'])->name('form.submit');

// routes/web.php
Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login/session', function (Request $request) {
    $request->session()->put([
        'name' => $request->name,
        'email' => $request->email,
        'user_id' => $request->user_id,
        'created_at' => $request->created_at
    ]);
    return response()->json(['success' => true]);
})->name('login.session');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');