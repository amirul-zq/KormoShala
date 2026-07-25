<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'whatsapp_number' => [
                'required',
                'string',
                'max:30',
            ],

            'address' => [
                'required',
                'string',
            ],

            'role' => [
                'required',
                Rule::in(['hirer', 'worker']),
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'whatsapp_number' => $validated['whatsapp_number'],
            'address' => $validated['address'],
            'role' => $validated['role'],
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}