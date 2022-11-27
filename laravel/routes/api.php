<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Admin\UserController;

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


Route::post('save_user', [APIController::class, 'save_user'])->name('save_user');
Route::get('get_role', [APIController::class, 'get_role'])->name('get_role');
Route::post('get_user_by_id', [APIController::class, 'get_user_by_id'])->name('get_user_by_id');



