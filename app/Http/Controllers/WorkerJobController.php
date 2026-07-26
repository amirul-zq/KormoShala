<?php

namespace App\Http\Controllers;

use App\Models\Job;

class WorkerJobController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->where('status', 'open')
            ->orderBy('work_date')
            ->latest('created_at')
            ->get();

        return view('worker.jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        if ($job->status !== 'open') {
            abort(404);
        }

        return view('worker.jobs.show', compact('job'));
    }
}