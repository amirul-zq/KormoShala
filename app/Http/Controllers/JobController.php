<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->where('hirer_id', auth()->id())
            ->withCount('applications')
            ->latest()
            ->get();

        return view('hirer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('hirer.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:3000'],
            'area' => ['required', 'string', 'max:255'],
            'work_date' => ['required', 'date', 'after_or_equal:today'],
            'budget' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['hirer_id'] = auth()->id();
        $validated['status'] = 'open';
        $validated['selected_worker_id'] = null;

        $job = Job::create($validated);

        return redirect()
            ->route('hirer.jobs.show', $job)
            ->with('success', 'Job created successfully.');
    }

    public function show(Job $job)
    {
        if ($job->hirer_id !== auth()->id()) {
            abort(403);
        }

        $job->loadCount('applications');

        return view('hirer.jobs.show', compact('job'));
    }
}