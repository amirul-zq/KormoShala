<?php

namespace App\Http\Controllers;

use App\Models\WorkerProfile;

class AdminVerificationController extends Controller
{
    public function index()
    {
        $profiles = WorkerProfile::with('user')
            ->latest()
            ->get();

        return view('admin.verification.index', compact('profiles'));
    }


    public function update(WorkerProfile $workerProfile)
    {
        $status = request()->validate([
            'verification_status' => [
                'required',
                'in:pending,verified,rejected',
            ],
        ]);


        $workerProfile->update($status);


        return back()
            ->with('success', 'Worker verification status updated successfully.');
    }
}