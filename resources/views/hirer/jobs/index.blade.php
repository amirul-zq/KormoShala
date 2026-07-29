@extends('layouts.app')

@section('title', 'My Jobs - KormoShala')

@section('content')

<div class="mx-auto max-w-7xl">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                My Jobs
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View and manage the jobs you have posted.
            </p>
        </div>

        <a
            href="{{ route('hirer.jobs.create') }}"
            class="inline-flex h-10 items-center justify-center gap-2 rounded-md bg-brand px-4 text-sm font-semibold text-white hover:bg-brand-dark"
        >
            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 class="h-4 w-4">
                <path d="M12 5v14M5 12h14"/>
            </svg>

            Create Job
        </a>

    </div>


    {{-- Jobs --}}
    <div class="mt-6 space-y-4">

        @forelse ($jobs as $job)

            @php
                $status = strtolower($job->status);

                $statusClasses = match ($status) {
                    'open' => 'bg-brand-light text-brand',
                    'assigned' => 'bg-blue-50 text-blue-700',
                    'completed' => 'bg-slate-100 text-slate-700',
                    default => 'bg-slate-100 text-slate-700',
                };
            @endphp


            <article class="rounded-lg border border-border bg-white">

                <div class="flex flex-col gap-5 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">

                    {{-- Main Information --}}
                    <div class="min-w-0 flex-1">

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


                        <div class="mt-5 grid gap-4 sm:grid-cols-3">

                            {{-- Work Date --}}
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


                            {{-- Budget --}}
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                    Budget
                                </p>

                                <p class="mt-1.5 text-sm font-bold text-slate-900">
                                    ৳{{ number_format($job->budget, 0) }}
                                </p>
                            </div>


                            {{-- Applicants --}}
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                    Applicants
                                </p>

                                <div class="mt-1.5 flex items-center gap-2 text-sm font-bold text-slate-900">

                                    <svg viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="2"
                                         class="h-4 w-4 text-slate-400">
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M2 21a7 7 0 0 1 14 0"/>
                                        <path d="M16 3.5a4 4 0 0 1 0 7.5"/>
                                        <path d="M17 14a6 6 0 0 1 5 6"/>
                                    </svg>

                                    {{ $job->applications_count }}

                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- Action --}}
                    <div class="border-t border-border-light pt-4 lg:border-l lg:border-t-0 lg:pl-6 lg:pt-0">

                        <a
                            href="{{ route('hirer.jobs.show', $job) }}"
                            class="inline-flex h-10 w-full items-center justify-center gap-2 rounded-md border border-border bg-white px-4 text-sm font-semibold text-slate-700 hover:border-brand-border hover:bg-brand-light hover:text-brand lg:w-auto"
                        >
                            View Details

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 class="h-4 w-4">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>

                    </div>

                </div>

            </article>

        @empty

            <div class="rounded-lg border border-border bg-white px-6 py-14 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-brand-light text-brand">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         class="h-5 w-5">
                        <rect x="3" y="7" width="18" height="13" rx="2"/>
                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>

                </div>

                <h2 class="mt-4 font-bold text-slate-900">
                    No jobs posted yet
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                    Create your first job to start receiving applications from local workers.
                </p>

                <a
                    href="{{ route('hirer.jobs.create') }}"
                    class="mt-5 inline-flex h-10 items-center justify-center rounded-md bg-brand px-5 text-sm font-semibold text-white hover:bg-brand-dark"
                >
                    Create Job
                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection