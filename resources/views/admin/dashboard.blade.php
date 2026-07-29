@extends('layouts.admin')

@section('title', 'Admin Dashboard - KormoShala')

@section('content')

@php
$jobTotal = max($totalJobs, 1);
$circumference = 301.59;

$openStroke = ($openJobs / $jobTotal) * $circumference;
$assignedStroke = ($assignedJobs / $jobTotal) * $circumference;
$completedStroke = ($completedJobs / $jobTotal) * $circumference;

$assignedOffset = -$openStroke;
$completedOffset = -($openStroke + $assignedStroke);

$applicationCounts = $applicationChartCounts->toArray();
$applicationLabels = $applicationChartLabels->toArray();

$chartMaximum = max(max($applicationCounts ?: [0]), 1);
$chartWidth = 600;
$chartHeight = 210;
$chartLeft = 42;
$chartRight = 16;
$chartTop = 16;
$chartBottom = 34;

$usableWidth = $chartWidth - $chartLeft - $chartRight;
$usableHeight = $chartHeight - $chartTop - $chartBottom;

$chartPoints = [];

foreach ($applicationCounts as $index => $count) {
$x = count($applicationCounts) > 1
? $chartLeft + (($usableWidth / (count($applicationCounts) - 1)) * $index)
: $chartLeft + ($usableWidth / 2);

$y = $chartTop + $usableHeight - (($count / $chartMaximum) * $usableHeight);

$chartPoints[] = [
'x' => round($x, 2),
'y' => round($y, 2),
'count' => $count,
'label' => $applicationLabels[$index] ?? '',
];
}

$polylinePoints = collect($chartPoints)
->map(fn ($point) => $point['x'] . ',' . $point['y'])
->implode(' ');

$areaPoints = $chartPoints
? $chartLeft . ',' . ($chartTop + $usableHeight) . ' ' .
$polylinePoints . ' ' .
($chartLeft + $usableWidth) . ',' . ($chartTop + $usableHeight)
: '';

$workerLabels = $workerCategoryLabels->toArray();
$workerCounts = $workerCategoryCounts->toArray();
$workerMaximum = max(max($workerCounts ?: [0]), 1);
@endphp


