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
    //return $request->user();
});


Route::get('/posts',[\App\Http\Controllers\Api\PostController::class,'index']);
Route::get('/post/{id}',[\App\Http\Controllers\Api\PostController::class,'show']);
Route::post('/posts',[\App\Http\Controllers\Api\PostController::class,'store']);
Route::post('/post/{id}',[\App\Http\Controllers\Api\PostController::class,'update']);
Route::post('/posts/{id}',[\App\Http\Controllers\Api\PostController::class,'destroy']);



