<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('website', WebsiteController::class)->only([
    'index',
    'store',
    'update',
    'destroy',
]);

Route::get('website/{website:domain}', [WebsiteController::class, 'show']);
Route::match(['put', 'patch'], 'website/{website:domain}', [WebsiteController::class, 'update']);
Route::delete('website/{website:domain}', [WebsiteController::class, 'destroy']);

Route::post('website/{website:domain}/post', [WebsiteController::class, 'addPost']);

Route::post('website/{website:domain}/subscribe', [WebsiteController::class, 'subscribe']);
