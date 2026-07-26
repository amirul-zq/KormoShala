<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - KormoShala</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-lg bg-white border border-slate-200 rounded-xl p-8">

        <h1 class="text-2xl font-bold mb-2">Create Account</h1>
        <p class="text-slate-600 mb-6">Join KormoShala as a Hirer or Worker.</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium mb-1">Name</label>
                <input id="name" name="name" type="text"
                       value="{{ old('name') }}" required
                       class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-medium mb-1">Email</label>
                <input id="email" name="email" type="email"
                       value="{{ old('email') }}" required
                       class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="whatsapp_number" class="block font-medium mb-1">WhatsApp Number</label>
                <input id="whatsapp_number" name="whatsapp_number" type="text"
                       value="{{ old('whatsapp_number') }}" required
                       class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('whatsapp_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address" class="block font-medium mb-1">Address</label>
                <textarea id="address" name="address" required
                          class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block font-medium mb-1">Register As</label>
                <select id="role" name="role" required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2">
                    <option value="">Select role</option>
                    <option value="hirer" @selected(old('role') === 'hirer')>Hirer</option>
                    <option value="worker" @selected(old('role') === 'worker')>Worker</option>
                </select>
                @error('role')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-medium mb-1">Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block font-medium mb-1">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation"
                       type="password" required
                       class="w-full rounded-lg border border-slate-300 px-3 py-2">
            </div>

            <button type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg px-4 py-2">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-emerald-700 font-medium">
                Login
            </a>
        </p>

    </div>
</div>

</body>
</html>