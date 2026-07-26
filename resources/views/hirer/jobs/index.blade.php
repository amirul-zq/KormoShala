<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Jobs - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-5xl px-6 py-10">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">My Jobs</h1>
            <p class="mt-1 text-slate-600">
                View and manage the jobs you have posted.
            </p>
        </div>

        <a
            href="{{ route('hirer.jobs.create') }}"
            class="rounded-lg bg-emerald-600 px-5 py-2.5 text-center font-medium text-white hover:bg-emerald-700"
        >
            Create Job
        </a>
    </div>

    <div class="mt-8 space-y-4">

        @forelse ($jobs as $job)

            <div class="rounded-xl bg-white p-6 shadow-sm">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            {{ $job->title }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-600">
                            {{ $job->category }}
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-700">
                        {{ ucfirst($job->status) }}
                    </span>

                </div>

                <div class="mt-5 grid gap-4 sm:grid-cols-3">

                    <div>
                        <p class="text-sm text-slate-500">Work Date</p>
                        <p class="font-medium text-slate-900">
                            {{ $job->work_date->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Budget</p>
                        <p class="font-medium text-slate-900">
                            BDT {{ number_format($job->budget, 2) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Applicants</p>
                        <p class="font-medium text-slate-900">
                            {{ $job->applications_count }}
                        </p>
                    </div>

                </div>

                <div class="mt-5">
                    <a
                        href="{{ route('hirer.jobs.show', $job) }}"
                        class="font-medium text-emerald-700 hover:text-emerald-800"
                    >
                        View Details →
                    </a>
                </div>

            </div>

        @empty

            <div class="rounded-xl bg-white p-10 text-center shadow-sm">
                <h2 class="font-semibold text-slate-900">
                    No jobs posted yet
                </h2>

                <p class="mt-2 text-slate-600">
                    Create your first job to start receiving applications.
                </p>

                <a
                    href="{{ route('hirer.jobs.create') }}"
                    class="mt-5 inline-block rounded-lg bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700"
                >
                    Create Job
                </a>
            </div>

        @endforelse

    </div>

</div>

</body>
</html>