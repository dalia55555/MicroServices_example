<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriptionController;

Route::post('/subscriptions', [SubscriptionController::class, 'create']);
Route::patch('/subscriptions/{id}/renew', [SubscriptionController::class, 'renew']);
Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show']);

Route::middleware(['verify.subscription.token'])->group(function () {
Route::post('products', [ProductController::class,'create']);
Route::get('products', [ProductController::class,'get']);
Route::get('products/{id}', [ProductController::class,'find']);
});