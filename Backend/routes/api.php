<?php

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
Route::middleware(['cors'])->group(function () {

    Route::post('/posts', [App\Http\Controllers\HomeController::class, 'postStore'])->name('post.store');
    Route::post('/message/store', [App\Http\Controllers\ChatsController::class, 'messageStore'])->name('message.store');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
