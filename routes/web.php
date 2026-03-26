<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\Admin\AdminApplicationController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Public Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Unified Login Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| Role-based Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (Auth::guard('web')->check()) {
        return redirect()->route('student.dashboard');
    }

    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect('/login');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Student Routes (web guard)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:web', 'check.termination'])->group(function () {

    // Dashboard
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
        ->name('student.dashboard');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Requirements / Applications
    Route::prefix('requirements')->group(function () {
        Route::get('/', [RequirementController::class, 'index'])->name('requirements.index');
        Route::post('/', [RequirementController::class, 'store'])->name('requirements.store');
        Route::get('/pdf/{id}', [RequirementController::class, 'generatePdf'])->name('requirements.pdf');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes (admin guard)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Admin Logout (added)
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Grades
    Route::prefix('grades')->group(function () {
        Route::get('/', [GradeController::class, 'index'])->name('grades.index');
        Route::post('/', [GradeController::class, 'store'])->name('grades.store');
    });

    // Applications
    Route::prefix('applications')->group(function () {
        Route::get('/', [AdminApplicationController::class, 'index'])->name('applications.index');
        Route::patch('/{application}/approve', [AdminApplicationController::class, 'approve'])->name('applications.approve');
        Route::patch('/{application}/reject', [AdminApplicationController::class, 'reject'])->name('applications.reject');
    });

    // Announcements
    Route::prefix('announcements')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::post('/', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::delete('/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Laravel Auth Routes for Students
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
