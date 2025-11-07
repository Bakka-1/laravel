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

    return view('jobs.index', [
        'jobs' => $jobs,
        'paginationType' => $paginationType,
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::post('/jobs', function () {
    request()->validate([
        'title' => 'required|min:3',
        'salary' => 'required|numeric|min:0',
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1, // For now, use first employer
    ]);

    return redirect('/jobs');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::with(['employer', 'tags'])->find($id);

    if (!$job) {
        abort(404);
    }

    return view('jobs.show', ['job' => $job]);
});