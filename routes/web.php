<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Static routes using Route::view shortcut
Route::view('/about', 'about');
Route::view('/contact', 'contact');

// Job resource routes
Route::resource('jobs', JobController::class);