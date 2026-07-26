<?php

namespace App\Http\Controllers;

use App\Models\Job;

class WorkController extends Controller
{
    public function workerIndex()
    {
        $jobs = Job::query()
            ->where('selected_worker_id', auth()->id())
            ->whereIn('status', ['assigned', 'completed'])
            ->with('hirer')
            ->latest()
            ->get();

        return view('worker.work.index', compact('jobs'));
    }

    public function hirerIndex()
    {
        $jobs = Job::query()
            ->where('hirer_id', auth()->id())
            ->whereIn('status', ['assigned', 'completed'])
            ->with('selectedWorker')
            ->latest()
            ->get();

        return view('hirer.work.index', compact('jobs'));
    }

    public function complete(Job $job)
    {
        if ($job->hirer_id !== auth()->id()) {
            abort(403);
        }

        if ($job->status !== 'assigned') {
            abort(403);
        }

        if (!$job->selected_worker_id) {
            abort(403);
        }

        $job->update([
            'status' => 'completed',
        ]);

        return redirect()
            ->route('hirer.work.index')
            ->with('success', 'Job marked as completed successfully.');
    }
}