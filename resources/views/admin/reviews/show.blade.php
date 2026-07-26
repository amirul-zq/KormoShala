<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Details - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-4xl px-6 py-10">

    <div class="flex items-center justify-between">

        <h1 class="text-3xl font-bold text-slate-900">
            Review Details
        </h1>

        <a
            href="{{ route('admin.reviews.index') }}"
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
                    {{ $review->job->title }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Hirer
                </p>

                <p class="font-semibold">
                    {{ $review->hirer->name }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Worker
                </p>

                <p class="font-semibold">
                    {{ $review->worker->name }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Rating
                </p>

                <p class="font-semibold">
                    {{ $review->rating }}/5
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Review
                </p>

                <p>
                    {{ $review->review ?? 'No written review provided.' }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Submitted Date
                </p>

                <p class="font-semibold">
                    {{ $review->created_at->format('d M Y') }}
                </p>
            </div>

        </div>

    </div>

</div>

</body>
</html>