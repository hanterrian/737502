<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PublisherController;
use App\Http\Controllers\Api\UserController;
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

Route::apiResource('authors', AuthorController::class)
    ->middleware('auth.optional')
    ->except(['store', 'update', 'destroy']);

Route::apiResource('books', BookController::class)
    ->middleware('auth.optional')
    ->except(['store', 'update', 'destroy']);

Route::apiResource('publishers', PublisherController::class)
    ->middleware('auth.optional')
    ->except(['store', 'update', 'destroy']);

Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'can:admin'], function () {
        Route::apiResource('authors', AuthorController::class)->except(['index', 'show']);
        Route::apiResource('books', BookController::class)->except(['index', 'show']);
        Route::apiResource('publishers', PublisherController::class)->except(['index', 'show']);
    });

    Route::post('logout', [UserController::class, 'logout']);

    Route::get('profile', [UserController::class, 'profile']);
    Route::post('favorite/{book}', [UserController::class, 'favorite']);
    Route::post('un-favorite/{book}', [UserController::class, 'unFavorite']);
});
