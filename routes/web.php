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
    $paginationType = request('type', 'standard');
    
    switch ($paginationType) {
        case 'simple':
            $jobs = Job::with(['employer', 'tags'])->simplePaginate(3);
            break;
        case 'cursor':
            $jobs = Job::with(['employer', 'tags'])->cursorPaginate(3);
            break;
        default:
            $jobs = Job::with(['employer', 'tags'])->paginate(3);
    }

    return view('jobs', [
        'jobs' => $jobs,
        'paginationType' => $paginationType,
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::with(['employer', 'tags'])->find($id);

    if (!$job) {
        abort(404);
    }

    return view('job', ['job' => $job]);
});