<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    \Log::info('Login API accessed', ['request' => $request->all()]);
    
    try {
        $userData = $request->validate([
            'uid' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'username' => 'required|string'
        ]);

        \Log::info('Validated user data:', $userData);

        if ($userData['role'] !== 'webmaster') {
            \Log::warning('Non-webmaster access attempt:', $userData);
            return response()->json([
                'message' => 'Access denied. Only webmasters can access the dashboard.'
            ], 403);
        }

        // Store in session
        $request->session()->put('user', $userData);
        
        // Regenerate session ID for security
        $request->session()->regenerate();

        \Log::info('Session created successfully:', [
            'user' => $request->session()->get('user'),
            'session_id' => $request->session()->getId()
        ]);

        return response()->json([
            'message' => 'Logged in successfully',
            'user' => $userData
        ]);
    } catch (\Exception $e) {
        \Log::error('Login failed:', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'message' => 'Login failed: ' . $e->getMessage()
        ], 500);
    }
});