<?php

use App\Http\Controllers\Api\ChatController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('messages', [ChatController::class, 'addMessage']);
Route::get('messages', [ChatController::class, 'getAllMessages']);
Route::get('user/{id}', [ChatController::class, 'getUser']);

Route::get('actives', [ChatController::class, 'getAllActives']);
Route::post('actives', [ChatController::class, 'deleteCurrentUser']);
