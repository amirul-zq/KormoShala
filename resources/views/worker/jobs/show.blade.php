@extends('layouts.app')

@section('title', $job->title . ' - KormoShala')

@section('content')

<div class="mx-auto max-w-6xl">

    {{-- Back Navigation --}}
    <a
        href="{{ route('worker.jobs.index') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" class="h-4 w-4">
            <path d="m15 18-6-6 6-6"/>
        </svg>

        Back to Browse Jobs
    </a>


    <div class="mt-4 grid gap-6 lg:grid-cols-[minmax(0,1fr)_340px]">

        {{-- Job Information --}}
        <section class="rounded-lg border border-border bg-white">

            {{-- Header --}}
            <div class="border-b border-border-light p-5 sm:p-6">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                    <div>
                        <div class="flex flex-wrap items-center gap-3">

                            <h1 class="text-2xl font-bold text-slate-900">
                                {{ $job->title }}
                            </h1>

                            <span class="rounded-full bg-brand-light px-2.5 py-1 text-xs font-semibold text-brand">
                                Open
                            </span>

                        </div>

                        <div class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-slate-500">

                            <span class="inline-flex items-center gap-1.5">
                                <svg viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2"
                                     class="h-4 w-4">
                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="2"/>
                                </svg>

                                {{ $job->area }}
                            </span>


                            <span class="inline-flex items-center gap-1.5">
                                <svg viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2"
                                     class="h-4 w-4">
                                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                                    <path d="M16 3v4M8 3v4M3 11h18"/>
                                </svg>

                                {{ $job->work_date->format('d M Y') }}
                            </span>

                        </div>

                    </div>


                    <div class="shrink-0 sm:text-right">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Budget
                        </p>

                        <p class="mt-1 text-2xl font-bold text-slate-900">
                            ৳{{ number_format($job->budget, 0) }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Description --}}
            <div class="p-5 sm:p-6">

                <h2 class="text-base font-bold text-slate-900">
                    Job Description
                </h2>

                <p class="mt-3 whitespace-pre-line text-sm leading-7 text-slate-600">
                    {{ $job->description }}
                </p>


                <div class="mt-7 grid gap-4 border-t border-border-light pt-6 sm:grid-cols-3">

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Category
                        </p>

                        <p class="mt-1.5 text-sm font-semibold text-slate-900">
                            {{ $job->category }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Area
                        </p>

                        <p class="mt-1.5 text-sm font-semibold text-slate-900">
                            {{ $job->area }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Work Date
                        </p>

                        <p class="mt-1.5 text-sm font-semibold text-slate-900">
                            {{ $job->work_date->format('d M Y') }}
                        </p>
                    </div>

                </div>

            </div>

        </section>


        {{-- Apply Card --}}
        <aside class="h-fit rounded-lg border border-border bg-white p-5 lg:sticky lg:top-24">

            <h2 class="text-lg font-bold text-slate-900">
                Interested in this job?
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Submit your price offer and application to the hirer.
            </p>


            <div class="mt-5 rounded-lg bg-page p-4">

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Job Budget
                </p>

                <p class="mt-1 text-xl font-bold text-slate-900">
                    ৳{{ number_format($job->budget, 0) }}
                </p>

            </div>


            <a
                href="{{ route('worker.applications.create', $job) }}"
                class="mt-5 inline-flex h-11 w-full items-center justify-center rounded-md bg-brand px-4 text-sm font-semibold text-white hover:bg-brand-dark"
            >
                Apply for This Job
            </a>


            <p class="mt-3 text-center text-xs leading-5 text-slate-400">
                You can submit your offered price and an optional message on the next step.
            </p>

        </aside>

    </div>

</div>

@endsection