<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-7xl px-6 py-10">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Admin Dashboard
            </h1>

            <p class="mt-2 text-slate-600">
                Welcome, {{ auth()->user()->name }}
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="rounded-lg bg-red-600 px-4 py-2 font-medium text-white hover:bg-red-700"
            >
                Logout
            </button>
        </form>

    </div>


    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <p class="text-sm text-slate-500">Total Users</p>
            <p class="mt-2 text-3xl font-bold">
                {{ $totalUsers }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-6 shadow-sm">
            <p class="text-sm text-slate-500">Workers</p>
            <p class="mt-2 text-3xl font-bold">
                {{ $totalWorkers }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-6 shadow-sm">
            <p class="text-sm text-slate-500">Hirers</p>
            <p class="mt-2 text-3xl font-bold">
                {{ $totalHirers }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-6 shadow-sm">
            <p class="text-sm text-slate-500">Total Jobs</p>
            <p class="mt-2 text-3xl font-bold">
                {{ $totalJobs }}
            </p>
        </div>

    </div>


    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">

        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Open Jobs</p>
            <p class="mt-2 text-2xl font-bold">
                {{ $openJobs }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Assigned Jobs</p>
            <p class="mt-2 text-2xl font-bold">
                {{ $assignedJobs }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Completed Jobs</p>
            <p class="mt-2 text-2xl font-bold">
                {{ $completedJobs }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Applications</p>
            <p class="mt-2 text-2xl font-bold">
                {{ $totalApplications }}
            </p>
        </div>


        <div class="rounded-xl bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Reviews</p>
            <p class="mt-2 text-2xl font-bold">
                {{ $totalReviews }}
            </p>
        </div>

    </div>

</div>

</body>
</html>