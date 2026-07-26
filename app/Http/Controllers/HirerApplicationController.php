<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\DB;

class HirerApplicationController extends Controller
{
    public function index(Job $job)
    {
        if ($job->hirer_id !== auth()->id()) {
            abort(403);
        }

        $job->load([
            'applications.worker.workerProfile',
            'applications.worker.reviewsReceived',
        ]);

        return view('hirer.applications.index', compact('job'));
    }

    public function select(Job $job, int $workerId)
    {
        if ($job->hirer_id !== auth()->id()) {
            abort(403);
        }

        if ($job->status !== 'open') {
            abort(403);
        }

        $application = $job->applications()
            ->where('worker_id', $workerId)
            ->first();

        if (!$application) {
            abort(403);
        }

        DB::transaction(function () use ($job, $workerId) {
            $job->update([
                'selected_worker_id' => $workerId,
                'status' => 'assigned',
            ]);
        });

        return redirect()
            ->route('hirer.jobs.show', $job)
            ->with('success', 'Worker selected successfully.');
    }
}