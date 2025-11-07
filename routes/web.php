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
        'title' => ['required', 'min:3', 'max:255'],
        'salary' => ['required', 'numeric', 'min:0', 'max:1000000'],
    ], [
        'title.required' => 'A job title is required.',
        'title.min' => 'The job title must be at least 3 characters.',
        'title.max' => 'The job title cannot exceed 255 characters.',
        'salary.required' => 'Please specify a salary for this position.',
        'salary.numeric' => 'The salary must be a valid number.',
        'salary.min' => 'The salary cannot be negative.',
        'salary.max' => 'The salary cannot exceed $1,000,000.',
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1, // For now, use first employer
    ]);

    return redirect('/jobs')->with('success', 'Job created successfully!');
});

Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    if (!$job) {
        abort(404);
    }

    return view('jobs.edit', ['job' => $job]);
});

Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3', 'max:255'],
        'salary' => ['required', 'numeric', 'min:0', 'max:1000000'],
    ], [
        'title.required' => 'A job title is required.',
        'title.min' => 'The job title must be at least 3 characters.',
        'title.max' => 'The job title cannot exceed 255 characters.',
        'salary.required' => 'Please specify a salary for this position.',
        'salary.numeric' => 'The salary must be a valid number.',
        'salary.min' => 'The salary cannot be negative.',
        'salary.max' => 'The salary cannot exceed $1,000,000.',
    ]);

    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect("/jobs/{$id}")->with('success', 'Job updated successfully!');
});

Route::delete('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);
    $job->delete();

    return redirect('/jobs')->with('success', 'Job deleted successfully!');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::with(['employer', 'tags'])->find($id);

    if (!$job) {
        abort(404);
    }

    return view('jobs.show', ['job' => $job]);
});