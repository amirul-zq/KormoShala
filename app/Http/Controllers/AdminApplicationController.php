<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = Application::query()
            ->with([
                'job.hirer',
                'worker.workerProfile',
            ])
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = trim($request->string('search')->toString());

                    $query->where(function ($subQuery) use ($search) {
                        $subQuery
                            ->where('message', 'like', "%{$search}%")
                            ->orWhereHas(
                                'job',
                                fn ($jobQuery) => $jobQuery
                                    ->where('title', 'like', "%{$search}%")
                                    ->orWhere('category', 'like', "%{$search}%")
                                    ->orWhere('area', 'like', "%{$search}%")
                            )
                            ->orWhereHas(
                                'worker',
                                fn ($workerQuery) => $workerQuery
                                    ->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%")
                            );
                    });
                }
            )
            ->when(
                $request->filled('job_status'),
                fn ($query) => $query->whereHas(
                    'job',
                    fn ($jobQuery) => $jobQuery->where(
                        'status',
                        $request->string('job_status')->toString()
                    )
                )
            )
            ->when(
                $request->filled('category'),
                fn ($query) => $query->whereHas(
                    'job',
                    fn ($jobQuery) => $jobQuery->where(
                        'category',
                        $request->string('category')->toString()
                    )
                )
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Job::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $totalApplications = Application::count();

        $openJobApplications = Application::whereHas(
            'job',
            fn ($query) => $query->where('status', 'open')
        )->count();

        $assignedJobApplications = Application::whereHas(
            'job',
            fn ($query) => $query->where('status', 'assigned')
        )->count();

        $completedJobApplications = Application::whereHas(
            'job',
            fn ($query) => $query->where('status', 'completed')
        )->count();

        return view('admin.applications.index', compact(
            'applications',
            'categories',
            'totalApplications',
            'openJobApplications',
            'assignedJobApplications',
            'completedJobApplications'
        ));
    }

    public function show(Application $application)
    {
        $application->load([
            'job.hirer',
            'job.selectedWorker',
            'worker.workerProfile',
        ]);

        return view('admin.applications.show', compact('application'));
    }
}