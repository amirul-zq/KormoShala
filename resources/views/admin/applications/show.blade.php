<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-4xl px-6 py-10">

    <div class="flex items-center justify-between">

        <h1 class="text-3xl font-bold text-slate-900">
            Application Details
        </h1>

        <a
            href="{{ route('admin.applications.index') }}"
            class="rounded-lg border border-slate-300 px-4 py-2 hover:bg-white"
        >
            Back
        </a>

    </div>


    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm">

        <div class="space-y-5">

            <div>
                <p class="text-sm text-slate-500">
                    Job
                </p>

                <p class="font-semibold">
                    {{ $application->job->title }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Hirer
                </p>

                <p class="font-semibold">
                    {{ $application->job->hirer->name }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Worker
                </p>

                <p class="font-semibold">
                    {{ $application->worker->name }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Offered Price
                </p>

                <p class="font-semibold">
                    {{ number_format($application->offered_price, 2) }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Application Message
                </p>

                <p>
                    {{ $application->message }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Applied Date
                </p>

                <p class="font-semibold">
                    {{ $application->created_at->format('d M Y') }}
                </p>
            </div>

        </div>

    </div>

</div>

</body>
</html>