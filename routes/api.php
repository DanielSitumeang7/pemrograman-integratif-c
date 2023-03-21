<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ambilPost', [PostController::class, 'ambilSemnuaPost']);
Route::get('/posts/{id}', [PostController::class, 'ambilPostSpesifik']);
Route::post('/posts', [PostController::class, 'tambahPost']);
Route::put('/posts/{id}', [PostController::class, 'ubahPost']);
Route::delete('/posts/{id}', [PostController::class, 'hapusPost']);
