@extends('layouts.app')

@section('title', 'Worker Dashboard - KormoShala')

@section('content')

<div class="mx-auto max-w-[1180px]">

    {{-- Header --}}
    <div>
        <h1 class="text-[22px] font-bold leading-tight text-slate-900">
            Welcome back, {{ auth()->user()->name }}!
        </h1>

        <p class="mt-1 text-[12px] text-slate-500">
            Find the best jobs and grow your work.
        </p>
    </div>


    {{-- Metrics --}}
    <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Available Jobs --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-brand-light text-brand">
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         class="h-[18px] w-[18px]">
                        <rect x="3" y="7" width="18" height="13" rx="2"/>
                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[11px] font-medium text-slate-500">
                        Available Jobs
                    </p>

                    <p class="mt-1 text-[22px] font-bold leading-none text-slate-900">
                        {{ $availableJobs }}
                    </p>

                    <p class="mt-2 text-[10px] font-medium text-brand">
                        Open jobs right now
                    </p>
                </div>

            </div>

        </div>


        {{-- Applications --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-brand-light text-brand">
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         class="h-[18px] w-[18px]">
                        <rect x="5" y="4" width="14" height="16" rx="2"/>
                        <path d="M9 8h6M9 12h6"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[11px] font-medium text-slate-500">
                        My Applications
                    </p>

                    <p class="mt-1 text-[22px] font-bold leading-none text-slate-900">
                        {{ $totalApplications }}
                    </p>

                    <p class="mt-2 text-[10px] font-medium text-brand">
                        Total applications
                    </p>
                </div>

            </div>

        </div>


        {{-- Assigned --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-info-light text-info">
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         class="h-[18px] w-[18px]">
                        <rect x="3" y="7" width="18" height="13" rx="2"/>
                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
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
                        Jobs in progress
                    </p>
                </div>

            </div>

        </div>


        {{-- Completed --}}
        <div class="rounded-lg border border-border bg-white p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-warning-light text-warning">
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         class="h-[18px] w-[18px]">
                        <path d="M5 12l4 4L19 6"/>
                        <circle cx="12" cy="12" r="9"/>
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
                        Jobs completed
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- Main Dashboard Content --}}
    <div class="mt-4 grid gap-4 lg:grid-cols-[minmax(0,1.55fr)_minmax(280px,0.75fr)]">

        {{-- Recommended / Quick Job Access --}}
        <section class="rounded-lg border border-border bg-white">

            <div class="flex items-center justify-between border-b border-border-light px-4 py-3">

                <h2 class="text-[13px] font-bold text-slate-900">
                    Recommended Jobs
                </h2>

                <a
                    href="{{ route('worker.jobs.index') }}"
                    class="text-[10px] font-semibold text-brand hover:text-brand-dark"
                >
                    View all
                </a>

            </div>


            <div class="divide-y divide-border-light">

                <a
                    href="{{ route('worker.jobs.index') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-warning-light text-warning">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             class="h-4 w-4">
                            <path d="m13 2-7 11h6l-1 9 7-12h-6z"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-slate-900">
                            Browse available jobs
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            Find open work opportunities near you.
                        </p>
                    </div>

                    <span class="rounded-md bg-brand-light px-2 py-1 text-[9px] font-semibold text-brand">
                        {{ $availableJobs }} Open
                    </span>
                </a>


                <a
                    href="{{ route('worker.applications.index') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-info-light text-info">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             class="h-4 w-4">
                            <rect x="4" y="4" width="16" height="16" rx="2"/>
                            <path d="M8 9h8M8 13h6"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-slate-900">
                            My Applications
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            Review your submitted job offers.
                        </p>
                    </div>

                    <span class="text-[11px] font-bold text-slate-900">
                        {{ $totalApplications }}
                    </span>
                </a>


                <a
                    href="{{ route('worker.work.index') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-info-light text-info">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             class="h-4 w-4">
                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                            <path d="M3 12h18"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-slate-900">
                            Assigned Jobs
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            Track the jobs assigned to you.
                        </p>
                    </div>

                    <span class="rounded-md bg-info-light px-2 py-1 text-[9px] font-semibold text-info">
                        {{ $assignedJobs }}
                    </span>
                </a>


                <a
                    href="{{ route('worker.work.index') }}"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-brand-light text-brand">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             class="h-4 w-4">
                            <path d="M5 12l4 4L19 6"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[12px] font-semibold text-slate-900">
                            Completed Work
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            View completed jobs and ratings.
                        </p>
                    </div>

                    <span class="rounded-md bg-brand-light px-2 py-1 text-[9px] font-semibold text-brand">
                        {{ $completedJobs }}
                    </span>
                </a>

            </div>

        </section>


        {{-- Profile Summary --}}
        <aside class="rounded-lg border border-border bg-white">

            <div class="flex items-center justify-between border-b border-border-light px-4 py-3">

                <h2 class="text-[13px] font-bold text-slate-900">
                    Profile Summary
                </h2>

                @if($profile)
                    <a
                        href="{{ route('worker.profile.edit') }}"
                        class="text-[10px] font-semibold text-brand hover:text-brand-dark"
                    >
                        View profile
                    </a>
                @endif

            </div>


            <div class="p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand-light text-[17px] font-bold text-brand">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-[13px] font-bold text-slate-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="mt-0.5 text-[10px] text-slate-500">
                            {{ $profile?->category ?? 'Worker profile incomplete' }}
                        </p>

                        @if($profile)
                            <p class="mt-0.5 text-[10px] text-slate-500">
                                {{ $profile->area }}
                            </p>
                        @endif

                    </div>

                </div>


                <div class="mt-4 flex items-center gap-2">

                    <span class="text-[13px] text-warning">★</span>

                    <span class="text-[12px] font-bold text-slate-900">
                        {{ number_format($averageRating ?? 0, 1) }}
                    </span>

                    <span class="text-[10px] text-slate-400">
                        average rating
                    </span>

                </div>


                <div class="mt-4 border-t border-border-light pt-4">

                    <p class="text-[10px] font-medium uppercase tracking-wide text-slate-400">
                        Expected Rate
                    </p>

                    <p class="mt-1 text-[14px] font-bold text-slate-900">
                        @if($profile)
                            ৳{{ number_format($profile->expected_rate, 0) }}
                        @else
                            Not set
                        @endif
                    </p>

                </div>


                @if(!$profile)
                    <a
                        href="{{ route('worker.profile.create') }}"
                        class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md bg-brand px-4 text-[11px] font-semibold text-white hover:bg-brand-dark"
                    >
                        Create Profile
                    </a>
                @endif

            </div>

        </aside>

    </div>

</div>

@endsection