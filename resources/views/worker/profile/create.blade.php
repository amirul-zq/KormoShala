<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Worker Profile - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-2xl px-6 py-10">

        <div class="rounded-xl bg-white p-6 shadow-sm">

            <h1 class="text-2xl font-bold text-slate-900">
                Create Worker Profile
            </h1>

            <p class="mt-1 text-slate-600">
                Add your work information so Hirers can learn about your services.
            </p>

            <form method="POST"
                  action="{{ route('worker.profile.store') }}"
                  class="mt-6 space-y-5">

                @csrf

                <div>
                    <label for="category" class="block font-medium text-slate-700">
                        Work Category
                    </label>

                    <input
                        id="category"
                        name="category"
                        type="text"
                        value="{{ old('category') }}"
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
                        value="{{ old('area') }}"
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
                    >{{ old('description') }}</textarea>

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
                        value="{{ old('expected_rate') }}"
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
                    Create Profile
                </button>

            </form>

        </div>

    </div>

</body>
</html>