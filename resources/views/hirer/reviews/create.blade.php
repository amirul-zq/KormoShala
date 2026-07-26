<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Worker - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-2xl px-6 py-10">

    <div class="rounded-xl bg-white p-6 shadow-sm">

        <h1 class="text-2xl font-bold text-slate-900">
            Review Worker
        </h1>

        <p class="mt-1 text-slate-600">
            Rate the Worker for the completed job.
        </p>

        <div class="mt-6 rounded-lg bg-slate-50 p-4">
            <p class="text-sm text-slate-500">Job</p>
            <p class="font-semibold text-slate-900">
                {{ $job->title }}
            </p>

            <p class="mt-3 text-sm text-slate-500">Worker</p>
            <p class="font-semibold text-slate-900">
                {{ $job->selectedWorker->name }}
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('hirer.reviews.store', $job) }}"
            class="mt-6 space-y-5"
        >
            @csrf

            <div>
                <label for="rating" class="block font-medium text-slate-700">
                    Rating
                </label>

                <select
                    id="rating"
                    name="rating"
                    required
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                >
                    <option value="">Select rating</option>
                    <option value="5" @selected(old('rating') == 5)>5 - Excellent</option>
                    <option value="4" @selected(old('rating') == 4)>4 - Good</option>
                    <option value="3" @selected(old('rating') == 3)>3 - Average</option>
                    <option value="2" @selected(old('rating') == 2)>2 - Poor</option>
                    <option value="1" @selected(old('rating') == 1)>1 - Very Poor</option>
                </select>

                @error('rating')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="review" class="block font-medium text-slate-700">
                    Review (Optional)
                </label>

                <textarea
                    id="review"
                    name="review"
                    rows="5"
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                >{{ old('review') }}</textarea>

                @error('review')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    class="rounded-lg bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700"
                >
                    Submit Review
                </button>

                <a
                    href="{{ route('hirer.work.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-2.5 font-medium text-slate-700 hover:bg-slate-50"
                >
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>