@extends('layouts.app')

@section('title', 'Assigned Jobs - KormoShala')

@section('content')

<div class="mx-auto max-w-7xl">

    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            Assigned Jobs
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Manage assigned work, complete jobs, and review workers.
        </p>
    </div>


    {{-- Success Message --}}
    @if (session('success'))
        <div class="mt-6 rounded-md border border-brand-border bg-brand-light px-4 py-3 text-sm font-medium text-brand">
            {{ session('success') }}
        </div>
    @endif


    <div class="mt-6 space-y-4">

        @forelse ($jobs as $job)

            @php
                $status = strtolower($job->status);

                $statusClasses = match ($status) {
                    'assigned' => 'bg-blue-50 text-blue-700',
                    'completed' => 'bg-brand-light text-brand',
                    default => 'bg-slate-100 text-slate-700',
                };
            @endphp


            <article class="rounded-lg border border-border bg-white">

                {{-- Header --}}
                <div class="flex flex-col gap-4 border-b border-border-light p-5 sm:flex-row sm:items-start sm:justify-between sm:p-6">

                    <div>
                        <div class="flex flex-wrap items-center gap-3">

                            <h2 class="text-lg font-bold text-slate-900">
                                {{ $job->title }}
                            </h2>

                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClasses }}">
                                {{ ucfirst($job->status) }}
                            </span>

                        </div>

                        <p class="mt-1.5 text-sm text-slate-500">
                            {{ $job->category }}
                        </p>
                    </div>


                    <div class="sm:text-right">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Budget
                        </p>

                        <p class="mt-1 text-xl font-bold text-slate-900">
                            ৳{{ number_format($job->budget, 0) }}
                        </p>
                    </div>

                </div>


                {{-- Details --}}
                <div class="p-5 sm:p-6">

                    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Area
                            </p>

                            <div class="mt-1.5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     class="h-4 w-4 text-slate-400">
                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="2"/>
                                </svg>

                                {{ $job->area }}
                            </div>
                        </div>


                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Work Date
                            </p>

                            <div class="mt-1.5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     class="h-4 w-4 text-slate-400">
                                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                                    <path d="M16 3v4M8 3v4M3 11h18"/>
                                </svg>

                                {{ $job->work_date->format('d M Y') }}
                            </div>
                        </div>


                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Selected Worker
                            </p>

                            <div class="mt-1.5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     class="h-4 w-4 text-slate-400">
                                    <circle cx="12" cy="8" r="4"/>
                                    <path d="M4 21a8 8 0 0 1 16 0"/>
                                </svg>

                                {{ $job->selectedWorker?->name ?? 'Not available' }}
                            </div>
                        </div>

                    </div>


                    {{-- Assigned State --}}
                    @if ($job->status === 'assigned')

                        <div class="mt-6 flex flex-col gap-4 rounded-lg border border-blue-100 bg-blue-50 p-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <p class="text-sm font-semibold text-blue-800">
                                    Work in progress
                                </p>

                                <p class="mt-1 text-sm text-blue-700">
                                    Mark this job completed after the assigned work has been finished.
                                </p>
                            </div>


                            <form
                                method="POST"
                                action="{{ route('hirer.jobs.complete', $job) }}"
                                class="shrink-0"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="inline-flex h-10 w-full items-center justify-center rounded-md bg-brand px-5 text-sm font-semibold text-white hover:bg-brand-dark sm:w-auto"
                                >
                                    Mark Completed
                                </button>
                            </form>

                        </div>

                    @endif


                    {{-- Completed but Not Reviewed --}}
                    @if ($job->status === 'completed' && !$job->review)

                        <div class="mt-6 flex flex-col gap-4 rounded-lg border border-brand-border bg-brand-light p-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    Job completed
                                </p>

                                <p class="mt-1 text-sm text-slate-600">
                                    Share your experience by rating the worker.
                                </p>
                            </div>


                            <a
                                href="{{ route('hirer.reviews.create', $job) }}"
                                class="inline-flex h-10 shrink-0 items-center justify-center rounded-md bg-brand px-5 text-sm font-semibold text-white hover:bg-brand-dark"
                            >
                                Review Worker
                            </a>

                        </div>

                    @endif


                    {{-- Existing Review --}}
                    @if ($job->status === 'completed' && $job->review)

                        <div class="mt-6 rounded-lg bg-page p-5">

                            <div class="flex flex-wrap items-center justify-between gap-3">

                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Your Rating
                                    </p>

                                    <div class="mt-1.5 flex items-center gap-2">

                                        <span class="text-xl font-bold text-slate-900">
                                            {{ $job->review->rating }} / 5
                                        </span>

                                        <span class="text-amber-500">
                                            ★
                                        </span>

                                    </div>
                                </div>


                                <span class="rounded-full bg-brand-light px-2.5 py-1 text-xs font-semibold text-brand">
                                    Reviewed
                                </span>

                            </div>


                            @if ($job->review->review)

                                <div class="mt-4 border-t border-border-light pt-4">

                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Review
                                    </p>

                                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-600">
                                        {{ $job->review->review }}
                                    </p>

                                </div>

                            @endif

                        </div>

                    @endif

                </div>

            </article>

        @empty

            <div class="rounded-lg border border-border bg-white px-6 py-14 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         class="h-5 w-5">
                        <rect x="3" y="7" width="18" height="13" rx="2"/>
                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        <path d="M3 12h18"/>
                    </svg>
                </div>

                <h2 class="mt-4 font-bold text-slate-900">
                    No assigned jobs
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                    Jobs will appear here after you select a worker from your applicants.
                </p>

                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="mt-5 inline-flex h-10 items-center justify-center rounded-md border border-border bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                >
                    View My Jobs
                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection