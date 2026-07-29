@extends('layouts.admin')

@section('title', 'Application Details - KormoShala')

@section('content')

@php
    $job = $application->job;
    $worker = $application->worker;
    $hirer = $job?->hirer;

    $jobStatusClasses = match(strtolower($job?->status ?? 'unknown')) {
        'open' => 'bg-[#123E2D] text-[#4ADE80]',
        'assigned' => 'bg-[#17365F] text-[#60A5FA]',
        'completed' => 'bg-[#4A3515] text-[#FBBF24]',
        default => 'bg-[#17283A] text-[#CBD5E1]',
    };

    $isSelected = $job
        && (int) $job->selected_worker_id === (int) $application->worker_id;

    $priceDifference = $job
        ? (float) $application->offered_price - (float) $job->budget
        : 0;

    $workerVerificationStatus = $worker?->workerProfile?->verification_status ?? 'pending';

    $verificationClasses = match($workerVerificationStatus) {
        'verified' => 'bg-[#123E2D] text-[#4ADE80]',
        'rejected' => 'bg-[#4A2029] text-[#FB7185]',
        default => 'bg-[#4A3515] text-[#FBBF24]',
    };
@endphp


<div class="mx-auto max-w-[1600px]">

    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <div class="flex flex-wrap items-center gap-3">

                <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                    Application Details
                </h1>

                @if($job)
                    <span class="inline-flex rounded-md px-2.5 py-1 text-[9px] font-semibold capitalize {{ $jobStatusClasses }}">
                        {{ $job->status }} job
                    </span>
                @endif

                @if($isSelected)
                    <span class="inline-flex rounded-md bg-[#123E2D] px-2.5 py-1 text-[9px] font-semibold text-[#4ADE80]">
                        Selected Worker
                    </span>
                @endif

            </div>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                Review the Worker, submitted offer and related job information.
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('admin.applications.index') }}"
                class="inline-flex h-9 items-center gap-2 rounded-md border border-[#33475B] px-4 text-[11px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-4 w-4"
                >
                    <path d="m15 18-6-6 6-6"/>
                </svg>

                Back to Applications
            </a>

            @if($job)
                <a
                    href="{{ route('admin.jobs.show', $job) }}"
                    class="inline-flex h-9 items-center gap-2 rounded-md border border-[#1E7B4A] bg-[#123E2D] px-4 text-[11px] font-semibold text-[#4ADE80] transition-colors hover:bg-[#174D38]"
                >
                    View Related Job
                </a>
            @endif

        </div>

    </div>


    {{-- Summary Cards --}}
    <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Offered Price --}}
        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#4A3515] text-[#FBBF24]">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M8 9h8M8 15h8M14 6c-3 0-5 1.3-5 3s2 3 5 3 5 1.3 5 3-2 3-5 3"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Offered Price
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        ৳{{ number_format($application->offered_price, 0) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Job Budget --}}
        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#302557] text-[#A78BFA]">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <rect x="3" y="7" width="18" height="13" rx="2"/>
                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Job Budget
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        ৳{{ number_format($job?->budget ?? 0, 0) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Price Difference --}}
        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg
                    {{ $priceDifference <= 0
                        ? 'bg-[#123E2D] text-[#4ADE80]'
                        : 'bg-[#4A2029] text-[#FB7185]' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <path d="M7 17 17 7"/>
                        <path d="M7 7h10v10"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Difference
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ $priceDifference > 0 ? '+' : '' }}৳{{ number_format($priceDifference, 0) }}
                    </p>

                    <p class="mt-1 text-[8px] text-[#94A3B8]">
                        Compared with budget
                    </p>
                </div>

            </div>

        </article>


        {{-- Applied Date --}}
        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#17365F] text-[#60A5FA]">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 11h18"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Applied Date
                    </p>

                    <p class="mt-1 text-[16px] font-bold text-white">
                        {{ $application->created_at->format('d M Y') }}
                    </p>
                </div>

            </div>

        </article>

    </div>


    {{-- Main Grid --}}
    <div class="mt-4 grid gap-4 xl:grid-cols-[minmax(0,1fr)_340px]">

        {{-- Left Column --}}
        <div class="min-w-0 space-y-4">

            {{-- Application Offer --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="flex flex-col gap-3 border-b border-[#223345] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="text-[16px] font-bold text-white">
                            Submitted Offer
                        </h2>

                        <p class="mt-1 text-[10px] text-[#94A3B8]">
                            Price and message submitted by the Worker.
                        </p>

                    </div>

                    @if($isSelected)
                        <span class="w-fit rounded-md bg-[#123E2D] px-3 py-1.5 text-[9px] font-semibold text-[#4ADE80]">
                            Accepted application
                        </span>
                    @endif

                </div>


                <div class="p-5">

                    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Offered Price
                            </p>

                            <p class="mt-1.5 text-[22px] font-bold text-white">
                                ৳{{ number_format($application->offered_price, 0) }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Job Budget
                            </p>

                            <p class="mt-1.5 text-[15px] font-bold text-[#CBD5E1]">
                                ৳{{ number_format($job?->budget ?? 0, 0) }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Submitted
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $application->created_at->format('d M Y, h:i A') }}
                            </p>

                        </div>

                    </div>


                    <div class="mt-6 border-t border-[#223345] pt-5">

                        <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                            Application Message
                        </p>

                        <div class="mt-3 rounded-md bg-[#17283A] p-4">

                            <p class="whitespace-pre-line text-[11px] leading-6 text-[#CBD5E1]">
                                {{ $application->message ?: 'No message was provided with this application.' }}
                            </p>

                        </div>

                    </div>

                </div>

            </section>


            {{-- Related Job --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="flex items-center justify-between border-b border-[#223345] px-5 py-4">

                    <div>

                        <h2 class="text-[16px] font-bold text-white">
                            Related Job
                        </h2>

                        <p class="mt-1 text-[10px] text-[#94A3B8]">
                            Job information associated with this application.
                        </p>

                    </div>

                    @if($job)
                        <span class="rounded-md px-2.5 py-1 text-[8px] font-semibold capitalize {{ $jobStatusClasses }}">
                            {{ $job->status }}
                        </span>
                    @endif

                </div>


                @if($job)

                    <div class="p-5">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                            <div class="min-w-0">

                                <h3 class="text-[18px] font-bold text-white">
                                    {{ $job->title }}
                                </h3>

                                <p class="mt-2 text-[9px] text-[#94A3B8]">
                                    Job #{{ $job->id }}
                                    ·
                                    Posted {{ $job->created_at->diffForHumans() }}
                                </p>

                            </div>

                            <p class="shrink-0 text-[20px] font-bold text-white">
                                ৳{{ number_format($job->budget, 0) }}
                            </p>

                        </div>


                        <p class="mt-5 text-[11px] leading-6 text-[#CBD5E1]">
                            {{ $job->description }}
                        </p>


                        <div class="mt-6 grid gap-5 border-t border-[#223345] pt-5 sm:grid-cols-2 xl:grid-cols-4">

                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Category
                                </p>

                                <p class="mt-1.5 text-[11px] text-[#CBD5E1]">
                                    {{ $job->category }}
                                </p>

                            </div>


                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Work Area
                                </p>

                                <p class="mt-1.5 text-[11px] text-[#CBD5E1]">
                                    {{ $job->area }}
                                </p>

                            </div>


                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Work Date
                                </p>

                                <p class="mt-1.5 text-[11px] text-[#CBD5E1]">
                                    {{ $job->work_date->format('d M Y') }}
                                </p>

                            </div>


                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Status
                                </p>

                                <span class="mt-1.5 inline-flex rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $jobStatusClasses }}">
                                    {{ $job->status }}
                                </span>

                            </div>

                        </div>


                        <a
                            href="{{ route('admin.jobs.show', $job) }}"
                            class="mt-5 inline-flex h-9 items-center justify-center rounded-md border border-[#33475B] px-4 text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                        >
                            Open Full Job Details
                        </a>

                    </div>

                @else

                    <div class="px-5 py-12 text-center text-[11px] text-[#94A3B8]">
                        The related job is no longer available.
                    </div>

                @endif

            </section>

        </div>


        {{-- Right Column --}}
        <aside class="space-y-4">

            {{-- Worker Profile --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="border-b border-[#223345] px-4 py-4">

                    <h2 class="text-[16px] font-bold text-white">
                        Worker
                    </h2>

                </div>


                <div class="p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[14px] font-bold text-[#60A5FA]">
                            {{ strtoupper(substr($worker?->name ?? 'W', 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-[12px] font-semibold text-white">
                                {{ $worker?->name ?? 'Deleted Worker' }}
                            </p>

                            <p class="mt-1 truncate text-[9px] text-[#94A3B8]">
                                {{ $worker?->email }}
                            </p>

                            <span class="mt-2 inline-flex rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $verificationClasses }}">
                                {{ $workerVerificationStatus }}
                            </span>

                        </div>

                    </div>


                    <div class="mt-4 space-y-4 border-t border-[#223345] pt-4">

                        <div>

                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                WhatsApp
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $worker?->whatsapp_number ?: 'Not provided' }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Address
                            </p>

                            <p class="mt-1 text-[10px] leading-5 text-[#CBD5E1]">
                                {{ $worker?->address ?: 'Not provided' }}
                            </p>

                        </div>


                        @if($worker?->workerProfile)

                            <div>

                                <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                    Category
                                </p>

                                <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                    {{ $worker->workerProfile->category }}
                                </p>

                            </div>


                            <div>

                                <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                    Service Area
                                </p>

                                <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                    {{ $worker->workerProfile->area }}
                                </p>

                            </div>


                            <div>

                                <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                    Expected Rate
                                </p>

                                <p class="mt-1 text-[12px] font-bold text-white">
                                    ৳{{ number_format($worker->workerProfile->expected_rate, 0) }}
                                </p>

                            </div>

                        @endif

                    </div>


                    @if($worker)

                        <a
                            href="{{ route('admin.users.show', $worker) }}"
                            class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md border border-[#33475B] text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                        >
                            View Worker Profile
                        </a>

                    @endif

                </div>

            </section>


            {{-- Hirer Profile --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="border-b border-[#223345] px-4 py-4">

                    <h2 class="text-[16px] font-bold text-white">
                        Hirer
                    </h2>

                </div>


                <div class="p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#123E2D] text-[14px] font-bold text-[#4ADE80]">
                            {{ strtoupper(substr($hirer?->name ?? 'H', 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-[12px] font-semibold text-white">
                                {{ $hirer?->name ?? 'Deleted Hirer' }}
                            </p>

                            <p class="mt-1 truncate text-[9px] text-[#94A3B8]">
                                {{ $hirer?->email }}
                            </p>

                        </div>

                    </div>


                    <div class="mt-4 space-y-4 border-t border-[#223345] pt-4">

                        <div>

                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                WhatsApp
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $hirer?->whatsapp_number ?: 'Not provided' }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Address
                            </p>

                            <p class="mt-1 text-[10px] leading-5 text-[#CBD5E1]">
                                {{ $hirer?->address ?: 'Not provided' }}
                            </p>

                        </div>

                    </div>


                    @if($hirer)

                        <a
                            href="{{ route('admin.users.show', $hirer) }}"
                            class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md border border-[#33475B] text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                        >
                            View Hirer Profile
                        </a>

                    @endif

                </div>

            </section>


            {{-- Application Status --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="border-b border-[#223345] px-4 py-4">

                    <h2 class="text-[16px] font-bold text-white">
                        Application Status
                    </h2>

                </div>


                <div class="p-4">

                    @if($isSelected)

                        <div class="rounded-md border border-[#1E7B4A] bg-[#123E2D] p-4 text-center">

                            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#174D38] text-[#4ADE80]">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="h-5 w-5"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M8 12l3 3 5-6"/>
                                </svg>
                            </div>

                            <h3 class="mt-3 text-[12px] font-semibold text-white">
                                Worker selected
                            </h3>

                            <p class="mt-1 text-[9px] leading-4 text-[#94A3B8]">
                                This application was accepted by the Hirer.
                            </p>

                        </div>

                    @elseif($job?->status === 'open')

                        <div class="rounded-md border border-[#765B20] bg-[#4A3515] p-4 text-center">

                            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#604618] text-[#FBBF24]">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 8v4l3 2"/>
                                </svg>
                            </div>

                            <h3 class="mt-3 text-[12px] font-semibold text-white">
                                Awaiting selection
                            </h3>

                            <p class="mt-1 text-[9px] leading-4 text-[#94A3B8]">
                                The job is still open and the Hirer has not selected a Worker.
                            </p>

                        </div>

                    @else

                        <div class="rounded-md border border-[#33475B] bg-[#17283A] p-4 text-center">

                            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#223345] text-[#94A3B8]">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M8 12h8"/>
                                </svg>
                            </div>

                            <h3 class="mt-3 text-[12px] font-semibold text-white">
                                Not selected
                            </h3>

                            <p class="mt-1 text-[9px] leading-4 text-[#94A3B8]">
                                Another Worker may have been selected for this job.
                            </p>

                        </div>

                    @endif

                </div>

            </section>

        </aside>

    </div>

</div>

@endsection