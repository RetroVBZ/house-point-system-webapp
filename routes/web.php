<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropDownViewController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\AuthController;


// One time register routes
Route::get('/register', [TeacherAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [TeacherAuthController::class, 'register'])->name('teacher.register.post');
// login routes

// Show login form
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
// Handle login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Student routes
Route::get('/home', [DropDownViewController::class, 'showLeaderboard'])->name('home');
Route::post('/home', [DropDownViewController::class, 'showLeaderboard'])->name('home');
Route::get('/home/points', [DropDownViewController::class, 'getPoints'])->name('home.points');

Route::get('/houses/meghna_magpies', [DropDownViewController::class, 'showMeghnaMagpies'])->name('meghna_magpies');
Route::get('/houses/teesta_tigers', [DropDownViewController::class, 'showTeestaTigers'])->name('teesta_tigers');
Route::get('/houses/jamuna_jackals', [DropDownViewController::class, 'showJamunaJackals'])->name('jamuna_jackals');
Route::get('/houses/padma_pythons', [DropDownViewController::class, 'showPadmaPythons'])->name('padma_pythons');

// Teacher routes
Route::middleware(['teacher'])->group(function () {
    Route::get('/teacherView', [TeacherController::class, 'showTeacherView'])->name('teacher_view');
    Route::post('/update-points', [TeacherController::class, 'updatePoints'])->name('update_points');
});