<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmashController;
use App\Http\Controllers\PersonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/smash', [SmashController::class, 'index'])->name('smash.index');
Route::post('/smash/vote', [SmashController::class, 'vote'])->name('smash.vote');

Route::get('/ranking', [SmashController::class, 'ranking'])->name('ranking.index');

Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');