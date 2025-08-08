<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\PostController;

// Public routes (no authentication required)
Route::get('/posts/public', [PostController::class, 'index']); // Public access to view posts

// Public API documentation endpoints
Route::get('/register', function () {
    return response()->json([
        'endpoint' => '/api/register',
        'method' => 'POST',
        'description' => 'Register a new user account',
        'required_fields' => [
            'name' => 'string (3-25 characters)',
            'email' => 'valid email address (must be unique)',
            'password' => 'string (minimum 6 characters)'
        ],
        'example_request' => [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123'
        ],
        'success_response' => [
            'message' => 'User registered successfully'
        ]
    ]);
});

Route::get('/login', function () {
    return response()->json([
        'endpoint' => '/api/login',
        'method' => 'POST',
        'description' => 'Login with email and password to get access token',
        'required_fields' => [
            'email' => 'valid email address',
            'password' => 'string (minimum 6 characters)'
        ],
        'example_request' => [
            'email' => 'john@example.com',
            'password' => 'password123'
        ],
        'success_response' => [
            'message' => 'Login successful',
            'token' => 'Bearer token for authenticated requests'
        ]
    ]);
});

Route::get('/user', function () {
    return response()->json([
        'endpoint' => '/api/user',
        'method' => 'GET',
        'description' => 'Get current authenticated user information',
        'authentication' => 'Required - Bearer token in Authorization header',
        'example_header' => 'Authorization: Bearer your_token_here',
        'success_response' => [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'created_at' => '2025-08-08T06:41:08.000000Z',
            'updated_at' => '2025-08-08T06:41:08.000000Z'
        ]
    ]);
});

Route::get('/logout', function () {
    return response()->json([
        'endpoint' => '/api/logout',
        'method' => 'POST',
        'description' => 'Logout current user and invalidate access token',
        'authentication' => 'Required - Bearer token in Authorization header',
        'example_header' => 'Authorization: Bearer your_token_here',
        'success_response' => [
            'message' => 'Logged out successfully'
        ]
    ]);
});

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum') -> group(function (){
    Route::get('user', [AuthenticationController::class, 'userInfo']);
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::apiResource('posts', PostController::class);
});
