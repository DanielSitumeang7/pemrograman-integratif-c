<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Autentikasi;

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

Route::post('/registrasi', [Autentikasi::class, 'register']);
Route::post('/registrasijwt', [Autentikasi::class, 'registerjwt']);
Route::post('/login', [Autentikasi::class, 'login']);
Route::post('/loginjwt', [Autentikasi::class, 'loginjwt']);
Route::post('/logout', [Autentikasi::class, 'logout'])->middleware('auth:sanctum');

Route::get('/posts', [PostController::class, 'ambilSemnuaPost'])->middleware('auth:sanctum');
Route::get('/posts/{id}', [PostController::class, 'ambilPostSpesifik'])->middleware('jwt');
Route::post('/posts', [PostController::class, 'tambahPost']);
Route::put('/posts/{id}', [PostController::class, 'ubahPost']);
Route::delete('/posts/{id}', [PostController::class, 'hapusPost']);
