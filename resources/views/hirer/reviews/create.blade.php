@extends('layouts.app')

@section('title', 'Review Worker - KormoShala')

@section('content')

<div class="mx-auto max-w-4xl">

    {{-- Back Navigation --}}
    <a
        href="{{ route('hirer.work.index') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand"
    >
        <svg viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             class="h-4 w-4">
            <path d="m15 18-6-6 6-6"/>
        </svg>

        Back to Assigned Jobs
    </a>


    {{-- Page Header --}}
    <div class="mt-4">
        <h1 class="text-2xl font-bold text-slate-900">
            Review Worker
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Rate your experience with the worker after completing the job.
        </p>
    </div>


    <div class="mt-6 grid gap-6 lg:grid-cols-[minmax(0,1fr)_300px]">

        {{-- Review Form --}}
        <section class="rounded-lg border border-border bg-white p-5 sm:p-6">

            <form
                method="POST"
                action="{{ route('hirer.reviews.store', $job) }}"
                class="space-y-6"
            >
                @csrf


                {{-- Rating --}}
                <div>
                    <label
                        for="rating"
                        class="block text-sm font-semibold text-slate-700"
                    >
                        Rating
                    </label>

                    <p class="mt-1 text-xs text-slate-400">
                        Select a rating from 1 to 5.
                    </p>

                    <select
                        id="rating"
                        name="rating"
                        required
                        class="mt-2 h-11 w-full rounded-md border
                        {{ $errors->has('rating') ? 'border-danger' : 'border-border' }}
                        bg-white px-3 text-sm text-slate-900
                        focus:border-brand focus:ring-0"
                    >
                        <option value="">Select rating</option>

                        <option value="5" @selected(old('rating') == 5)>
                            ★★★★★ — Excellent
                        </option>

                        <option value="4" @selected(old('rating') == 4)>
                            ★★★★☆ — Good
                        </option>

                        <option value="3" @selected(old('rating') == 3)>
                            ★★★☆☆ — Average
                        </option>

                        <option value="2" @selected(old('rating') == 2)>
                            ★★☆☆☆ — Poor
                        </option>

                        <option value="1" @selected(old('rating') == 1)>
                            ★☆☆☆☆ — Very Poor
                        </option>
                    </select>

                    @error('rating')
                        <p class="mt-2 text-sm text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Review --}}
                <div>
                    <div class="flex items-center justify-between gap-3">

                        <label
                            for="review"
                            class="block text-sm font-semibold text-slate-700"
                        >
                            Review
                        </label>

                        <span class="text-xs text-slate-400">
                            Optional
                        </span>

                    </div>

                    <textarea
                        id="review"
                        name="review"
                        rows="7"
                        placeholder="Share your experience working with this worker..."
                        class="mt-2 w-full resize-none rounded-md border
                        {{ $errors->has('review') ? 'border-danger' : 'border-border' }}
                        bg-white px-3 py-3 text-sm leading-6 text-slate-900
                        placeholder:text-slate-400
                        focus:border-brand focus:ring-0"
                    >{{ old('review') }}</textarea>

                    @error('review')
                        <p class="mt-2 text-sm text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 border-t border-border-light pt-5 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('hirer.work.index') }}"
                        class="inline-flex h-11 items-center justify-center rounded-md border border-border bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-md bg-brand px-6 text-sm font-semibold text-white hover:bg-brand-dark"
                    >
                        Submit Review
                    </button>

                </div>

            </form>

        </section>


        {{-- Job / Worker Summary --}}
        <aside class="h-fit rounded-lg border border-border bg-white p-5">

            <p class="text-xs font-semibold uppercase tracking-wide text-brand">
                Review Summary
            </p>


            <div class="mt-5">

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Job
                </p>

                <p class="mt-1.5 font-bold text-slate-900">
                    {{ $job->title }}
                </p>

            </div>


            <div class="mt-5 border-t border-border-light pt-5">

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Worker
                </p>

                <div class="mt-3 flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-light font-bold text-brand">
                        {{ strtoupper(substr($job->selectedWorker->name, 0, 1)) }}
                    </div>

                    <p class="font-semibold text-slate-900">
                        {{ $job->selectedWorker->name }}
                    </p>

                </div>

            </div>


            <div class="mt-5 rounded-lg bg-brand-light p-4">

                <p class="text-sm font-semibold text-brand">
                    Job completed
                </p>

                <p class="mt-1 text-xs leading-5 text-slate-500">
                    Your rating will appear on the worker's marketplace profile.
                </p>

            </div>

        </aside>

    </div>

</div>

@endsection