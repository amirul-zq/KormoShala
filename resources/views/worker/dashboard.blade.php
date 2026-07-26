<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-6xl px-6 py-10">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

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


    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">
                Applications
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $totalApplications }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">
                Assigned Jobs
            </p>

            <p class="mt-2 text-3xl font-bold text-sky-700">
                {{ $assignedJobs }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">
                Completed Jobs
            </p>

            <p class="mt-2 text-3xl font-bold text-emerald-700">
                {{ $completedJobs }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">
                Average Rating
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ number_format($averageRating ?? 0, 1) }}
            </p>
        </div>

    </div>


    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm">

        <h2 class="text-lg font-semibold text-slate-900">
            Quick Actions
        </h2>


        <div class="mt-5 flex flex-wrap gap-3">

            @if ($profile)

                <a
                    href="{{ route('worker.profile.edit') }}"
                    class="rounded-lg bg-emerald-600 px-5 py-3 font-medium text-white hover:bg-emerald-700"
                >
                    Edit Profile
                </a>

            @else

                <a
                    href="{{ route('worker.profile.create') }}"
                    class="rounded-lg bg-emerald-600 px-5 py-3 font-medium text-white hover:bg-emerald-700"
                >
                    Create Profile
                </a>

            @endif


            <a
                href="{{ route('worker.jobs.index') }}"
                class="rounded-lg border border-slate-300 px-5 py-3 font-medium text-slate-700 hover:bg-slate-50"
            >
                Available Jobs
            </a>


            <a
                href="{{ route('worker.applications.index') }}"
                class="rounded-lg border border-slate-300 px-5 py-3 font-medium text-slate-700 hover:bg-slate-50"
            >
                My Applications
            </a>


            <a
                href="{{ route('worker.work.index') }}"
                class="rounded-lg border border-slate-300 px-5 py-3 font-medium text-slate-700 hover:bg-slate-50"
            >
                Assigned Work
            </a>

        </div>

    </div>

</div>

</body>
</html>