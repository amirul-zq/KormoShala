<?php

namespace App\Http\Controllers;

use App\Models\Application;

class AdminApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with([
                'job',
                'worker'
            ])
            ->latest()
            ->get();

        return view('admin.applications.index', compact('applications'));
    }


    public function show(Application $application)
    {
        $application->load([
            'job.hirer',
            'worker'
        ]);

        return view('admin.applications.show', compact('application'));
    }
}