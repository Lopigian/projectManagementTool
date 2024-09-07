<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\TasksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/auth/login', [LoginController::class, 'login'])->name('auth.login');

Route::middleware('auth:sanctum')->group(function () {
   Route::controller(ProjectsController::class)->group(function () {
      Route::post('/projects', 'create')->name('projects.create');
      Route::put('/projects', 'update')->name('projects.update');
      Route::delete('/projects/{id}', 'delete')->name('projects.delete');
      Route::get('/projects/all', 'getAll')->name('projects.getAll');
      Route::get('/projects/{id}', 'getById')->name('projects.getById');
   });

    Route::controller(TasksController::class)->group(function () {
        Route::post('/tasks', 'create')->name('tasks.create');
        Route::put('/tasks', 'update')->name('tasks.update');
        Route::delete('/tasks/{id}', 'delete')->name('tasks.delete');
        Route::get('/tasks/all', 'getAll')->name('tasks.getAll');
        Route::get('/tasks/{id}', 'getById')->name('tasks.getById');
    });
});
