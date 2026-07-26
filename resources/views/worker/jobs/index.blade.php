<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Jobs - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-5xl px-6 py-10">

    <div>
        <h1 class="text-2xl font-bold text-slate-900">Available Jobs</h1>
        <p class="mt-1 text-slate-600">
            Browse currently open work opportunities.
        </p>
    </div>

    <div class="mt-8 grid gap-5 md:grid-cols-2">

        @forelse ($jobs as $job)

            <div class="rounded-xl bg-white p-6 shadow-sm">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            {{ $job->title }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-600">
                            {{ $job->category }}
                        </p>
                    </div>

                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">
                        Open
                    </span>

                </div>

                <div class="mt-5 space-y-3">

                    <div>
                        <p class="text-sm text-slate-500">Area</p>
                        <p class="font-medium text-slate-900">{{ $job->area }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Work Date</p>
                        <p class="font-medium text-slate-900">
                            {{ $job->work_date->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Budget</p>
                        <p class="font-semibold text-slate-900">
                            BDT {{ number_format($job->budget, 2) }}
                        </p>
                    </div>

                </div>

                <a
                    href="{{ route('worker.jobs.show', $job) }}"
                    class="mt-6 inline-block rounded-lg bg-emerald-600 px-4 py-2 font-medium text-white hover:bg-emerald-700"
                >
                    View Details
                </a>

            </div>

        @empty

            <div class="rounded-xl bg-white p-10 text-center shadow-sm md:col-span-2">
                <h2 class="font-semibold text-slate-900">
                    No available jobs
                </h2>

                <p class="mt-2 text-slate-600">
                    There are currently no open jobs available.
                </p>
            </div>

        @endforelse

    </div>

</div>

</body>
</html>