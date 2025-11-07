<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::with(['employer', 'tags'])->get(), // Fixed: eager loading!
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::with(['employer', 'tags'])->find($id);

    if (!$job) {
        abort(404);
    }

    return view('job', ['job' => $job]);
});