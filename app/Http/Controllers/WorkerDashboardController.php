<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;

class WorkerDashboardController extends Controller
{
    public function index()
    {
        $workerId = auth()->id();

        $profile = auth()->user()->workerProfile;

        $totalApplications = Application::where('worker_id', $workerId)
            ->count();

        $assignedJobs = Job::where('selected_worker_id', $workerId)
            ->where('status', 'assigned')
            ->count();

        $completedJobs = Job::where('selected_worker_id', $workerId)
            ->where('status', 'completed')
            ->count();

        $averageRating = auth()->user()
            ->receivedReviews()
            ->avg('rating');

        return view('worker.dashboard', compact(
            'profile',
            'totalApplications',
            'assignedJobs',
            'completedJobs',
            'averageRating'
        ));
    }
}