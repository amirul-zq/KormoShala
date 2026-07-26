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

        @if (session('success'))
        <div class="mb-6 rounded-lg bg-emerald-50 px-4 py-3 text-emerald-700">
            {{ session('success') }}
        </div>
        @endif

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

                <span class="inline-flex w-fit rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-700">
                    {{ ucfirst($job->status) }}
                </span>

            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-2">

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
                    <p class="mt-1 font-medium text-slate-900">
                        BDT {{ number_format($job->budget, 2) }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Applicants</p>
                    <p class="mt-1 font-medium text-slate-900">
                        {{ $job->applications_count }}
                    </p>
                </div>

            </div>

            <div class="mt-8">
                <p class="text-sm text-slate-500">Description</p>

                <p class="mt-2 whitespace-pre-line leading-7 text-slate-700">
                    {{ $job->description }}
                </p>
            </div>

            <div class="mt-8 flex flex-wrap gap-3">

                <a
                    href="{{ route('hirer.applications.index', $job) }}"
                    class="rounded-lg bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700">
                    View Applicants ({{ $job->applications_count }})
                </a>

                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-2.5 font-medium text-slate-700 hover:bg-slate-50">
                    Back to My Jobs
                </a>

            </div>

        </div>

    </div>

</body>

</html>