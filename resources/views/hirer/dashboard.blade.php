<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirer Dashboard - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-6xl px-6 py-10">

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
                class="rounded-lg bg-red-600 px-4 py-2 font-medium text-white hover:bg-red-700"
            >
                Logout
            </button>
        </form>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">

        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Jobs</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $totalJobs }}
            </p>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Open Jobs</p>
            <p class="mt-2 text-3xl font-bold text-emerald-700">
                {{ $openJobs }}
            </p>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Assigned Jobs</p>
            <p class="mt-2 text-3xl font-bold text-sky-700">
                {{ $assignedJobs }}
            </p>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Completed Jobs</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $completedJobs }}
            </p>
        </div>

        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Applicants</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $totalApplicants }}
            </p>
        </div>

    </div>

    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-slate-900">
            Quick Actions
        </h2>

        <div class="mt-5 flex flex-wrap gap-3">

            <a
                href="{{ route('hirer.jobs.create') }}"
                class="rounded-lg bg-emerald-600 px-5 py-3 font-medium text-white hover:bg-emerald-700"
            >
                Create Job
            </a>

            <a
                href="{{ route('hirer.jobs.index') }}"
                class="rounded-lg border border-slate-300 px-5 py-3 font-medium text-slate-700 hover:bg-slate-50"
            >
                My Jobs
            </a>

            <a
                href="{{ route('hirer.work.index') }}"
                class="rounded-lg border border-slate-300 px-5 py-3 font-medium text-slate-700 hover:bg-slate-50"
            >
                Assigned Work
            </a>

        </div>
    </div>

</div>

</body>
</html>