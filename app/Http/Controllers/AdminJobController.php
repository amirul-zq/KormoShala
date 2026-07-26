<?php

namespace App\Http\Controllers;

use App\Models\Job;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::with([
                'hirer',
                'selectedWorker'
            ])
            ->latest()
            ->get();

        return view('admin.jobs.index', compact('jobs'));
    }


    public function show(Job $job)
    {
        $job->load([
            'hirer',
            'selectedWorker',
            'applications.worker',
            'review'
        ]);

        return view('admin.jobs.show', compact('job'));
    }
}