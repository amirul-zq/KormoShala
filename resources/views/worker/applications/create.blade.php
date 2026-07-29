@extends('layouts.app')

@section('title', 'Apply - ' . $job->title . ' - KormoShala')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- Back --}}
    <a
        href="{{ route('worker.jobs.show', $job) }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" class="h-4 w-4">
            <path d="m15 18-6-6 6-6"/>
        </svg>

        Back to Job Details
    </a>


    <div class="mt-4 grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">

        {{-- Application Form --}}
        <section class="rounded-lg border border-border bg-white p-5 sm:p-6">

            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Apply for This Job
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Send your price offer and a short message to the hirer.
                </p>
            </div>


            <form
                method="POST"
                action="{{ route('worker.applications.store', $job) }}"
                class="mt-7 space-y-6"
            >
                @csrf

                {{-- Offered Price --}}
                <div>
                    <label
                        for="offered_price"
                        class="block text-sm font-semibold text-slate-700"
                    >
                        Offered Price (৳)
                    </label>

                    <div class="relative mt-2">
                        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm font-medium text-slate-400">
                            ৳
                        </span>

                        <input
                            id="offered_price"
                            name="offered_price"
                            type="number"
                            min="0"
                            step="0.01"
                            value="{{ old('offered_price') }}"
                            placeholder="Enter your offered price"
                            required
                            class="h-11 w-full rounded-md border
                            {{ $errors->has('offered_price') ? 'border-danger' : 'border-border' }}
                            bg-white pl-8 pr-3 text-sm text-slate-900
                            placeholder:text-slate-400
                            focus:border-brand focus:ring-0"
                        >
                    </div>

                    @error('offered_price')
                        <p class="mt-2 text-sm text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Message --}}
                <div>
                    <div class="flex items-center justify-between gap-3">
                        <label
                            for="message"
                            class="block text-sm font-semibold text-slate-700"
                        >
                            Message
                        </label>

                        <span class="text-xs text-slate-400">
                            Tell the hirer why you're suitable
                        </span>
                    </div>

                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        required
                        placeholder="Write a short message..."
                        class="mt-2 w-full resize-none rounded-md border
                        {{ $errors->has('message') ? 'border-danger' : 'border-border' }}
                        bg-white px-3 py-3 text-sm leading-6 text-slate-900
                        placeholder:text-slate-400
                        focus:border-brand focus:ring-0"
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <p class="mt-2 text-sm text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 border-t border-border-light pt-5 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('worker.jobs.show', $job) }}"
                        class="inline-flex h-11 items-center justify-center rounded-md border border-border bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-md bg-brand px-6 text-sm font-semibold text-white hover:bg-brand-dark"
                    >
                        Submit Application
                    </button>

                </div>

            </form>

        </section>


        {{-- Job Summary --}}
        <aside class="h-fit rounded-lg border border-border bg-white p-5">

            <p class="text-xs font-semibold uppercase tracking-wide text-brand">
                Job Summary
            </p>

            <h2 class="mt-2 text-lg font-bold text-slate-900">
                {{ $job->title }}
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ $job->category }}
            </p>


            <div class="mt-5 space-y-4 border-t border-border-light pt-5">

                <div class="flex items-start gap-3">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="mt-0.5 h-4 w-4 shrink-0 text-slate-400"
                    >
                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                        <circle cx="12" cy="10" r="2"/>
                    </svg>

                    <div>
                        <p class="text-xs text-slate-400">
                            Area
                        </p>

                        <p class="mt-0.5 text-sm font-medium text-slate-700">
                            {{ $job->area }}
                        </p>
                    </div>
                </div>


                <div class="flex items-start gap-3">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="mt-0.5 h-4 w-4 shrink-0 text-slate-400"
                    >
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 11h18"/>
                    </svg>

                    <div>
                        <p class="text-xs text-slate-400">
                            Work Date
                        </p>

                        <p class="mt-0.5 text-sm font-medium text-slate-700">
                            {{ $job->work_date->format('d M Y') }}
                        </p>
                    </div>
                </div>

            </div>


            <div class="mt-5 rounded-lg bg-brand-light p-4">

                <p class="text-xs font-medium text-slate-500">
                    Hirer's Budget
                </p>

                <p class="mt-1 text-2xl font-bold text-brand">
                    ৳{{ number_format($job->budget, 0) }}
                </p>

            </div>

        </aside>

    </div>

</div>

@endsection