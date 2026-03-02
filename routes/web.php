<?php

use Illuminate\Support\Facades\Route;

Route::post('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/leaderboard', function(){
    return view('leaderboard');
});