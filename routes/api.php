<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/{id}', [ProductController::class, 'details']);
Route::post('/products', [ProductController::class, 'create']);

// Based on the Command, we know we can only create the user here.
Route::post('users', [UserController::class, 'create']);
// Based on the Command, we know the only way to create an address and/or contacts is via this route.
Route::put('users/{id}', [UserController::class, 'update']);
// The data/architecture of the all is that User owns both the Address and Contacts.
// Those 3 are part of the same domain model with user being the root object.

Route::get('users/{id}', [UserController::class, 'showUser']);
Route::get('users/{id}/addresses', [UserController::class, 'showUserAddresses']);
Route::get('users/{id}/contacts', [UserController::class, 'showUserContacts']);
