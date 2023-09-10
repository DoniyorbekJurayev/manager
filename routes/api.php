<?php

use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChannelController;

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
Route::get("/channel-get", [ChannelController::class, 'get']);
Route::post("/channel-create", [ChannelController::class, 'create']);
Route::put("/channel-update/{channelId}", [ChannelController::class, 'update']);
Route::delete('/channel-delete/{channelId}', [ChannelController::class, 'delete']);

// messages
Route::get("/message-get", [MessageController::class, "get"]);
Route::post('/message-create', [MessageController::class, "create"]);