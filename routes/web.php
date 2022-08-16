<?php

use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::resource('tasks', \App\Http\Controllers\TasksController::class);
