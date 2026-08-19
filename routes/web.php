<?php

use App\Http\Controllers\CTEDemoController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [CTEDemoController::class, 'taskHierarchy']
)->name('home');


/*
|--------------------------------------------------------------------------
| CTE Demonstrations
|--------------------------------------------------------------------------
*/

Route::prefix('cte-demo')->group(function () {

    /*
     * Demo 1
     * Recursive task hierarchy
     */
    Route::get(
        '/hierarchy',
        [CTEDemoController::class, 'taskHierarchy']
    )->name('cte.hierarchy');


    /*
     * Demo 2
     * Task statistics
     */
    Route::get(
        '/statistics',
        [CTEDemoController::class, 'taskStatistics']
    )->name('cte.statistics');


    /*
     * Demo 3
     * Timeline analysis
     */
    Route::get(
        '/timeline',
        [CTEDemoController::class, 'taskTimeline']
    )->name('cte.timeline');


    /*
     * Demo 4
     * User performance ranking
     */
    Route::get(
        '/ranking',
        [CTEDemoController::class, 'userRanking']
    )->name('cte.ranking');


    /*
     * Demo 5
     * Complex multi-CTE analysis
     */
    Route::get(
        '/analysis',
        [CTEDemoController::class, 'complexAnalysis']
    )->name('cte.analysis');


    /*
     * Demo 6
     * Overdue workload analysis
     */
    Route::get(
        '/overdue-analysis',
        [CTEDemoController::class, 'overdueAnalysis']
    )->name('cte.overdue-analysis');


    /*
     * Demo 7
     * Recursive task impact analysis
     */
    Route::get(
        '/task-impact',
        [CTEDemoController::class, 'taskImpactAnalysis']
    )->name('cte.task-impact');
});

/*
|--------------------------------------------------------------------------
| Task Management
|--------------------------------------------------------------------------
*/

Route::prefix('tasks')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Task List
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/',
        [TaskController::class, 'index']
    )->name('tasks.index');

    /*
    |--------------------------------------------------------------------------
    | CSV Export
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/export',
        [TaskController::class, 'export']
    )->name('tasks.export');

    /*
    |--------------------------------------------------------------------------
    | Analytics
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/analytics',
        [TaskController::class, 'analytics']
    )->name('tasks.analytics');

    /*
    |--------------------------------------------------------------------------
    | Trash
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/trash',
        [TaskController::class, 'trash']
    )->name('tasks.trash');

    /*
    |--------------------------------------------------------------------------
    | Restore
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/trash/{id}/restore',
        [TaskController::class, 'restore']
    )->name('tasks.restore');

    /*
    |--------------------------------------------------------------------------
    | Permanent Delete
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/trash/{id}/force-delete',
        [TaskController::class, 'forceDelete']
    )->name('tasks.force-delete');

    /*
    |--------------------------------------------------------------------------
    | Task Details
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/{task}',
        [TaskController::class, 'show']
    )->name('tasks.show');

    /*
    |--------------------------------------------------------------------------
    | Move To Trash
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/{task}',
        [TaskController::class, 'destroy']
    )->name('tasks.destroy');
});
