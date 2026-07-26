<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirer Dashboard - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-5xl px-6 py-10">

        <div class="rounded-xl bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        Hirer Dashboard
                    </h1>

                    <p class="mt-1 text-slate-600">
                        Welcome, {{ auth()->user()->name }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="rounded-lg bg-red-600 px-4 py-2 font-medium text-white hover:bg-red-700">
                        Logout
                    </button>
                </form>

            </div>

            <div class="mt-8 flex flex-wrap gap-3">

                <a
                    href="{{ route('hirer.jobs.create') }}"
                    class="rounded-lg bg-emerald-600 px-5 py-3 font-medium text-white hover:bg-emerald-700">
                    Create Job
                </a>

                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-3 font-medium text-slate-700 hover:bg-slate-50">
                    My Jobs
                </a>

                <a
                    href="{{ route('hirer.work.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-3 font-medium text-slate-700 hover:bg-slate-50">
                    Assigned Work
                </a>

            </div>

        </div>

    </div>

</body>

</html>