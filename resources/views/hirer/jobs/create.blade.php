@extends('layouts.app')

@section('title', 'Create Job - KormoShala')

@section('content')

<div class="mx-auto max-w-5xl">

    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            Create Job
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Provide the work details so workers can understand the job clearly.
        </p>
    </div>


    <div class="mt-6 grid gap-6 lg:grid-cols-[minmax(0,1fr)_300px]">

        {{-- Job Form --}}
        <section class="rounded-lg border border-border bg-white p-5 sm:p-6">

            <form
                method="POST"
                action="{{ route('hirer.jobs.store') }}"
                class="space-y-6"
            >
                @csrf

                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700">
                        Job Title
                    </label>

                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title') }}"
                        placeholder="e.g. Need an electrician for home wiring"
                        required
                        class="mt-2 h-11 w-full rounded-md border {{ $errors->has('title') ? 'border-danger' : 'border-border' }} bg-white px-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                    >

                    @error('title')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="grid gap-5 sm:grid-cols-2">

                    <div>
                        <label for="category" class="block text-sm font-semibold text-slate-700">
                            Category
                        </label>

                        <input
                            id="category"
                            name="category"
                            type="text"
                            value="{{ old('category') }}"
                            placeholder="e.g. Electrical"
                            required
                            class="mt-2 h-11 w-full rounded-md border {{ $errors->has('category') ? 'border-danger' : 'border-border' }} bg-white px-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                        >

                        @error('category')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="area" class="block text-sm font-semibold text-slate-700">
                            Work Area
                        </label>

                        <input
                            id="area"
                            name="area"
                            type="text"
                            value="{{ old('area') }}"
                            placeholder="e.g. Dhanmondi, Dhaka"
                            required
                            class="mt-2 h-11 w-full rounded-md border {{ $errors->has('area') ? 'border-danger' : 'border-border' }} bg-white px-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                        >

                        @error('area')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <div class="grid gap-5 sm:grid-cols-2">

                    <div>
                        <label for="work_date" class="block text-sm font-semibold text-slate-700">
                            Work Date
                        </label>

                        <input
                            id="work_date"
                            name="work_date"
                            type="date"
                            value="{{ old('work_date') }}"
                            required
                            class="mt-2 h-11 w-full rounded-md border {{ $errors->has('work_date') ? 'border-danger' : 'border-border' }} bg-white px-3 text-sm text-slate-900 focus:border-brand focus:ring-0"
                        >

                        @error('work_date')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="budget" class="block text-sm font-semibold text-slate-700">
                            Budget (৳)
                        </label>

                        <div class="relative mt-2">
                            <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                ৳
                            </span>

                            <input
                                id="budget"
                                name="budget"
                                type="number"
                                min="0"
                                step="0.01"
                                value="{{ old('budget') }}"
                                placeholder="Enter your budget"
                                required
                                class="h-11 w-full rounded-md border {{ $errors->has('budget') ? 'border-danger' : 'border-border' }} bg-white pl-8 pr-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                            >
                        </div>

                        @error('budget')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700">
                        Job Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="7"
                        placeholder="Describe the work, requirements, and anything the worker should know..."
                        required
                        class="mt-2 w-full resize-none rounded-md border {{ $errors->has('description') ? 'border-danger' : 'border-border' }} bg-white px-3 py-3 text-sm leading-6 text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex flex-col-reverse gap-3 border-t border-border-light pt-5 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('hirer.jobs.index') }}"
                        class="inline-flex h-11 items-center justify-center rounded-md border border-border bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-md bg-brand px-6 text-sm font-semibold text-white hover:bg-brand-dark"
                    >
                        Create Job
                    </button>

                </div>

            </form>

        </section>


        {{-- Guidance --}}
        <aside class="h-fit rounded-lg border border-border bg-white p-5">

            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-light text-brand">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
            </div>

            <h2 class="mt-4 font-bold text-slate-900">
                Post a clear job
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Clear job information helps workers send more accurate offers.
            </p>

            <div class="mt-5 border-t border-border-light pt-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Include
                </p>

                <div class="mt-3 space-y-2 text-sm text-slate-600">
                    <p>Specific job title</p>
                    <p>Correct work category</p>
                    <p>Accurate work location</p>
                    <p>Required work date</p>
                    <p>Clear description</p>
                    <p>Realistic budget</p>
                </div>
            </div>

        </aside>

    </div>

</div>

@endsection