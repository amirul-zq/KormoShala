@extends('layouts.app')

@section('title', $job->title . ' - KormoShala')

@section('content')

<div class="mx-auto max-w-6xl">

    @if (session('success'))
        <div class="mb-6 rounded-md border border-brand-border bg-brand-light px-4 py-3 text-sm font-medium text-brand">
            {{ session('success') }}
        </div>
    @endif


    <a
        href="{{ route('hirer.jobs.index') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" class="h-4 w-4">
            <path d="m15 18-6-6 6-6"/>
        </svg>

        Back to My Jobs
    </a>


    <section class="mt-4 rounded-lg border border-border bg-white">

        <div class="border-b border-border-light p-5 sm:p-6">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                <div>
                    <div class="flex flex-wrap items-center gap-3">

                        <h1 class="text-2xl font-bold text-slate-900">
                            {{ $job->title }}
                        </h1>

                        @php
                            $status = strtolower($job->status);

                            $statusClasses = match ($status) {
                                'open' => 'bg-brand-light text-brand',
                                'assigned' => 'bg-blue-50 text-blue-700',
                                'completed' => 'bg-slate-100 text-slate-700',
                                default => 'bg-slate-100 text-slate-700',
                            };
                        @endphp

                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClasses }}">
                            {{ ucfirst($job->status) }}
                        </span>

                    </div>

                    <p class="mt-2 text-sm text-slate-500">
                        {{ $job->category }}
                    </p>
                </div>


                <div class="sm:text-right">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Budget
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        ৳{{ number_format($job->budget, 0) }}
                    </p>
                </div>

            </div>

        </div>


        <div class="p-5 sm:p-6">

            <div class="grid gap-5 sm:grid-cols-3">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Work Area
                    </p>

                    <p class="mt-1.5 text-sm font-semibold text-slate-700">
                        {{ $job->area }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Work Date
                    </p>

                    <p class="mt-1.5 text-sm font-semibold text-slate-700">
                        {{ $job->work_date->format('d M Y') }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Applicants
                    </p>

                    <p class="mt-1.5 text-sm font-semibold text-slate-700">
                        {{ $job->applications_count }}
                    </p>
                </div>

            </div>


            <div class="mt-7 border-t border-border-light pt-6">

                <h2 class="text-base font-bold text-slate-900">
                    Job Description
                </h2>

                <p class="mt-3 whitespace-pre-line text-sm leading-7 text-slate-600">
                    {{ $job->description }}
                </p>

            </div>


            <div class="mt-7 flex flex-col gap-3 border-t border-border-light pt-5 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="inline-flex h-11 items-center justify-center rounded-md border border-border bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                >
                    Back to My Jobs
                </a>

                <a
                    href="{{ route('hirer.applications.index', $job) }}"
                    class="inline-flex h-11 items-center justify-center rounded-md bg-brand px-5 text-sm font-semibold text-white hover:bg-brand-dark"
                >
                    View Applicants ({{ $job->applications_count }})
                </a>

            </div>

        </div>

    </section>

</div>

@endsection