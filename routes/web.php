<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\GameController as GuruGameController;
use App\Http\Controllers\OrangTua\DashboardController as OrangTuaDashboardController;
use App\Http\Controllers\OrangTua\StudentController as OrangTuaStudentController;
use App\Http\Controllers\OrangTua\GameController as OrangTuaGameController;

// Public Routes
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::resource('users', UserController::class);
    Route::resource('parents', ParentController::class);
    
    // Student Management
    Route::resource('students', AdminStudentController::class);
    
    // Schedule Management
    Route::resource('schedules', ScheduleController::class);
});

// Guru Routes
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    
    // Game Management
    Route::resource('games', GuruGameController::class);
    Route::post('/games/{game}/publish', [GuruGameController::class, 'publish'])->name('games.publish');
    Route::get('/games/{game}/assign', [GuruGameController::class, 'assignStudents'])->name('games.assign');
    Route::post('/games/{game}/assign', [GuruGameController::class, 'updateAssignments'])->name('games.assign.update');
});

// Orang Tua Routes
Route::middleware(['auth', 'role:orang_tua'])->prefix('orangtua')->name('orangtua.')->group(function () {
    Route::get('/dashboard', [OrangTuaDashboardController::class, 'index'])->name('dashboard');
    
    // Student Detail
    Route::get('/students/{student}', [OrangTuaStudentController::class, 'show'])->name('students.show');
    Route::get('/students/{student}/report', [OrangTuaStudentController::class, 'weeklyReport'])->name('students.report');
    
    // Game Play
    Route::get('/students/{student}/games/{game}/play', [OrangTuaGameController::class, 'play'])->name('games.play');
    Route::post('/students/{student}/games/{game}/submit', [OrangTuaGameController::class, 'submit'])->name('games.submit');
});