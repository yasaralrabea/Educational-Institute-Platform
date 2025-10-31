<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsTasksController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LightingController;
use App\Http\Controllers\AuthenticatedSessionController;


Route::middleware('auth')->group(function () {

    Route::get('/home', function () {return view('home'); })->name('home'); 

    Route::get('/', [AuthenticatedSessionController::class, 'home'])->name('home');

    

    Route::get('/mytasks', [StudentsTasksController::class, 's_index'])->name('s_index');
    Route::get('/mytasks/{id}', [StudentsTasksController::class, 'my_task'])->name('my_task');
    Route::post('/mytasks/store', [StudentsTasksController::class, 'task_store'])->name('task_store');

    Route::get('/my/absences', [AbsenceController::class, 'my_absences'])->name('my.absences');
    Route::get('/my/profile', [ProfileController::class, 'my_profile'])->name('my.profile');
    Route::get('/my/calendar', [TasksController::class, 'my_calendar'])->name('my.calendar');
    Route::get('/my/plan', [PlansController::class, 'my_plan'])->name('my.plan');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('message.index');
    Route::get('/messages/fetch', [MessageController::class, 'fetch'])->name('message.fetch');
    Route::post('/messages', [MessageController::class, 'store'])->name('message.store');
    Route::get('/messages/{id}/edit', [MessageController::class, 'edit'])->name('message.edit');
    Route::put('/messages/{id}', [MessageController::class, 'update'])->name('message.update');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('message.destroy');

    // Lighting for students
    Route::get('/lighting_s', [LightingController::class, 'index_to_student'])->name('lighting_s.index');
});
