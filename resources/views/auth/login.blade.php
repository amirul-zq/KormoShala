<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KormoShala</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-md bg-white border border-slate-200 rounded-xl p-8">

        <h1 class="text-2xl font-bold mb-2">Login</h1>
        <p class="text-slate-600 mb-6">Sign in to your KormoShala account.</p>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block font-medium mb-1">Email</label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-lg border border-slate-300 px-3 py-2"
                >

                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-medium mb-1">Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2"
                >

                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input
                    id="remember"
                    name="remember"
                    type="checkbox"
                    class="rounded border-slate-300"
                >

                <label for="remember" class="text-sm">
                    Remember me
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg px-4 py-2"
            >
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-600">
            Don't have an account?

            <a
                href="{{ route('register') }}"
                class="text-emerald-700 font-medium"
            >
                Register
            </a>
        </p>

    </div>
</div>

</body>
</html>