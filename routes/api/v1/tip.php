<?php

use App\Http\Controllers\TipController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'tip'], function () {
        Route::post('/create', [TipController::class, 'createTip'])->name('tip.create');
        Route::get('/all', [TipController::class, 'viewAllTips'])->name('tip.all');
        Route::patch('/update/{id}', [TipController::class, 'updateTip'])->name('tip.update');
        Route::get('/view/{id}', [TipController::class, 'viewTip'])->name('tip.view');
        Route::delete('/delete/{id}', [TipController::class, 'deleteTip'])->name('tip.delete');
    });
});
