@extends('layouts.app')

@section('title', 'Hirer Dashboard - KormoShala')

@section('content')

<div class="mx-auto max-w-[1180px]">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-[22px] font-bold leading-tight text-slate-900">
                Welcome back, {{ auth()->user()->name }}!
            </h1>

            <p class="mt-1 text-[12px] text-slate-500">
                Manage your jobs and find the best workers.
            </p>
        </div>

        <a
            href="{{ route('hirer.jobs.create') }}"
            class="inline-flex h-9 items-center justify-center gap-2 rounded-md bg-brand px-4 text-[11px] font-semibold text-white hover:bg-brand-dark"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                class="h-4 w-4"
            >
                <path d="M12 5v14M5 12h14"/>
            </svg>

            Post a New Job
        </a>

    </div>


    {{-- Metrics --}}
    <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-5">

        {{-- Total Jobs --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-brand-light text-brand">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <rect x="3" y="7" width="18" height="13" rx="2"/>
                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[11px] font-medium text-slate-500">
                        Total Jobs
                    </p>

                    <p class="mt-1 text-[22px] font-bold leading-none text-slate-900">
                        {{ $totalJobs }}
                    </p>

                    <p class="mt-2 text-[10px] font-medium text-brand">
                        All posted jobs
                    </p>
                </div>

            </div>

        </div>


        {{-- Open Jobs --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-brand-light text-brand">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 8v4l3 2"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[11px] font-medium text-slate-500">
                        Open Jobs
                    </p>

                    <p class="mt-1 text-[22px] font-bold leading-none text-slate-900">
                        {{ $openJobs }}
                    </p>

                    <p class="mt-2 text-[10px] font-medium text-brand">
                        Need applicants
                    </p>
                </div>

            </div>

        </div>


        {{-- Assigned Jobs --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-info-light text-info">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21a7 7 0 0 1 14 0"/>
                        <path d="M17 8h4M19 6v4"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[11px] font-medium text-slate-500">
                        Assigned Jobs
                    </p>

                    <p class="mt-1 text-[22px] font-bold leading-none text-slate-900">
                        {{ $assignedJobs }}
                    </p>

                    <p class="mt-2 text-[10px] font-medium text-blue-600">
                        Work in progress
                    </p>
                </div>

            </div>

        </div>


        {{-- Completed Jobs --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-warning-light text-warning">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M8 12l3 3 5-6"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[11px] font-medium text-slate-500">
                        Completed Jobs
                    </p>

                    <p class="mt-1 text-[22px] font-bold leading-none text-slate-900">
                        {{ $completedJobs }}
                    </p>

                    <p class="mt-2 text-[10px] font-medium text-brand">
                        Work completed
                    </p>
                </div>

            </div>

        </div>


        {{-- Applicants --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-brand-light text-brand">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21a7 7 0 0 1 14 0"/>
                        <path d="M16 3.5a4 4 0 0 1 0 7.5"/>
                        <path d="M17 14a6 6 0 0 1 5 6"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[11px] font-medium text-slate-500">
                        Total Applicants
                    </p>

                    <p class="mt-1 text-[22px] font-bold leading-none text-slate-900">
                        {{ $totalApplicants }}
                    </p>

                    <p class="mt-2 text-[10px] font-medium text-brand">
                        Across all jobs
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- Main Dashboard Content --}}
    <div class="mt-4 grid gap-4 lg:grid-cols-[minmax(0,1.55fr)_minmax(280px,0.75fr)]">

        {{-- Recent Jobs --}}
        <section class="rounded-lg border border-border bg-white">

            <div class="flex items-center justify-between border-b border-border-light px-4 py-3">

                <h2 class="text-[13px] font-bold text-slate-900">
                    Recent Jobs
                </h2>

                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="text-[10px] font-semibold text-brand hover:text-brand-dark"
                >
                    View all
                </a>

            </div>


            <div class="divide-y divide-border-light">

                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-warning-light text-warning">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4"
                        >
                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                            <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-slate-900">
                            My Posted Jobs
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            Review all posted job details and statuses.
                        </p>
                    </div>

                    <span class="text-[11px] font-bold text-slate-900">
                        {{ $totalJobs }}
                    </span>
                </a>


                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-brand-light text-brand">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 8v4l3 2"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-slate-900">
                            Open Jobs
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            Jobs currently receiving applications.
                        </p>
                    </div>

                    <span class="rounded-md bg-brand-light px-2 py-1 text-[9px] font-semibold text-brand">
                        {{ $openJobs }}
                    </span>
                </a>


                <a
                    href="{{ route('hirer.work.index') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-info-light text-info">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4"
                        >
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M2 21a7 7 0 0 1 14 0"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-slate-900">
                            Assigned Work
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            Manage ongoing work and selected workers.
                        </p>
                    </div>

                    <span class="rounded-md bg-info-light px-2 py-1 text-[9px] font-semibold text-info">
                        {{ $assignedJobs }}
                    </span>
                </a>


                <a
                    href="{{ route('hirer.work.index') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-brand-light text-brand">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4"
                        >
                            <path d="M5 12l4 4L19 6"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-slate-900">
                            Completed Work
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            Review completed jobs and worker performance.
                        </p>
                    </div>

                    <span class="rounded-md bg-brand-light px-2 py-1 text-[9px] font-semibold text-brand">
                        {{ $completedJobs }}
                    </span>
                </a>

            </div>

        </section>


        {{-- Quick Actions --}}
        <aside class="rounded-lg border border-border bg-white">

            <div class="border-b border-border-light px-4 py-3">
                <h2 class="text-[13px] font-bold text-slate-900">
                    Quick Actions
                </h2>
            </div>


            <div class="space-y-3 p-4">

                <a
                    href="{{ route('hirer.jobs.create') }}"
                    class="inline-flex h-10 w-full items-center justify-center gap-2 rounded-md bg-brand px-4 text-[11px] font-semibold text-white hover:bg-brand-dark"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-4 w-4"
                    >
                        <path d="M12 5v14M5 12h14"/>
                    </svg>

                    Post a New Job
                </a>


                <a
                    href="{{ route('hirer.jobs.index') }}"
                    class="inline-flex h-10 w-full items-center justify-center rounded-md border border-brand-border bg-white px-4 text-[11px] font-semibold text-brand hover:bg-brand-light"
                >
                    My Jobs
                </a>


                <a
                    href="{{ route('hirer.work.index') }}"
                    class="inline-flex h-10 w-full items-center justify-center rounded-md border border-brand-border bg-white px-4 text-[11px] font-semibold text-brand hover:bg-brand-light"
                >
                    Assigned Jobs
                </a>


                <div class="rounded-lg bg-page p-4">

                    <p class="text-[10px] font-medium uppercase tracking-wide text-slate-400">
                        Applicant Summary
                    </p>

                    <p class="mt-2 text-[22px] font-bold leading-none text-slate-900">
                        {{ $totalApplicants }}
                    </p>

                    <p class="mt-2 text-[10px] text-slate-500">
                        Applications received across your jobs.
                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection