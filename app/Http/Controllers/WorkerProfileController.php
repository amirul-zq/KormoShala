<?php

namespace App\Http\Controllers;

use App\Models\WorkerProfile;
use Illuminate\Http\Request;

class WorkerProfileController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if ($user->workerProfile) {
            return redirect()->route('worker.profile.edit');
        }

        return view('worker.profile.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->workerProfile) {
            return redirect()
                ->route('worker.profile.edit')
                ->with('error', 'You already have a Worker Profile.');
        }

        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'area' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'expected_rate' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['user_id'] = $user->id;

        WorkerProfile::create($validated);

        return redirect()
            ->route('worker.profile.edit')
            ->with('success', 'Worker Profile created successfully.');
    }

    public function edit()
    {
        $profile = auth()->user()->workerProfile;

        if (!$profile) {
            return redirect()->route('worker.profile.create');
        }

        return view('worker.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = auth()->user()->workerProfile;

        if (!$profile) {
            return redirect()->route('worker.profile.create');
        }

        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'area' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'expected_rate' => ['required', 'numeric', 'min:0'],
        ]);

        $profile->update($validated);

        return redirect()
            ->route('worker.profile.edit')
            ->with('success', 'Worker Profile updated successfully.');
    }
}