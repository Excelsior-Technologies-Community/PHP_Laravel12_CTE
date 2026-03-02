<?php
// routes/web.php

use App\Http\Controllers\CTEDemoController;
use Illuminate\Support\Facades\Route;

// Make CTE demo the home page
Route::get('/', [CTEDemoController::class, 'taskHierarchy'])->name('home');

Route::prefix('cte-demo')->group(function () {
    Route::get('/hierarchy', [CTEDemoController::class, 'taskHierarchy'])->name('cte.hierarchy');
    Route::get('/statistics', [CTEDemoController::class, 'taskStatistics'])->name('cte.statistics');
    Route::get('/timeline', [CTEDemoController::class, 'taskTimeline'])->name('cte.timeline');
    Route::get('/ranking', [CTEDemoController::class, 'userRanking'])->name('cte.ranking');
    Route::get('/analysis', [CTEDemoController::class, 'complexAnalysis'])->name('cte.analysis');
});