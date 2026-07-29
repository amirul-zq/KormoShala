<?php
namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::query()
            ->with([
                'hirer',
                'selectedWorker',
            ])
            ->withCount('applications')
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = trim($request->string('search')->toString());

                    $query->where(function ($subQuery) use ($search) {
                        $subQuery
                            ->where('title', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%")
                            ->orWhere('area', 'like', "%{$search}%")
                            ->orWhereHas(
                                'hirer',
                                fn($hirerQuery) => $hirerQuery->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                )
                            );
                    });
                }
            )
            ->when(
                $request->filled('status'),
                fn($query) => $query->where(
                    'status',
                    $request->string('status')->toString()
                )
            )
            ->when(
                $request->filled('category'),
                fn($query) => $query->where(
                    'category',
                    $request->string('category')->toString()
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

        $totalJobs = Job::count();

        $openJobs = Job::where('status', 'open')->count();

        $assignedJobs = Job::where('status', 'assigned')->count();

        $completedJobs = Job::where('status', 'completed')->count();

        return view('admin.jobs.index', compact(
            'jobs',
            'categories',
            'totalJobs',
            'openJobs',
            'assignedJobs',
            'completedJobs'
        ));
    }

    public function show(Job $job)
    {
        $job->load([
            'hirer',
            'selectedWorker',
            'applications.worker',
            'review',
        ]);

        return view('admin.jobs.show', compact('job'));
    }

    public function destroy(Job $job)
    {
        $jobTitle = $job->title;

        $job->delete();

        return redirect()
            ->route('admin.jobs.index')
            ->with(
                'success',
                "The job \"{$jobTitle}\" was removed successfully."
            );
    }

}
