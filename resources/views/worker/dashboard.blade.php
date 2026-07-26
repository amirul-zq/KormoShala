<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-5xl px-6 py-10">

        <div class="flex items-center justify-between rounded-xl bg-white p-6 shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Worker Dashboard
                </h1>

                <p class="mt-1 text-slate-600">
                    Welcome, {{ auth()->user()->name }}
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="rounded-lg bg-red-600 px-4 py-2 font-medium text-white hover:bg-red-700"
                >
                    Logout
                </button>
            </form>
        </div>

    </div>

</body>
</html>