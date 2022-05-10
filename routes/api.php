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

Route::apiResources([
    'authors' => AuthorController::class,
    'books' => BookController::class,
    'publishers' => PublisherController::class,
]);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('favorite', [UserController::class, 'favorite']);
    Route::post('un-favorite', [UserController::class, 'unFavorite']);
});
