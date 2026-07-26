<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Job $job)
    {
        if ($job->hirer_id !== auth()->id()) {
            abort(403);
        }

        if ($job->status !== 'completed') {
            abort(403);
        }

        if (!$job->selected_worker_id) {
            abort(403);
        }

        $existingReview = Review::where('job_id', $job->id)->first();

        if ($existingReview) {
            return redirect()
                ->route('hirer.work.index')
                ->with('error', 'This job has already been reviewed.');
        }

        $job->load('selectedWorker');

        return view('hirer.reviews.create', compact('job'));
    }

    public function store(Request $request, Job $job)
    {
        if ($job->hirer_id !== auth()->id()) {
            abort(403);
        }

        if ($job->status !== 'completed') {
            abort(403);
        }

        if (!$job->selected_worker_id) {
            abort(403);
        }

        $alreadyReviewed = Review::where('job_id', $job->id)->exists();

        if ($alreadyReviewed) {
            return redirect()
                ->route('hirer.work.index')
                ->with('error', 'This job has already been reviewed.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'review' => ['nullable', 'string', 'max:3000'],
        ]);

        Review::create([
            'job_id' => $job->id,
            'hirer_id' => auth()->id(),
            'worker_id' => $job->selected_worker_id,
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? null,
        ]);

        return redirect()
            ->route('hirer.work.index')
            ->with('success', 'Review submitted successfully.');
    }
}