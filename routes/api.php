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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','namespace' => 'App\Http\Controllers\Api'], function () {

    // Auth Routes
    Route::post("user_sign_up", [App\Http\Controllers\Api\AuthController::class, 'user_sign_up']);
    Route::post("login", [App\Http\Controllers\Api\AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api' ], function () {
        // Posts plans
        Route::get("all_posts", [App\Http\Controllers\Api\PostController::class, 'all_posts']);

        Route::apiResource("posts", App\Http\Controllers\Api\PostController::class);
        Route::post("update_post/{id}", [App\Http\Controllers\Api\PostController::class, 'update']);

        Route::post("report_content_review", [App\Http\Controllers\Api\ReportController::class, 'store']);
    });
});
