<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropDownViewController;
use App\Http\Controllers\TeacherController;

Route::get('/home', [DropDownViewController::class, 'showLeaderboard'])->name('home');

Route::post('/home', [DropDownViewController::class, 'showLeaderboard'])->name('home');

Route::get('/houses/meghna_magpies', [DropDownViewController::class, 'showMeghnaMagpies'])->name('meghna_magpies');

Route::get('/houses/teesta_tigers', [DropDownViewController::class, 'showTeestaTigers'])->name('teesta_tigers');

Route::get('/houses/jamuna_jackals', [DropDownViewController::class, 'showJamunaJackals'])->name('jamuna_jackals');


Route::get('/houses/padma_pythons', [DropDownViewController::class, 'showPadmaPythons'])->name('padma_pythons');

Route::get('/teacherView', [TeacherController::class, 'showTeacherView'])->name('teacher_view');

Route::post('/update-points', [TeacherController::class, 'updatePoints'])->name('update_points');