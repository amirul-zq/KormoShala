<?php

namespace App\Http\Controllers;

use App\Models\WorkerProfile;
use Illuminate\Http\Request;

class AdminVerificationController extends Controller
{
    public function index(Request $request)
    {
        $profiles = WorkerProfile::query()
            ->with('user')
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = trim($request->string('search')->toString());

                    $query->where(function ($subQuery) use ($search) {
                        $subQuery
                            ->where('category', 'like', "%{$search}%")
                            ->orWhere('area', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")
                            ->orWhereHas(
                                'user',
                                fn ($userQuery) => $userQuery
                                    ->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%")
                                    ->orWhere('whatsapp_number', 'like', "%{$search}%")
                            );
                    });
                }
            )
            ->when(
                $request->filled('status'),
                fn ($query) => $query->where(
                    'verification_status',
                    $request->string('status')->toString()
                )
            )
            ->when(
                $request->filled('category'),
                fn ($query) => $query->where(
                    'category',
                    $request->string('category')->toString()
                )
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = WorkerProfile::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $totalProfiles = WorkerProfile::count();

        $pendingProfiles = WorkerProfile::where(
            'verification_status',
            'pending'
        )->count();

        $verifiedProfiles = WorkerProfile::where(
            'verification_status',
            'verified'
        )->count();

        $rejectedProfiles = WorkerProfile::where(
            'verification_status',
            'rejected'
        )->count();

        return view('admin.verification.index', compact(
            'profiles',
            'categories',
            'totalProfiles',
            'pendingProfiles',
            'verifiedProfiles',
            'rejectedProfiles'
        ));
    }

    public function update(
        Request $request,
        WorkerProfile $workerProfile
    ) {
        $validated = $request->validate([
            'verification_status' => [
                'required',
                'in:pending,verified,rejected',
            ],
        ]);

        $workerProfile->update($validated);

        return back()->with(
            'success',
            'Worker verification status updated successfully.'
        );
    }
}