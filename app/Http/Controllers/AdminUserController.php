<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }


    public function show(User $user)
    {
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