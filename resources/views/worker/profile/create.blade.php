@extends('layouts.app')

@section('title', 'Create Worker Profile - KormoShala')

@section('content')

<div class="mx-auto max-w-5xl">

    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            Create Worker Profile
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Add your work information so hirers can learn about your services.
        </p>
    </div>


    <div class="mt-6 grid gap-6 lg:grid-cols-[minmax(0,1fr)_300px]">

        {{-- Profile Form --}}
        <section class="rounded-lg border border-border bg-white p-5 sm:p-6">

            <form
                method="POST"
                action="{{ route('worker.profile.store') }}"
                class="space-y-6"
            >
                @csrf

                <div class="grid gap-5 sm:grid-cols-2">

                    <div>
                        <label for="category" class="block text-sm font-semibold text-slate-700">
                            Work Category
                        </label>

                        <input
                            id="category"
                            name="category"
                            type="text"
                            value="{{ old('category') }}"
                            placeholder="e.g. Electrician"
                            required
                            class="mt-2 h-11 w-full rounded-md border {{ $errors->has('category') ? 'border-danger' : 'border-border' }} bg-white px-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                        >

                        @error('category')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="area" class="block text-sm font-semibold text-slate-700">
                            Service Area
                        </label>

                        <input
                            id="area"
                            name="area"
                            type="text"
                            value="{{ old('area') }}"
                            placeholder="e.g. Mirpur, Dhaka"
                            required
                            class="mt-2 h-11 w-full rounded-md border {{ $errors->has('area') ? 'border-danger' : 'border-border' }} bg-white px-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                        >

                        @error('area')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <div>
                    <label for="expected_rate" class="block text-sm font-semibold text-slate-700">
                        Expected Rate (৳)
                    </label>

                    <div class="relative mt-2">
                        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                            ৳
                        </span>

                        <input
                            id="expected_rate"
                            name="expected_rate"
                            type="number"
                            min="0"
                            step="0.01"
                            value="{{ old('expected_rate') }}"
                            placeholder="Enter your expected rate"
                            required
                            class="h-11 w-full rounded-md border {{ $errors->has('expected_rate') ? 'border-danger' : 'border-border' }} bg-white pl-8 pr-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                        >
                    </div>

                    @error('expected_rate')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700">
                        About Your Work
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        placeholder="Describe your skills, experience and the services you provide..."
                        required
                        class="mt-2 w-full resize-none rounded-md border {{ $errors->has('description') ? 'border-danger' : 'border-border' }} bg-white px-3 py-3 text-sm leading-6 text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex justify-end border-t border-border-light pt-5">
                    <button
                        type="submit"
                        class="inline-flex h-11 w-full items-center justify-center rounded-md bg-brand px-6 text-sm font-semibold text-white hover:bg-brand-dark sm:w-auto"
                    >
                        Create Profile
                    </button>
                </div>

            </form>

        </section>


        {{-- Information Card --}}
        <aside class="h-fit rounded-lg border border-border bg-white p-5">

            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-light text-brand">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21a8 8 0 0 1 16 0"/>
                </svg>
            </div>

            <h2 class="mt-4 font-bold text-slate-900">
                Build your worker profile
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Your profile helps hirers understand what type of work you provide and where you are available.
            </p>

            <div class="mt-5 border-t border-border-light pt-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Profile includes
                </p>

                <div class="mt-3 space-y-2 text-sm text-slate-600">
                    <p>Work category</p>
                    <p>Service area</p>
                    <p>Expected rate</p>
                    <p>Work description</p>
                </div>
            </div>

        </aside>

    </div>

</div>

@endsection