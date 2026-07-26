<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Work - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-5xl px-6 py-10">

    <div>
        <h1 class="text-2xl font-bold text-slate-900">Assigned Work</h1>
        <p class="mt-1 text-slate-600">
            Manage assigned jobs and mark completed work.
        </p>
    </div>

    @if (session('success'))
        <div class="mt-6 rounded-lg bg-emerald-50 px-4 py-3 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

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

                    <span class="w-fit rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-700">
                        {{ ucfirst($job->status) }}
                    </span>

                </div>

                <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                    <div>
                        <p class="text-sm text-slate-500">Area</p>
                        <p class="font-medium text-slate-900">
                            {{ $job->area }}
                        </p>
                    </div>

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
                        <p class="text-sm text-slate-500">Selected Worker</p>
                        <p class="font-medium text-slate-900">
                            {{ $job->selectedWorker?->name ?? 'Not available' }}
                        </p>
                    </div>

                </div>

                @if ($job->status === 'assigned')
                    <form
                        method="POST"
                        action="{{ route('hirer.jobs.complete', $job) }}"
                        class="mt-6"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="rounded-lg bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700"
                        >
                            Mark Completed
                        </button>
                    </form>
                @endif

            </div>

        @empty

            <div class="rounded-xl bg-white p-10 text-center shadow-sm">
                <h2 class="font-semibold text-slate-900">
                    No assigned work
                </h2>

                <p class="mt-2 text-slate-600">
                    You currently have no assigned jobs.
                </p>
            </div>

        @endforelse

    </div>

</div>

</body>
</html>