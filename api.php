<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * What is this: Laravel Sanctum.
 * Use of this: To authenticate API requests using tokens.
 * What happens: It ensures that only authorized mobile apps or third-party 
 * services can access your perfume data via these API routes.
 */
/**
 * TECHNICAL COMPONENT: Laravel Sanctum
 * PURPOSE: To protect API endpoints and ensure only authenticated users/apps can access them.
 * WHY: It provides a lightweight authentication system for APIs using tokens or cookies.
 * PROBLEM SOLVED: It prevents unauthorized access to sensitive user data, ensuring 
 *      the API remains secure and integrated with the main application's auth.
 */
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

