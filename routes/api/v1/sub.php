<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'subscription'], function () {
        Route::post('/create', [SubscriptionController::class, 'createNewSubscription'])->name('subscription.create');
        Route::get('/all', [SubscriptionController::class, 'displayAllSubscriptions'])->name('subscription.all');
        Route::get('/view/{id}', [SubscriptionController::class, 'viewSingleSubscription'])->name('subscription.view');
    });
});
