<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Primary statistics
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();

        $totalWorkers = User::where('role', 'worker')->count();

        $totalHirers = User::where('role', 'hirer')->count();

        $totalAdmins = User::where('role', 'admin')->count();

        $activeUsers = User::where('status', 'active')->count();

        $blockedUsers = User::where('status', 'blocked')->count();

        $totalJobs = Job::count();

        $openJobs = Job::where('status', 'open')->count();

        $assignedJobs = Job::where('status', 'assigned')->count();

        $completedJobs = Job::where('status', 'completed')->count();

        $totalApplications = Application::count();

        $totalReviews = Review::count();


        /*
        |--------------------------------------------------------------------------
        | Recent marketplace data
        |--------------------------------------------------------------------------
        */

        $recentUsers = User::latest()
            ->take(8)
            ->get();

        $recentJobs = Job::with('hirer')
            ->latest()
            ->take(4)
            ->get();

        $recentApplications = Application::with([
            'worker',
            'job',
        ])
            ->latest()
            ->take(4)
            ->get();

        $recentReviews = Review::with([
            'hirer',
            'worker',
            'job',
        ])
            ->latest()
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Workers grouped by category
        |--------------------------------------------------------------------------
        */

        $workerCategoryData = User::query()
            ->join(
                'worker_profiles',
                'users.id',
                '=',
                'worker_profiles.user_id'
            )
            ->where('users.role', 'worker')
            ->selectRaw(
                'worker_profiles.category as category, COUNT(*) as total'
            )
            ->groupBy('worker_profiles.category')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        $workerCategoryLabels = $workerCategoryData
            ->pluck('category')
            ->values();

        $workerCategoryCounts = $workerCategoryData
            ->pluck('total')
            ->map(fn ($count) => (int) $count)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Applications overview — last seven days
        |--------------------------------------------------------------------------
        */

        $applicationChartLabels = collect();

        $applicationChartCounts = collect();

        for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {
            $date = Carbon::today()->subDays($daysAgo);

            $applicationChartLabels->push(
                $date->format('d M')
            );

            $applicationChartCounts->push(
                Application::whereDate('created_at', $date)->count()
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Jobs by status percentages
        |--------------------------------------------------------------------------
        */

        $openJobPercentage = $totalJobs > 0
            ? round(($openJobs / $totalJobs) * 100, 1)
            : 0;

        $assignedJobPercentage = $totalJobs > 0
            ? round(($assignedJobs / $totalJobs) * 100, 1)
            : 0;

        $completedJobPercentage = $totalJobs > 0
            ? round(($completedJobs / $totalJobs) * 100, 1)
            : 0;


        return view('admin.dashboard', compact(
            'totalUsers',
            'totalWorkers',
            'totalHirers',
            'totalAdmins',
            'activeUsers',
            'blockedUsers',
            'totalJobs',
            'openJobs',
            'assignedJobs',
            'completedJobs',
            'totalApplications',
            'totalReviews',
            'recentUsers',
            'recentJobs',
            'recentApplications',
            'recentReviews',
            'workerCategoryLabels',
            'workerCategoryCounts',
            'applicationChartLabels',
            'applicationChartCounts',
            'openJobPercentage',
            'assignedJobPercentage',
            'completedJobPercentage'
        ));
    }
}