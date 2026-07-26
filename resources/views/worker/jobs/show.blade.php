<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-4xl px-6 py-10">

        <div class="rounded-xl bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                <div>
                    <h1 class="text-2xl font-bold text-slate-900">
                        {{ $job->title }}
                    </h1>

                    <p class="mt-1 text-slate-600">
                        {{ $job->category }}
                    </p>
                </div>

                <span class="w-fit rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">
                    Open
                </span>

            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-3">

                <div>
                    <p class="text-sm text-slate-500">Work Area</p>
                    <p class="mt-1 font-medium text-slate-900">
                        {{ $job->area }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Work Date</p>
                    <p class="mt-1 font-medium text-slate-900">
                        {{ $job->work_date->format('d M Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Budget</p>
                    <p class="mt-1 font-semibold text-slate-900">
                        BDT {{ number_format($job->budget, 2) }}
                    </p>
                </div>

            </div>

            <div class="mt-8">
                <p class="text-sm text-slate-500">Job Description</p>

                <p class="mt-2 whitespace-pre-line leading-7 text-slate-700">
                    {{ $job->description }}
                </p>
            </div>

            <div class="mt-8 flex flex-wrap gap-3">

                <a
                    href="{{ route('worker.applications.create', $job) }}"
                    class="rounded-lg bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700">
                    Apply for This Job
                </a>

                <a
                    href="{{ route('worker.jobs.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-2.5 font-medium text-slate-700 hover:bg-slate-50">
                    Back to Available Jobs
                </a>

            </div>

        </div>

    </div>

</body>

</html>