@extends('layouts.admin')

@section('title', 'Review Details - KormoShala')

@section('content')

@php
    $job = $review->job;
    $hirer = $review->hirer;
    $worker = $review->worker;

    $jobStatusClasses = match(strtolower($job?->status ?? 'unknown')) {
        'open' => 'bg-[#123E2D] text-[#4ADE80]',
        'assigned' => 'bg-[#17365F] text-[#60A5FA]',
        'completed' => 'bg-[#4A3515] text-[#FBBF24]',
        default => 'bg-[#17283A] text-[#CBD5E1]',
    };

    $workerVerificationStatus =
        $worker?->workerProfile?->verification_status ?? 'pending';

    $verificationClasses = match($workerVerificationStatus) {
        'verified' => 'bg-[#123E2D] text-[#4ADE80]',
        'rejected' => 'bg-[#4A2029] text-[#FB7185]',
        default => 'bg-[#4A3515] text-[#FBBF24]',
    };

    $ratingLabel = match((int) $review->rating) {
        5 => 'Excellent',
        4 => 'Very Good',
        3 => 'Good',
        2 => 'Fair',
        default => 'Poor',
    };
@endphp


<div class="mx-auto max-w-[1600px]">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <div class="flex flex-wrap items-center gap-3">

                <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                    Review Details
                </h1>

                <span class="inline-flex items-center gap-1.5 rounded-md bg-[#4A3515] px-2.5 py-1 text-[9px] font-semibold text-[#FBBF24]">
                    <span>★</span>
                    {{ $review->rating }}/5
                </span>

                @if($job)
                    <span class="inline-flex rounded-md px-2.5 py-1 text-[9px] font-semibold capitalize {{ $jobStatusClasses }}">
                        {{ $job->status }} job
                    </span>
                @endif

            </div>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                Review submitted by the Hirer after completion of the job.
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('admin.reviews.index') }}"
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

                Back to Reviews
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

        {{-- Rating --}}
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
                        <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2 7.5 14 3 9.6l6.2-.9z"/>
                    </svg>

                </div>

                <div>

                    <p class="text-[10px] text-[#94A3B8]">
                        Rating
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ $review->rating }}/5
                        <span class="text-[12px] text-[#F59E0B]">★</span>
                    </p>

                </div>

            </div>

        </article>


        {{-- Rating Meaning --}}
        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#123E2D] text-[#4ADE80]">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M8 12l3 3 5-6"/>
                    </svg>

                </div>

                <div>

                    <p class="text-[10px] text-[#94A3B8]">
                        Rating Level
                    </p>

                    <p class="mt-1 text-[17px] font-bold text-white">
                        {{ $ratingLabel }}
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


        {{-- Submitted Date --}}
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
                        Submitted Date
                    </p>

                    <p class="mt-1 text-[16px] font-bold text-white">
                        {{ $review->created_at->format('d M Y') }}
                    </p>

                </div>

            </div>

        </article>

    </div>


    {{-- Main Grid --}}
    <div class="mt-4 grid gap-4 xl:grid-cols-[minmax(0,1fr)_340px]">

        {{-- Left Column --}}
        <div class="min-w-0 space-y-4">

            {{-- Review Content --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="flex flex-col gap-3 border-b border-[#223345] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="text-[16px] font-bold text-white">
                            Submitted Review
                        </h2>

                        <p class="mt-1 text-[10px] text-[#94A3B8]">
                            Rating and written feedback provided by the Hirer.
                        </p>

                    </div>

                    <span class="w-fit rounded-md bg-[#4A3515] px-3 py-1.5 text-[9px] font-semibold text-[#FBBF24]">
                        Review #{{ $review->id }}
                    </span>

                </div>


                <div class="p-5">

                    <div>

                        <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                            Rating
                        </p>

                        <div class="mt-2 flex flex-wrap items-center gap-2">

                            <div class="flex items-center gap-1 text-[18px] text-[#F59E0B]">

                                @for($star = 1; $star <= 5; $star++)

                                    <span class="{{ $star <= $review->rating ? '' : 'text-[#475569]' }}">
                                        ★
                                    </span>

                                @endfor

                            </div>

                            <span class="text-[13px] font-bold text-white">
                                {{ $review->rating }}/5
                            </span>

                            <span class="rounded-md bg-[#17283A] px-2 py-1 text-[8px] font-semibold text-[#CBD5E1]">
                                {{ $ratingLabel }}
                            </span>

                        </div>

                    </div>


                    <div class="mt-6 border-t border-[#223345] pt-5">

                        <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                            Written Review
                        </p>

                        <div class="mt-3 rounded-md bg-[#17283A] p-4">

                            <p class="whitespace-pre-line text-[11px] leading-6 text-[#CBD5E1]">
                                {{ $review->review ?: 'No written review was provided.' }}
                            </p>

                        </div>

                    </div>


                    <div class="mt-6 grid gap-5 border-t border-[#223345] pt-5 sm:grid-cols-2">

                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Submitted
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $review->created_at->format('d M Y, h:i A') }}
                            </p>

                            <p class="mt-1 text-[8px] text-[#94A3B8]">
                                {{ $review->created_at->diffForHumans() }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Last Updated
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $review->updated_at->format('d M Y, h:i A') }}
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
                            Job associated with this review.
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

            {{-- Hirer --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="border-b border-[#223345] px-4 py-4">

                    <h2 class="text-[16px] font-bold text-white">
                        Review Submitted By
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

                            <span class="mt-2 inline-flex rounded-md bg-[#4A3515] px-2 py-1 text-[8px] font-semibold text-[#FBBF24]">
                                Hirer
                            </span>

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


            {{-- Worker --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="border-b border-[#223345] px-4 py-4">

                    <h2 class="text-[16px] font-bold text-white">
                        Reviewed Worker
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

        </aside>

    </div>

</div>

@endsection