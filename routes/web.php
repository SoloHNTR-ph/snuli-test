<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/form', function () {
    return view('form');
})->name('form.show');

Route::post('/form', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string'
    ]);

    // Process form data here
    
    return back()->with('success', 'Form submitted successfully!');
})->name('form.submit');

// routes/web.php
Route::get('/', function () {
    return view('home');
});
