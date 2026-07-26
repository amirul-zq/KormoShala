<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply - {{ $job->title }} - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-2xl px-6 py-10">

    <div class="rounded-xl bg-white p-6 shadow-sm">

        <h1 class="text-2xl font-bold text-slate-900">
            Apply to Job
        </h1>

        <div class="mt-5 rounded-lg bg-slate-50 p-4">
            <h2 class="font-semibold text-slate-900">
                {{ $job->title }}
            </h2>

            <p class="mt-1 text-sm text-slate-600">
                {{ $job->category }} · {{ $job->area }}
            </p>

            <p class="mt-2 font-medium text-slate-900">
                Hirer Budget: BDT {{ number_format($job->budget, 2) }}
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('worker.applications.store', $job) }}"
            class="mt-6 space-y-5"
        >
            @csrf

            <div>
                <label for="offered_price" class="block font-medium text-slate-700">
                    Your Offered Price (BDT)
                </label>

                <input
                    id="offered_price"
                    name="offered_price"
                    type="number"
                    min="0"
                    step="0.01"
                    value="{{ old('offered_price') }}"
                    required
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                >

                @error('offered_price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block font-medium text-slate-700">
                    Application Message
                </label>

                <textarea
                    id="message"
                    name="message"
                    rows="5"
                    required
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                >{{ old('message') }}</textarea>

                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    class="rounded-lg bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700"
                >
                    Submit Application
                </button>

                <a
                    href="{{ route('worker.jobs.show', $job) }}"
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