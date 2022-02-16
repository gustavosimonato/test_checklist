<?php

use App\Http\Controllers\CakeController;
use App\Http\Controllers\InterestedController;
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

Route::get('cakes', [CakeController::class, 'index']);
Route::post('cake/create', [CakeController::class, 'create']);
Route::get('cake/{id}', [CakeController::class, 'show']);
Route::put('cake/update', [CakeController::class, 'update']);
Route::delete('cake/delete', [CakeController::class, 'destroy']);

Route::post('interested/subscribe', [InterestedController::class, "subscribe"]);