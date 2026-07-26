<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants - {{ $job->title }} - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-5xl px-6 py-10">

    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            Applicants for {{ $job->title }}
        </h1>

        <p class="mt-1 text-slate-600">
            Compare Workers and select one for this job.
        </p>
    </div>

    <div class="mt-8 space-y-5">

        @forelse ($job->applications as $application)

            @php
                $worker = $application->worker;
                $profile = $worker->workerProfile;
                $averageRating = $worker->reviewsReceived->avg('rating') ?? 0;
                $reviewCount = $worker->reviewsReceived->count();
            @endphp

            <div class="rounded-xl bg-white p-6 shadow-sm">

                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">

                    <div class="flex-1">

                        <h2 class="text-xl font-semibold text-slate-900">
                            {{ $worker->name }}
                        </h2>

                        <div class="mt-4 grid gap-4 sm:grid-cols-2">

                            <div>
                                <p class="text-sm text-slate-500">Category</p>
                                <p class="font-medium text-slate-900">
                                    {{ $profile?->category ?? 'Not provided' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Service Area</p>
                                <p class="font-medium text-slate-900">
                                    {{ $profile?->area ?? 'Not provided' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Rating</p>
                                <p class="font-medium text-slate-900">
                                    {{ number_format($averageRating, 1) }} / 5
                                    ({{ $reviewCount }} reviews)
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Expected Rate</p>
                                <p class="font-medium text-slate-900">
                                    @if ($profile)
                                        BDT {{ number_format($profile->expected_rate, 2) }}
                                    @else
                                        Not provided
                                    @endif
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">WhatsApp</p>
                                <p class="font-medium text-slate-900">
                                    {{ $worker->whatsapp_number }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Address</p>
                                <p class="font-medium text-slate-900">
                                    {{ $worker->address }}
                                </p>
                            </div>

                        </div>

                        @if ($profile)
                            <div class="mt-5">
                                <p class="text-sm text-slate-500">Worker Description</p>
                                <p class="mt-1 text-slate-700">
                                    {{ $profile->description }}
                                </p>
                            </div>
                        @endif

                        <div class="mt-5">
                            <p class="text-sm text-slate-500">Offered Price</p>
                            <p class="text-lg font-semibold text-slate-900">
                                BDT {{ number_format($application->offered_price, 2) }}
                            </p>
                        </div>

                        <div class="mt-4">
                            <p class="text-sm text-slate-500">Application Message</p>
                            <p class="mt-1 text-slate-700">
                                {{ $application->message }}
                            </p>
                        </div>

                    </div>

                    @if ($job->status === 'open')
                        <form
                            method="POST"
                            action="{{ route('hirer.applications.select', [$job, $worker->id]) }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="rounded-lg bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700"
                            >
                                Select Worker
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        @empty

            <div class="rounded-xl bg-white p-10 text-center shadow-sm">
                <h2 class="font-semibold text-slate-900">
                    No applications received yet
                </h2>

                <p class="mt-2 text-slate-600">
                    Workers have not applied to this job yet.
                </p>
            </div>

        @endforelse

    </div>

    <div class="mt-8">
        <a
            href="{{ route('hirer.jobs.show', $job) }}"
            class="inline-block rounded-lg border border-slate-300 px-5 py-2.5 font-medium text-slate-700 hover:bg-slate-50"
        >
            Back to Job
        </a>
    </div>

</div>

</body>
</html>