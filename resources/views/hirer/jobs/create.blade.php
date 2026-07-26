<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-2xl px-6 py-10">

    <div class="rounded-xl bg-white p-6 shadow-sm">

        <h1 class="text-2xl font-bold text-slate-900">Create Job</h1>

        <p class="mt-1 text-slate-600">
            Provide the work details for Workers.
        </p>

        <form method="POST"
              action="{{ route('hirer.jobs.store') }}"
              class="mt-6 space-y-5">

            @csrf

            <div>
                <label for="title" class="block font-medium text-slate-700">
                    Job Title
                </label>

                <input
                    id="title"
                    name="title"
                    type="text"
                    value="{{ old('title') }}"
                    required
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                >

                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="block font-medium text-slate-700">
                    Category
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
                <label for="area" class="block font-medium text-slate-700">
                    Work Area
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
                <label for="work_date" class="block font-medium text-slate-700">
                    Work Date
                </label>

                <input
                    id="work_date"
                    name="work_date"
                    type="date"
                    value="{{ old('work_date') }}"
                    required
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                >

                @error('work_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="budget" class="block font-medium text-slate-700">
                    Budget (BDT)
                </label>

                <input
                    id="budget"
                    name="budget"
                    type="number"
                    min="0"
                    step="0.01"
                    value="{{ old('budget') }}"
                    required
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                >

                @error('budget')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    class="rounded-lg bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700"
                >
                    Create Job
                </button>

                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-2.5 font-medium text-slate-700 hover:bg-slate-50"
                >
                    My Jobs
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>