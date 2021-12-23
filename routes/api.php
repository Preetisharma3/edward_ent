<?php

use App\Http\Controllers\Api\v1\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/show', [AuthController::class, 'getData']);
     Route::get('/Agreement', [AuthController::class, 'getAgreement']);
    Route::get('/edit/{id}', [AuthController::class, 'edit']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/postData', [AuthController::class, 'postData']);
     Route::get('/getTemplate', [AuthController::class, 'getTemplate']);
});
