<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalWorkers = User::where('role', 'worker')
            ->count();

        $totalHirers = User::where('role', 'hirer')
            ->count();

        $totalJobs = Job::count();

        $openJobs = Job::where('status', 'open')
            ->count();

        $assignedJobs = Job::where('status', 'assigned')
            ->count();

        $completedJobs = Job::where('status', 'completed')
            ->count();

        $totalApplications = Application::count();

        $totalReviews = Review::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalWorkers',
            'totalHirers',
            'totalJobs',
            'openJobs',
            'assignedJobs',
            'completedJobs',
            'totalApplications',
            'totalReviews'
        ));
    }
}