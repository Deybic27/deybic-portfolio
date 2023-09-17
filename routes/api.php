<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController as PostV1;
use App\Http\Controllers\Api\V1\PostsCategoriesController as PostCategoryV1;
use App\Http\Controllers\Api\Portfolio\V1\EmailController as PortfolioEmailV1;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Blog
Route::apiResource('V1/post', PostV1::class)
    ->only(['show', 'index']);
Route::apiResource('V1/post-category', PostCategoryV1::class)
    ->only(['show']);

// Portafolio
Route::post('portfolio/V1/send-email-contact', [PortfolioEmailV1::class, 'sendEmailContact']);