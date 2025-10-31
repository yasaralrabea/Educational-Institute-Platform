<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\RecitationController;
use App\Http\Controllers\FinController;
use App\Http\Controllers\LightingController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StudentsTasksController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\PlansController;

Route::middleware(['auth', 'CheckRole'])->group(function () {

    Route::get('/control_page', function () { return view('control_page'); })->name('control_page'); 

    // Teachers
    Route::resource('teachers', TeacherController::class);
    Route::post('/teachers/{id}/promote', [TeacherController::class, 'promote'])->name('teachers.promote');
    Route::post('/teachers/{id}/demote', [TeacherController::class, 'demote'])->name('teachers.demote');

    // Students
    Route::resource('students', StudentsController::class);

    // Absences
    Route::get('/absences', [AbsenceController::class, 'absences'])->name('absences.index');
    Route::post('/absences/store', [AbsenceController::class, 'store'])->name('absences.store');
    Route::delete('/absence/{id}', [AbsenceController::class, 'destroy'])->name('absences.destroy');
    Route::put('/absence/{id}', [AbsenceController::class, 'update'])->name('absences.update');

    // Recitations
    Route::resource('recitations', RecitationController::class);
    Route::post('/recitations/{id}/done', [RecitationController::class, 'done'])->name('recitations.done');

    // Finances
    Route::get('/fin', [FinController::class, 'index'])->name('fins.index');
    Route::post('/fins', [FinController::class, 'store'])->name('financial.store');
    Route::put('/fins/{fin}', [FinController::class, 'update'])->name('financial.update');
    Route::delete('/fins/{fin}', [FinController::class, 'destroy'])->name('financial.destroy');
    Route::put('/budget/update', [FinController::class, 'update_budget'])->name('budget.update');

    // Lighting
    Route::resource('lighting', LightingController::class);

    // Files
    Route::resource('files', FileController::class);

    // Students Tasks
    Route::resource('tasks', StudentsTasksController::class);
    Route::get('/tasks/{id}/visit', [StudentsTasksController::class, 'task'])->name('visit.task');
    Route::get('/tasks/{id}/close', [StudentsTasksController::class, 'close'])->name('tasks.close');
    Route::get('/tasks/{id}/open', [StudentsTasksController::class, 'open'])->name('tasks.open');
    Route::get('/submissions/{id}', [StudentsTasksController::class, 'submission_show'])->name('submission.show');
    Route::put('/submissions/{id}/rate', [StudentsTasksController::class, 'rate'])->name('submissions.rate');
    Route::post('/tasks/{id}/delete', [StudentsTasksController::class, 'destroy'])->name('task.destroy');

    // Calendar
    Route::get('/calendar', [TasksController::class, 'get_calendar'])->name('calendars.index');
    Route::post('/calendar/store', [TasksController::class, 'store'])->name('calendar.store');
    Route::put('/calendar/{id}', [TasksController::class, 'update'])->name('calendar.update');
    Route::delete('/calendar/{id}', [TasksController::class, 'destroy'])->name('calendar.destroy');
    Route::put('/calendar/{id}/done', [TasksController::class, 'done'])->name('calendar.done');

    // Plans
    Route::get('/plans', [PlansController::class, 'index'])->name('plans.index');
    Route::get('/student-recitations/{student}', [PlansController::class, 'getByStudent']);
});
