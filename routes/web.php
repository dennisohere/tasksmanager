<?php

use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::resource('tasks', TasksController::class);
Route::post('tasks/{id}/update/priority', [TasksController::class, 'updatePriority'])->name('tasks.update.priority');
