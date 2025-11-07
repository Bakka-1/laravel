<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
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
            'title' => $request->title,
            'salary' => $request->salary,
            'employer_id' => 1, // For now, use first employer
        ]);

        return redirect('/jobs')->with('success', 'Job created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        // Load relationships
        $job->load(['employer', 'tags']);
        
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
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

        $job->update([
            'title' => $request->title,
            'salary' => $request->salary,
        ]);

        return redirect("/jobs/{$job->id}")->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect('/jobs')->with('success', 'Job deleted successfully!');
    }
}
