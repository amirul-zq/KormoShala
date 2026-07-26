<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Worker Profile - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-2xl px-6 py-10">

        <div class="rounded-xl bg-white p-6 shadow-sm">

            <h1 class="text-2xl font-bold text-slate-900">
                Edit Worker Profile
            </h1>

            <p class="mt-1 text-slate-600">
                Update your work information.
            </p>

            @if (session('success'))
                <div class="mt-4 rounded-lg bg-emerald-50 px-4 py-3 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mt-4 rounded-lg bg-red-50 px-4 py-3 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mt-6 rounded-lg bg-slate-50 p-4">
                <p class="text-sm text-slate-600">Name</p>
                <p class="font-medium text-slate-900">{{ auth()->user()->name }}</p>

                <p class="mt-3 text-sm text-slate-600">WhatsApp</p>
                <p class="font-medium text-slate-900">{{ auth()->user()->whatsapp_number }}</p>

                <p class="mt-3 text-sm text-slate-600">Address</p>
                <p class="font-medium text-slate-900">{{ auth()->user()->address }}</p>

                <p class="mt-3 text-sm text-slate-600">Average Rating</p>
                <p class="font-medium text-slate-900">
                    {{ number_format(auth()->user()->receivedReviews()->avg('rating') ?? 0, 1) }} / 5
                </p>

                <p class="mt-3 text-sm text-slate-600">Total Reviews</p>
                <p class="font-medium text-slate-900">
                    {{ auth()->user()->receivedReviews()->count() }}
                </p>
            </div>

            <form method="POST"
                  action="{{ route('worker.profile.update') }}"
                  class="mt-6 space-y-5">

                @csrf
                @method('PUT')

                <div>
                    <label for="category" class="block font-medium text-slate-700">
                        Work Category
                    </label>

                    <input
                        id="category"
                        name="category"
                        type="text"
                        value="{{ old('category', $profile->category) }}"
                        required
                        class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                    >

                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="area" class="block font-medium text-slate-700">
                        Service Area
                    </label>

                    <input
                        id="area"
                        name="area"
                        type="text"
                        value="{{ old('area', $profile->area) }}"
                        required
                        class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                    >

                    @error('area')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block font-medium text-slate-700">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        required
                        class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                    >{{ old('description', $profile->description) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="expected_rate" class="block font-medium text-slate-700">
                        Expected Rate (BDT)
                    </label>

                    <input
                        id="expected_rate"
                        name="expected_rate"
                        type="number"
                        min="0"
                        step="0.01"
                        value="{{ old('expected_rate', $profile->expected_rate) }}"
                        required
                        class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                    >

                    @error('expected_rate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg bg-emerald-600 px-4 py-2 font-medium text-white hover:bg-emerald-700"
                >
                    Update Profile
                </button>

            </form>

        </div>

    </div>

</body>
</html>