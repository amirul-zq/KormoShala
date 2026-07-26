<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-5xl px-6 py-10">

    <div class="flex items-center justify-between">

        <h1 class="text-3xl font-bold text-slate-900">
            Job Details
        </h1>

        <a
            href="{{ route('admin.jobs.index') }}"
            class="rounded-lg border border-slate-300 px-4 py-2 hover:bg-white"
        >
            Back
        </a>

    </div>


    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm">

        <div class="space-y-5">

            <div>
                <p class="text-sm text-slate-500">
                    Title
                </p>

                <p class="font-semibold">
                    {{ $job->title }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Description
                </p>

                <p>
                    {{ $job->description }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Category
                </p>

                <p class="font-semibold">
                    {{ $job->category }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Area
                </p>

                <p class="font-semibold">
                    {{ $job->area }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Work Date
                </p>

                <p class="font-semibold">
                    {{ $job->work_date->format('d M Y') }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Budget
                </p>

                <p class="font-semibold">
                    {{ number_format($job->budget, 2) }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Status
                </p>

                <p class="font-semibold capitalize">
                    {{ $job->status }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Hirer
                </p>

                <p class="font-semibold">
                    {{ $job->hirer->name }}
                </p>
            </div>


            @if($job->selectedWorker)

                <div>
                    <p class="text-sm text-slate-500">
                        Selected Worker
                    </p>

                    <p class="font-semibold">
                        {{ $job->selectedWorker->name }}
                    </p>
                </div>

            @endif


            <div>

                <p class="text-sm text-slate-500">
                    Applications
                </p>


                @if($job->applications->count())

                    <div class="mt-3 space-y-3">

                        @foreach($job->applications as $application)

                            <div class="rounded-lg bg-slate-50 p-4">

                                <p class="font-medium">
                                    {{ $application->worker->name }}
                                </p>

                                <p class="text-sm text-slate-600">
                                    Offered:
                                    {{ number_format($application->offered_price, 2) }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p class="mt-2 text-slate-500">
                        No applications yet.
                    </p>

                @endif

            </div>


            @if($job->review)

                <div>

                    <p class="text-sm text-slate-500">
                        Review
                    </p>

                    <p class="mt-2">
                        Rating:
                        {{ $job->review->rating }}/5
                    </p>

                    <p>
                        {{ $job->review->comment }}
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

</body>
</html>