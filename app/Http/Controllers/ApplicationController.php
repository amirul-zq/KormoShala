<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::query()
            ->where('worker_id', auth()->id())
            ->with('job')
            ->latest()
            ->get();

        return view('worker.applications.index', compact('applications'));
    }

    public function create(Job $job)
    {
        if ($job->status !== 'open') {
            abort(403);
        }

        $alreadyApplied = Application::query()
            ->where('job_id', $job->id)
            ->where('worker_id', auth()->id())
            ->exists();

        if ($alreadyApplied) {
            return redirect()
                ->route('worker.applications.index')
                ->with('error', 'You have already applied to this job.');
        }

        return view('worker.applications.create', compact('job'));
    }

    public function store(Request $request, Job $job)
    {
        if ($job->status !== 'open') {
            abort(403);
        }

        if ($job->hirer_id === auth()->id()) {
            abort(403);
        }

        $alreadyApplied = Application::query()
            ->where('job_id', $job->id)
            ->where('worker_id', auth()->id())
            ->exists();

        if ($alreadyApplied) {
            return redirect()
                ->route('worker.applications.index')
                ->with('error', 'You have already applied to this job.');
        }

        $validated = $request->validate([
            'offered_price' => ['required', 'numeric', 'min:0'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Application::create([
            'job_id' => $job->id,
            'worker_id' => auth()->id(),
            'offered_price' => $validated['offered_price'],
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('worker.applications.index')
            ->with('success', 'Application submitted successfully.');
    }
}