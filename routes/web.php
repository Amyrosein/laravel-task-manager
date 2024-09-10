<?php

use App\Http\Controllers\Admin\ChecklistController;
use App\Http\Controllers\Admin\ChecklistGroupController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\LastActionAtMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth', LastActionAtMiddleware::class]], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => IsAdminMiddleware::class], function () {
        Route::resource('pages', PageController::class)
            ->only(['edit', 'update']);
        Route::resource('checklist_groups', ChecklistGroupController::class);
        Route::resource('checklist_groups.checklists', ChecklistController::class);
        Route::resource('checklists.tasks', TaskController::class);
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::post('images', [\App\Http\Controllers\Admin\ImageController::class, 'store'])->name('images.store');
    });

    Route::get('welcome', [\App\Http\Controllers\PageController::class, 'welcome'])
        ->name('welcome');
    Route::get('consultation', [\App\Http\Controllers\PageController::class, 'consultation'])
        ->name('consultation');
    Route::get('checklists/{checklist}', [\App\Http\Controllers\User\ChecklistController::class, 'show'])
        ->name('users.checklists.show');
});
