<?php

use Illuminate\Support\Facades\Route;

Route::post('/home', function(){
    return view('leaderboard');
})->name('home');

Route::get('/home', function(){
    return view('leaderboard');
})->name('home');

Route::get('/houses/meghna_magpies', function(){
    return view('houses/meghna_magpies');
})->name('meghna_magpies');

Route::get('/houses/teesta_tigers', function(){
    return view('houses/teesta_tigers');
})->name('teesta_tigers');

Route::get('/houses/jamuna_jackals', function(){
    return view('houses/jamuna_jackals');
})->name('jamuna_jackals');

Route::get('/houses/padma_pythons', function(){
    return view('houses/padma_pythons');
})->name('padma_pythons');