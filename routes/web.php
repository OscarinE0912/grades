<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('subjects.index'));

Route::resource('subjects', SubjectController::class)
     ->only(['index', 'store', 'show', 'destroy']);

Route::prefix('subjects/{subject}/activities')
     ->name('activities.')
     ->group(function () {
         Route::get('create',          [ActivityController::class, 'create'])->name('create');
         Route::post('/',              [ActivityController::class, 'store'])->name('store');
         Route::get('{activity}/edit', [ActivityController::class, 'edit'])->name('edit');
         Route::put('{activity}',      [ActivityController::class, 'update'])->name('update');
         Route::delete('{activity}',   [ActivityController::class, 'destroy'])->name('destroy');
     });