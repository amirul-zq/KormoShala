<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with('workerProfile')
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = trim($request->string('search')->toString());

                    $query->where(function ($subQuery) use ($search) {
                        $subQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('whatsapp_number', 'like', "%{$search}%")
                            ->orWhere('address', 'like', "%{$search}%");
                    });
                }
            )
            ->when(
                $request->filled('role'),
                fn ($query) => $query->where('role', $request->role)
            )
            ->when(
                $request->filled('status'),
                fn ($query) => $query->where('status', $request->status)
            )
            ->when(
                $request->filled('category'),
                function ($query) use ($request) {
                    $query->whereHas(
                        'workerProfile',
                        fn ($profileQuery) => $profileQuery->where(
                            'category',
                            $request->category
                        )
                    );
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $workerCategories = User::query()
            ->join(
                'worker_profiles',
                'users.id',
                '=',
                'worker_profiles.user_id'
            )
            ->where('users.role', 'worker')
            ->whereNotNull('worker_profiles.category')
            ->where('worker_profiles.category', '!=', '')
            ->distinct()
            ->orderBy('worker_profiles.category')
            ->pluck('worker_profiles.category');

        $totalUsers = User::count();

        $activeUsers = User::where('status', 'active')->count();

        $blockedUsers = User::where('status', 'blocked')->count();

        $totalWorkers = User::where('role', 'worker')->count();

        return view('admin.users.index', compact(
            'users',
            'workerCategories',
            'totalUsers',
            'activeUsers',
            'blockedUsers',
            'totalWorkers'
        ));
    }

    public function show(User $user)
    {
        $user->load([
            'workerProfile',
            'postedJobs',
            'applications',
            'receivedReviews',
        ]);

        return view('admin.users.show', compact('user'));
    }

    public function toggleStatus(User $user)
    {
        if ($user->role === 'admin') {
            return back()
                ->with('error', 'Admin status cannot be changed.');
        }

        $user->update([
            'status' => $user->status === 'active'
                ? 'blocked'
                : 'active',
        ]);

        return back()
            ->with('success', 'User status updated successfully.');
    }
}