<div class="mx-auto max-w-[1600px]">

    {{-- Dashboard Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-[27px] font-bold tracking-[-0.025em] text-[#F8FAFC]">
                Dashboard
            </h1>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                Welcome back! Here's what's happening with KormoShala.
            </p>
        </div>


        <button
            type="button"
            class="inline-flex h-10 w-fit items-center gap-2 rounded-md border border-[#26384A] bg-[#17283A] px-4 text-[11px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:text-white">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                class="h-4 w-4">
                <rect x="3" y="5" width="18" height="16" rx="2" />
                <path d="M16 3v4M8 3v4M3 11h18" />
            </svg>

            {{ now()->startOfMonth()->format('M d, Y') }}
            -
            {{ now()->endOfMonth()->format('M d, Y') }}

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                class="h-3.5 w-3.5 text-[#94A3B8]">
                <path d="m6 9 6 6 6-6" />
            </svg>
        </button>

    </div>


    {{-- Main Dashboard Grid --}}
    <div class="mt-4 grid gap-3 xl:grid-cols-[minmax(0,1fr)_240px]">

        {{-- Left Dashboard Content --}}
        <div class="min-w-0 space-y-3">

            {{-- KPI Cards --}}
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">

                {{-- Total Users --}}
                <article class="min-h-[112px] rounded-lg border border-[#26384A] bg-[#142130] p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#302557] text-[#A78BFA]">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-6 w-6">
                                <circle cx="9" cy="7" r="4" />
                                <path d="M2 21a7 7 0 0 1 14 0" />
                                <path d="M16 3.5a4 4 0 0 1 0 7.5" />
                                <path d="M17 14a6 6 0 0 1 5 6" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-[12px] font-medium text-[#CBD5E1]">
                                Total Users
                            </p>

                            <p class="mt-1 text-[24px] font-bold leading-none text-white">
                                {{ number_format($totalUsers) }}
                            </p>

                            <p class="mt-3 text-[10px] text-[#4ADE80]">
                                Registered accounts
                            </p>
                        </div>

                    </div>

                </article>


                {{-- Total Workers --}}
                <article class="min-h-[112px] rounded-lg border border-[#26384A] bg-[#142130] p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#123E2D] text-[#4ADE80]">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-6 w-6">
                                <circle cx="9" cy="7" r="4" />
                                <path d="M2 21a7 7 0 0 1 14 0" />
                                <path d="M16 3.5a4 4 0 0 1 0 7.5" />
                                <path d="M17 14a6 6 0 0 1 5 6" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-[12px] font-medium text-[#CBD5E1]">
                                Total Workers
                            </p>

                            <p class="mt-1 text-[24px] font-bold leading-none text-white">
                                {{ number_format($totalWorkers) }}
                            </p>

                            <p class="mt-3 text-[10px] text-[#4ADE80]">
                                Worker accounts
                            </p>
                        </div>

                    </div>

                </article>


                {{-- Total Jobs --}}
                <article class="min-h-[112px] rounded-lg border border-[#26384A] bg-[#142130] p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#17365F] text-[#60A5FA]">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-6 w-6">
                                <rect x="3" y="7" width="18" height="13" rx="2" />
                                <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-[12px] font-medium text-[#CBD5E1]">
                                Total Jobs
                            </p>

                            <p class="mt-1 text-[24px] font-bold leading-none text-white">
                                {{ number_format($totalJobs) }}
                            </p>

                            <p class="mt-3 text-[10px] text-[#4ADE80]">
                                Marketplace jobs
                            </p>
                        </div>

                    </div>

                </article>


                {{-- Applications --}}
                <article class="min-h-[112px] rounded-lg border border-[#26384A] bg-[#142130] p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#4A3515] text-[#FBBF24]">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-6 w-6">
                                <rect x="4" y="4" width="16" height="16" rx="2" />
                                <path d="M8 9h8M8 13h6M8 17h4" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-[12px] font-medium text-[#CBD5E1]">
                                Total Applications
                            </p>

                            <p class="mt-1 text-[24px] font-bold leading-none text-white">
                                {{ number_format($totalApplications) }}
                            </p>

                            <p class="mt-3 text-[10px] text-[#4ADE80]">
                                Submitted offers
                            </p>
                        </div>

                    </div>

                </article>


                {{-- Reviews --}}
                <article class="min-h-[112px] rounded-lg border border-[#26384A] bg-[#142130] p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#4A2029] text-[#FB7185]">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-6 w-6">
                                <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2 7.5 14 3 9.6l6.2-.9z" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-[12px] font-medium text-[#CBD5E1]">
                                Total Reviews
                            </p>

                            <p class="mt-1 text-[24px] font-bold leading-none text-white">
                                {{ number_format($totalReviews) }}
                            </p>

                            <p class="mt-3 text-[10px] text-[#4ADE80]">
                                Worker reviews
                            </p>
                        </div>

                    </div>

                </article>

            </div>


            {{-- Analytical Panels --}}
            <div class="grid gap-3 lg:grid-cols-2 xl:grid-cols-[0.92fr_1.15fr_0.97fr]">

                {{-- Jobs by Status --}}
                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="px-4 py-4">
                        <h2 class="text-[16px] font-bold text-white">
                            Jobs by Status
                        </h2>
                    </div>

                    <div class="flex min-h-[270px] flex-col items-center px-4 pb-4">

                        {{-- Donut Chart --}}
                        <div class="relative h-[128px] w-[128px] shrink-0">

                            <svg viewBox="0 0 120 120" class="h-full w-full -rotate-90">

                                <circle
                                    cx="60"
                                    cy="60"
                                    r="48"
                                    fill="none"
                                    stroke="#223345"
                                    stroke-width="16" />

                                @if($totalJobs > 0)

                                <circle
                                    cx="60"
                                    cy="60"
                                    r="48"
                                    fill="none"
                                    stroke="#22C55E"
                                    stroke-width="16"
                                    stroke-dasharray="{{ $openStroke }} {{ $circumference - $openStroke }}"
                                    stroke-dashoffset="0" />

                                <circle
                                    cx="60"
                                    cy="60"
                                    r="48"
                                    fill="none"
                                    stroke="#3B82F6"
                                    stroke-width="16"
                                    stroke-dasharray="{{ $assignedStroke }} {{ $circumference - $assignedStroke }}"
                                    stroke-dashoffset="{{ $assignedOffset }}" />

                                <circle
                                    cx="60"
                                    cy="60"
                                    r="48"
                                    fill="none"
                                    stroke="#F59E0B"
                                    stroke-width="16"
                                    stroke-dasharray="{{ $completedStroke }} {{ $circumference - $completedStroke }}"
                                    stroke-dashoffset="{{ $completedOffset }}" />

                                @endif

                            </svg>

                            <div class="absolute inset-0 flex flex-col items-center justify-center">

                                <span class="text-[20px] font-bold text-white">
                                    {{ number_format($totalJobs) }}
                                </span>

                                <span class="mt-1 text-[9px] text-[#94A3B8]">
                                    Total Jobs
                                </span>

                            </div>

                        </div>


                        {{-- Status Percentages --}}
                        <div class="mt-5 w-full space-y-2.5 text-[10px]">

                            {{-- Open --}}
                            <div class="flex items-center justify-between gap-3">

                                <div class="flex min-w-0 items-center gap-2">

                                    <span class="h-2.5 w-2.5 shrink-0 rounded-full bg-[#22C55E]"></span>

                                    <span class="truncate text-[#CBD5E1]">
                                        Open
                                    </span>

                                </div>

                                <span class="shrink-0 whitespace-nowrap font-semibold text-white">
                                    {{ $openJobs }} ({{ $openJobPercentage }}%)
                                </span>

                            </div>


                            {{-- Assigned --}}
                            <div class="flex items-center justify-between gap-3">

                                <div class="flex min-w-0 items-center gap-2">

                                    <span class="h-2.5 w-2.5 shrink-0 rounded-full bg-[#3B82F6]"></span>

                                    <span class="truncate text-[#CBD5E1]">
                                        Assigned
                                    </span>

                                </div>

                                <span class="shrink-0 whitespace-nowrap font-semibold text-white">
                                    {{ $assignedJobs }} ({{ $assignedJobPercentage }}%)
                                </span>

                            </div>


                            {{-- Completed --}}
                            <div class="flex items-center justify-between gap-3">

                                <div class="flex min-w-0 items-center gap-2">

                                    <span class="h-2.5 w-2.5 shrink-0 rounded-full bg-[#F59E0B]"></span>

                                    <span class="truncate text-[#CBD5E1]">
                                        Completed
                                    </span>

                                </div>

                                <span class="shrink-0 whitespace-nowrap font-semibold text-white">
                                    {{ $completedJobs }} ({{ $completedJobPercentage }}%)
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="flex justify-center border-t border-[#223345] px-4 py-3">

                        <a
                            href="{{ route('admin.jobs.index') }}"
                            class="inline-flex h-8 items-center gap-2 rounded-md border border-[#33475B] px-4 text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white">
                            View All Jobs
                            <span>→</span>
                        </a>

                    </div>

                </section>


                {{-- Applications Overview --}}
                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="flex items-center justify-between gap-3 px-4 py-4">

                        <h2 class="text-[16px] font-bold text-white">
                            Applications Overview
                        </h2>


                        <div class="flex items-center gap-1">

                            <button
                                type="button"
                                class="h-7 rounded-md border border-[#1E7B4A] bg-[#123E2D] px-3 text-[9px] font-semibold text-[#4ADE80]">
                                This Week
                            </button>

                            <button
                                type="button"
                                class="h-7 rounded-md border border-[#26384A] bg-[#17283A] px-3 text-[9px] font-semibold text-[#94A3B8]">
                                Previous
                            </button>

                        </div>

                    </div>


                    <div class="px-3 pb-2">

                        <svg
                            viewBox="0 0 {{ $chartWidth }} {{ $chartHeight }}"
                            class="h-[210px] w-full"
                            role="img"
                            aria-label="Applications submitted during the last seven days">

                            @for($line = 0; $line
                            <= 4; $line++)
                                @php
                                $gridY=$chartTop + (($usableHeight / 4) * $line);
                                $gridValue=round($chartMaximum - (($chartMaximum / 4) * $line));
                                @endphp

                                <line
                                x1="{{ $chartLeft }}"
                                y1="{{ $gridY }}"
                                x2="{{ $chartLeft + $usableWidth }}"
                                y2="{{ $gridY }}"
                                stroke="#26384A"
                                stroke-width="1" />

                            <text
                                x="4"
                                y="{{ $gridY + 4 }}"
                                fill="#94A3B8"
                                font-size="10">
                                {{ $gridValue }}
                            </text>
                            @endfor


                            @if($chartPoints)

                            <polygon
                                points="{{ $areaPoints }}"
                                fill="#123E2D"
                                fill-opacity="0.7" />

                            <polyline
                                points="{{ $polylinePoints }}"
                                fill="none"
                                stroke="#22C55E"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round" />

                            @foreach($chartPoints as $point)

                            <circle
                                cx="{{ $point['x'] }}"
                                cy="{{ $point['y'] }}"
                                r="4"
                                fill="#22C55E"
                                stroke="#142130"
                                stroke-width="2">
                                <title>
                                    {{ $point['count'] }} applications — {{ $point['label'] }}
                                </title>
                            </circle>

                            <text
                                x="{{ $point['x'] }}"
                                y="{{ $chartHeight - 10 }}"
                                text-anchor="middle"
                                fill="#94A3B8"
                                font-size="9">
                                {{ $point['label'] }}
                            </text>

                            @endforeach

                            @endif

                        </svg>

                    </div>


                    <div class="flex flex-col gap-3 border-t border-[#223345] px-4 py-3 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-3">

                            <div class="flex h-8 w-8 items-center justify-center rounded-md bg-[#123E2D] text-[#4ADE80]">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-4 w-4">
                                    <rect x="4" y="4" width="16" height="16" rx="2" />
                                    <path d="M8 9h8M8 13h6" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-[9px] text-[#94A3B8]">
                                    Total Applications
                                </p>

                                <p class="text-[17px] font-bold text-white">
                                    {{ number_format($totalApplications) }}
                                </p>
                            </div>

                        </div>


                        <a
                            href="{{ route('admin.applications.index') }}"
                            class="inline-flex h-8 items-center gap-2 rounded-md border border-[#33475B] px-4 text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white">
                            View All Applications
                            <span>→</span>
                        </a>

                    </div>

                </section>


                {{-- Workers by Category --}}
                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="px-4 py-4">
                        <h2 class="text-[16px] font-bold text-white">
                            Workers by Category
                        </h2>
                    </div>

                    <div class="flex h-[215px] items-end justify-center px-4 pb-4">

                        @forelse($workerLabels as $index => $label)

                        @php
                        $count = $workerCounts[$index] ?? 0;

                        $barHeight = max(
                        ($count / $workerMaximum) * 145,
                        $count > 0 ? 12 : 2
                        );
                        @endphp

                        <div class="flex w-[58px] flex-col items-center justify-end">

                            <span class="mb-2 text-[10px] font-semibold text-white">
                                {{ $count }}
                            </span>

                            <div
                                class="w-[28px] rounded-t-sm bg-[#22C55E]"
                                style="height: {{ $barHeight }}px"
                                title="{{ $label }}: {{ $count }}"></div>

                            <span class="mt-2 w-[58px] truncate text-center text-[8px] text-[#CBD5E1]">
                                {{ $label }}
                            </span>

                        </div>

                        @empty

                        <div class="flex h-full w-full items-center justify-center text-[11px] text-[#94A3B8]">
                            No worker category data available.
                        </div>

                        @endforelse

                    </div>

                    <div class="flex justify-center border-t border-[#223345] px-4 py-3">

                        <a
                            href="{{ route('admin.verification.index') }}"
                            class="inline-flex h-8 items-center gap-2 rounded-md border border-[#33475B] px-4 text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white">
                            View Worker Profiles
                            <span>→</span>
                        </a>

                    </div>

                </section>

            </div>


            {{-- Recent Activity Panels --}}
            <div class="grid gap-3 lg:grid-cols-2 xl:grid-cols-3">

                {{-- Recent Jobs --}}
                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="flex items-center justify-between px-4 py-4">

                        <h2 class="text-[16px] font-bold text-white">
                            Recent Jobs
                        </h2>

                        <a
                            href="{{ route('admin.jobs.index') }}"
                            class="text-[10px] font-semibold text-[#4ADE80] hover:text-white">
                            View All
                        </a>

                    </div>


                    <div class="divide-y divide-[#223345]">

                        @forelse($recentJobs as $job)

                        @php
                        $jobStatusClasses = match(strtolower($job->status)) {
                        'open' => 'bg-[#123E2D] text-[#4ADE80]',
                        'assigned' => 'bg-[#17365F] text-[#60A5FA]',
                        'completed' => 'bg-[#4A3515] text-[#FBBF24]',
                        default => 'bg-[#17283A] text-[#CBD5E1]',
                        };
                        @endphp

                        <div class="flex items-center gap-3 px-4 py-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-[#17365F] text-[#60A5FA]">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-4 w-4">
                                    <rect x="3" y="7" width="18" height="13" rx="2" />
                                    <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                </svg>
                            </div>


                            <div class="min-w-0 flex-1">

                                <p class="truncate text-[11px] font-semibold text-white">
                                    {{ $job->title }}
                                </p>

                                <p class="mt-0.5 truncate text-[9px] text-[#94A3B8]">
                                    {{ $job->area }}
                                </p>

                            </div>


                            <span class="rounded-md px-2 py-1 text-[8px] font-semibold {{ $jobStatusClasses }}">
                                {{ ucfirst($job->status) }}
                            </span>


                            <div class="shrink-0 text-right">

                                <p class="text-[11px] font-semibold text-white">
                                    ৳{{ number_format($job->budget, 0) }}
                                </p>

                                <p class="mt-0.5 text-[8px] text-[#94A3B8]">
                                    {{ $job->created_at->format('d M Y') }}
                                </p>

                            </div>

                        </div>

                        @empty

                        <div class="px-4 py-8 text-center text-[11px] text-[#94A3B8]">
                            No jobs found.
                        </div>

                        @endforelse

                    </div>


                    <div class="flex justify-center border-t border-[#223345] px-4 py-3">

                        <a
                            href="{{ route('admin.jobs.index') }}"
                            class="inline-flex h-8 items-center gap-2 rounded-md border border-[#33475B] px-4 text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white">
                            View All Jobs
                            <span>→</span>
                        </a>

                    </div>

                </section>


                {{-- Recent Applications --}}
                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="flex items-center justify-between px-4 py-4">

                        <h2 class="text-[16px] font-bold text-white">
                            Recent Applications
                        </h2>

                        <a
                            href="{{ route('admin.applications.index') }}"
                            class="text-[10px] font-semibold text-[#4ADE80] hover:text-white">
                            View All
                        </a>

                    </div>


                    <div class="divide-y divide-[#223345]">

                        @forelse($recentApplications as $application)

                        <div class="flex items-center gap-3 px-4 py-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[11px] font-bold text-[#60A5FA]">
                                {{ strtoupper(substr($application->worker?->name ?? 'W', 0, 1)) }}
                            </div>


                            <div class="min-w-0 flex-1">

                                <p class="truncate text-[10px] text-[#CBD5E1]">
                                    <span class="font-semibold text-white">
                                        {{ $application->worker?->name ?? 'Worker' }}
                                    </span>
                                    applied for
                                </p>

                                <p class="mt-0.5 truncate text-[9px] text-[#94A3B8]">
                                    {{ $application->job?->title ?? 'Deleted job' }}
                                </p>

                            </div>


                            <div class="shrink-0 text-right">

                                <p class="text-[11px] font-semibold text-white">
                                    ৳{{ number_format($application->offered_price, 0) }}
                                </p>

                                <p class="mt-0.5 text-[8px] text-[#94A3B8]">
                                    {{ $application->created_at->format('d M Y') }}
                                </p>

                            </div>

                        </div>

                        @empty

                        <div class="px-4 py-8 text-center text-[11px] text-[#94A3B8]">
                            No applications found.
                        </div>

                        @endforelse

                    </div>


                    <div class="flex justify-center border-t border-[#223345] px-4 py-3">

                        <a
                            href="{{ route('admin.applications.index') }}"
                            class="inline-flex h-8 items-center gap-2 rounded-md border border-[#33475B] px-4 text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white">
                            View All Applications
                            <span>→</span>
                        </a>

                    </div>

                </section>


                {{-- Recent Reviews --}}
                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="flex items-center justify-between px-4 py-4">

                        <h2 class="text-[16px] font-bold text-white">
                            Recent Reviews
                        </h2>

                        <a
                            href="{{ route('admin.reviews.index') }}"
                            class="text-[10px] font-semibold text-[#4ADE80] hover:text-white">
                            View All
                        </a>

                    </div>


                    <div class="divide-y divide-[#223345]">

                        @forelse($recentReviews as $review)

                        <div class="flex items-center gap-3 px-4 py-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#123E2D] text-[11px] font-bold text-[#4ADE80]">
                                {{ strtoupper(substr($review->hirer?->name ?? 'H', 0, 1)) }}
                            </div>


                            <div class="min-w-0 flex-1">

                                <p class="truncate text-[10px] text-[#CBD5E1]">
                                    <span class="font-semibold text-white">
                                        {{ $review->hirer?->name ?? 'Hirer' }}
                                    </span>
                                    reviewed
                                </p>

                                <p class="mt-0.5 truncate text-[9px] text-[#94A3B8]">
                                    {{ $review->worker?->name ?? $review->job?->title ?? 'Worker' }}
                                </p>

                            </div>


                            <div class="shrink-0 text-right">

                                <div class="flex items-center justify-end gap-0.5 text-[10px] text-[#F59E0B]">
                                    @for($star = 1; $star <= 5; $star++)
                                        <span class="{{ $star <= $review->rating ? '' : 'text-[#64748B]' }}">
                                        ★
                                        </span>
                                        @endfor

                                        <span class="ml-1 text-[#CBD5E1]">
                                            {{ $review->rating }}
                                        </span>
                                </div>

                                <p class="mt-0.5 text-[8px] text-[#94A3B8]">
                                    {{ $review->created_at->format('d M Y') }}
                                </p>

                            </div>

                        </div>

                        @empty

                        <div class="px-4 py-8 text-center text-[11px] text-[#94A3B8]">
                            No reviews found.
                        </div>

                        @endforelse

                    </div>


                    <div class="flex justify-center border-t border-[#223345] px-4 py-3">

                        <a
                            href="{{ route('admin.reviews.index') }}"
                            class="inline-flex h-8 items-center gap-2 rounded-md border border-[#33475B] px-4 text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white">
                            View All Reviews
                            <span>→</span>
                        </a>

                    </div>

                </section>

            </div>

        </div>


        {{-- Tall Users Panel --}}
        <aside class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130] xl:min-h-full">

            <div class="flex items-center justify-between px-4 py-4">

                <h2 class="text-[16px] font-bold text-white">
                    Users
                </h2>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="text-[10px] font-semibold text-[#4ADE80] hover:text-white">
                    View All
                </a>

            </div>


            <div class="px-4">

                <div class="relative">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#94A3B8]">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>

                    <input
                        type="search"
                        placeholder="Search users..."
                        class="h-9 w-full rounded-md border border-[#2C4054] bg-[#17283A] pl-9 pr-3 text-[10px] text-white placeholder:text-[#94A3B8] focus:border-[#1E7B4A] focus:outline-none">

                </div>


                <div class="mt-3 grid grid-cols-2 gap-2">

                    <select
                        class="h-8 rounded-md border border-[#2C4054] bg-[#17283A] px-2 text-[9px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none">
                        <option>All Roles</option>
                        <option>Worker</option>
                        <option>Hirer</option>
                        <option>Admin</option>
                    </select>

                    <select
                        class="h-8 rounded-md border border-[#2C4054] bg-[#17283A] px-2 text-[9px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Blocked</option>
                    </select>

                </div>

            </div>


            <div class="mt-4 grid grid-cols-[minmax(0,1fr)_42px_48px_48px] gap-2 border-y border-[#223345] px-3 py-2 text-[8px] font-semibold text-[#94A3B8]">

                <span>User</span>
                <span>Role</span>
                <span>Status</span>
                <span>Joined</span>

            </div>


            <div class="divide-y divide-[#223345]">

                @forelse($recentUsers as $user)

                @php
                $userIsActive = strtolower($user->status ?? 'active') === 'active';

                $userStatusClass = $userIsActive
                ? 'bg-[#123E2D] text-[#4ADE80]'
                : 'bg-[#4A2029] text-[#FB7185]';
                @endphp

                <div class="grid grid-cols-[minmax(0,1fr)_42px_48px_48px] items-center gap-2 px-3 py-3">

                    <div class="flex min-w-0 items-center gap-2">

                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[9px] font-bold text-[#60A5FA]">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-[9px] font-semibold text-white">
                                {{ $user->name }}
                            </p>

                            <p class="mt-0.5 truncate text-[7px] text-[#94A3B8]">
                                {{ $user->email }}
                            </p>

                        </div>

                    </div>


                    <span class="truncate text-[8px] capitalize text-[#CBD5E1]">
                        {{ $user->role }}
                    </span>


                    <span class="w-fit rounded-md px-1.5 py-1 text-[7px] font-semibold {{ $userStatusClass }}">
                        {{ ucfirst($user->status ?? 'active') }}
                    </span>


                    <span class="text-[7px] text-[#94A3B8]">
                        {{ $user->created_at->format('d M') }}
                    </span>

                </div>

                @empty

                <div class="px-4 py-10 text-center text-[10px] text-[#94A3B8]">
                    No users found.
                </div>

                @endforelse

            </div>


            <div class="flex items-center justify-between border-t border-[#223345] px-3 py-3">

                <p class="text-[8px] text-[#94A3B8]">
                    Showing {{ $recentUsers->count() }} of {{ $totalUsers }} users
                </p>


                <div class="flex items-center gap-1">

                    <span class="flex h-6 min-w-6 items-center justify-center rounded-md border border-[#1E7B4A] bg-[#123E2D] text-[8px] font-semibold text-[#4ADE80]">
                        1
                    </span>

                    <span class="flex h-6 min-w-6 items-center justify-center rounded-md border border-[#26384A] text-[8px] text-[#94A3B8]">
                        2
                    </span>

                    <span class="flex h-6 min-w-6 items-center justify-center rounded-md border border-[#26384A] text-[8px] text-[#94A3B8]">
                        →
                    </span>

                </div>

            </div>

        </aside>

    </div>


    {{-- System Overview --}}
    <section class="mt-3 overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

        <div class="px-4 py-4">

            <h2 class="text-[16px] font-bold text-white">
                System Overview
            </h2>

        </div>


        <div class="grid grid-cols-2 border-t border-[#223345] md:grid-cols-3 xl:grid-cols-6">

            @php
            $overviewItems = [
            [
            'label' => 'Active Users',
            'value' => $activeUsers,
            'iconBg' => '#123E2D',
            'iconColor' => '#4ADE80',
            'type' => 'users',
            ],
            [
            'label' => 'Blocked Users',
            'value' => $blockedUsers,
            'iconBg' => '#4A2029',
            'iconColor' => '#FB7185',
            'type' => 'blocked',
            ],
            [
            'label' => 'Open Jobs',
            'value' => $openJobs,
            'iconBg' => '#17365F',
            'iconColor' => '#60A5FA',
            'type' => 'jobs',
            ],
            [
            'label' => 'Assigned Jobs',
            'value' => $assignedJobs,
            'iconBg' => '#4A3515',
            'iconColor' => '#FBBF24',
            'type' => 'jobs',
            ],
            [
            'label' => 'Completed Jobs',
            'value' => $completedJobs,
            'iconBg' => '#123E2D',
            'iconColor' => '#4ADE80',
            'type' => 'completed',
            ],
            [
            'label' => 'Total Reviews',
            'value' => $totalReviews,
            'iconBg' => '#302557',
            'iconColor' => '#A78BFA',
            'type' => 'reviews',
            ],
            ];
            @endphp


            @foreach($overviewItems as $index => $item)

            <div class="flex items-center gap-3 border-[#223345] p-4 {{ $index % 2 === 0 ? 'border-r' : '' }} md:border-r xl:last:border-r-0">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg"
                    style="background: {{ $item['iconBg'] }}; color: {{ $item['iconColor'] }}">
                    @if($item['type'] === 'users')
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5">
                        <circle cx="9" cy="7" r="4" />
                        <path d="M2 21a7 7 0 0 1 14 0" />
                        <path d="M16 3.5a4 4 0 0 1 0 7.5" />
                        <path d="M17 14a6 6 0 0 1 5 6" />
                    </svg>
                    @elseif($item['type'] === 'blocked')
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5">
                        <circle cx="12" cy="12" r="9" />
                        <path d="m8 8 8 8M16 8l-8 8" />
                    </svg>
                    @elseif($item['type'] === 'completed')
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M8 12l3 3 5-6" />
                    </svg>
                    @elseif($item['type'] === 'reviews')
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5">
                        <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2 7.5 14 3 9.6l6.2-.9z" />
                    </svg>
                    @else
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5">
                        <rect x="3" y="7" width="18" height="13" rx="2" />
                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                    </svg>
                    @endif
                </div>


                <div>

                    <p class="text-[10px] text-[#CBD5E1]">
                        {{ $item['label'] }}
                    </p>

                    <p class="mt-1 text-[20px] font-bold leading-none text-white">
                        {{ number_format($item['value']) }}
                    </p>

                </div>

            </div>

            @endforeach

        </div>

    </section>

</div>

@endsection