@extends('layouts.admin')

@section('title', 'Job Details - KormoShala')

@section('content')

@php
    $statusClasses = match(strtolower($job->status)) {
        'open' => 'bg-[#123E2D] text-[#4ADE80]',
        'assigned' => 'bg-[#17365F] text-[#60A5FA]',
        'completed' => 'bg-[#4A3515] text-[#FBBF24]',
        default => 'bg-[#17283A] text-[#CBD5E1]',
    };

    $applicationsCount = $job->applications->count();

    $selectedApplication = $job->selected_worker_id
        ? $job->applications->firstWhere('worker_id', $job->selected_worker_id)
        : null;
@endphp


<div class="mx-auto max-w-[1600px]">

    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <div class="flex flex-wrap items-center gap-3">

                <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                    Job Details
                </h1>

                <span class="inline-flex rounded-md px-2.5 py-1 text-[9px] font-semibold capitalize {{ $statusClasses }}">
                    {{ $job->status }}
                </span>

            </div>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                Review job information, applicants and completion details.
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('admin.jobs.index') }}"
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

                Back to Jobs
            </a>


            <form
                method="POST"
                action="{{ route('admin.jobs.destroy', $job) }}"
                onsubmit="return confirm('Remove this job permanently? Related applications and review data may also be removed.');"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="inline-flex h-9 items-center gap-2 rounded-md border border-[#7F2D3B] bg-[#4A2029] px-4 text-[11px] font-semibold text-[#FB7185] transition-colors hover:bg-[#642938]"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-4 w-4"
                    >
                        <path d="M3 6h18"/>
                        <path d="M8 6V4h8v2"/>
                        <path d="m19 6-1 14H6L5 6"/>
                        <path d="M10 11v5M14 11v5"/>
                    </svg>

                    Remove Job
                </button>

            </form>

        </div>

    </div>


    {{-- Summary Cards --}}
    <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#302557] text-[#A78BFA]">
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
                        Budget
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        ৳{{ number_format($job->budget, 0) }}
                    </p>
                </div>

            </div>

        </article>


        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#17365F] text-[#60A5FA]">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21a7 7 0 0 1 14 0"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Applications
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($applicationsCount) }}
                    </p>
                </div>

            </div>

        </article>


        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#123E2D] text-[#4ADE80]">
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

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Work Date
                    </p>

                    <p class="mt-1 text-[16px] font-bold text-white">
                        {{ $job->work_date->format('d M Y') }}
                    </p>
                </div>

            </div>

        </article>


        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#4A3515] text-[#FBBF24]">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <path d="M12 3 5 6v5c0 5 3 8 7 10 4-2 7-5 7-10V6z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Current Status
                    </p>

                    <p class="mt-1 text-[16px] font-bold capitalize text-white">
                        {{ $job->status }}
                    </p>
                </div>

            </div>

        </article>

    </div>


    {{-- Main Grid --}}
    <div class="mt-4 grid gap-4 xl:grid-cols-[minmax(0,1fr)_330px]">

        {{-- Left Column --}}
        <div class="min-w-0 space-y-4">

            {{-- Job Information --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="border-b border-[#223345] px-5 py-4">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-3">

                                <h2 class="text-[20px] font-bold text-white">
                                    {{ $job->title }}
                                </h2>

                                <span class="rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $statusClasses }}">
                                    {{ $job->status }}
                                </span>

                            </div>

                            <p class="mt-2 text-[10px] text-[#94A3B8]">
                                Job #{{ $job->id }}
                                ·
                                Posted {{ $job->created_at->diffForHumans() }}
                            </p>

                        </div>


                        <p class="shrink-0 text-[24px] font-bold text-white">
                            ৳{{ number_format($job->budget, 0) }}
                        </p>

                    </div>

                </div>


                <div class="p-5">

                    <h3 class="text-[12px] font-semibold text-white">
                        Job Description
                    </h3>

                    <p class="mt-3 whitespace-pre-line text-[11px] leading-6 text-[#CBD5E1]">
                        {{ $job->description }}
                    </p>


                    <div class="mt-6 grid gap-5 border-t border-[#223345] pt-5 sm:grid-cols-2 xl:grid-cols-3">

                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Category
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $job->category }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Work Area
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $job->area }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Work Date
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $job->work_date->format('d M Y') }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Created
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $job->created_at->format('d M Y, h:i A') }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Last Updated
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $job->updated_at->format('d M Y, h:i A') }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Applicants
                            </p>

                            <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                {{ $applicationsCount }}
                            </p>

                        </div>

                    </div>

                </div>

            </section>


            {{-- Applications --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="flex items-center justify-between border-b border-[#223345] px-5 py-4">

                    <div>

                        <h2 class="text-[16px] font-bold text-white">
                            Applications
                        </h2>

                        <p class="mt-1 text-[10px] text-[#94A3B8]">
                            Workers who submitted offers for this job.
                        </p>

                    </div>

                    <span class="rounded-md bg-[#17365F] px-2.5 py-1 text-[8px] font-semibold text-[#60A5FA]">
                        {{ $applicationsCount }}
                    </span>

                </div>


                <div class="divide-y divide-[#223345]">

                    @forelse($job->applications as $application)

                        @php
                            $isSelected = (int) $job->selected_worker_id === (int) $application->worker_id;
                        @endphp

                        <article class="p-4">

                            <div class="flex flex-col gap-4 lg:flex-row lg:items-center">

                                <div class="flex min-w-0 flex-1 items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[12px] font-bold text-[#60A5FA]">
                                        {{ strtoupper(substr($application->worker?->name ?? 'W', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <p class="truncate text-[11px] font-semibold text-white">
                                                {{ $application->worker?->name ?? 'Deleted Worker' }}
                                            </p>

                                            @if($isSelected)

                                                <span class="rounded-md bg-[#123E2D] px-2 py-1 text-[8px] font-semibold text-[#4ADE80]">
                                                    Selected Worker
                                                </span>

                                            @endif

                                        </div>

                                        <p class="mt-1 truncate text-[8px] text-[#94A3B8]">
                                            {{ $application->worker?->email }}
                                        </p>

                                    </div>

                                </div>


                                <div class="lg:w-[130px]">

                                    <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                        Offered Price
                                    </p>

                                    <p class="mt-1 text-[13px] font-bold text-white">
                                        ৳{{ number_format($application->offered_price, 0) }}
                                    </p>

                                </div>


                                <div class="lg:w-[120px]">

                                    <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                        Applied
                                    </p>

                                    <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                        {{ $application->created_at->format('d M Y') }}
                                    </p>

                                </div>


                                <a
                                    href="{{ route('admin.applications.show', $application) }}"
                                    class="inline-flex h-8 shrink-0 items-center justify-center rounded-md border border-[#33475B] px-3 text-[9px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white"
                                >
                                    View Application
                                </a>

                            </div>


                            @if($application->message)

                                <div class="mt-3 rounded-md bg-[#17283A] px-3 py-2.5">

                                    <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                        Worker Message
                                    </p>

                                    <p class="mt-1 text-[10px] leading-5 text-[#CBD5E1]">
                                        {{ $application->message }}
                                    </p>

                                </div>

                            @endif

                        </article>

                    @empty

                        <div class="px-5 py-12 text-center">

                            <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-[#17283A] text-[#94A3B8]">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5"
                                >
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M2 21a7 7 0 0 1 14 0"/>
                                </svg>
                            </div>

                            <h3 class="mt-3 text-[13px] font-bold text-white">
                                No applications received
                            </h3>

                            <p class="mt-1 text-[10px] text-[#94A3B8]">
                                No Worker has applied for this job.
                            </p>

                        </div>

                    @endforelse

                </div>

            </section>


            {{-- Review --}}
            @if($job->review)

                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="border-b border-[#223345] px-5 py-4">

                        <h2 class="text-[16px] font-bold text-white">
                            Job Review
                        </h2>

                        <p class="mt-1 text-[10px] text-[#94A3B8]">
                            Feedback submitted after job completion.
                        </p>

                    </div>


                    <div class="p-5">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Rating
                                </p>

                                <div class="mt-2 flex items-center gap-1 text-[14px] text-[#F59E0B]">

                                    @for($star = 1; $star <= 5; $star++)

                                        <span class="{{ $star <= $job->review->rating ? '' : 'text-[#475569]' }}">
                                            ★
                                        </span>

                                    @endfor

                                    <span class="ml-2 text-[11px] font-semibold text-white">
                                        {{ $job->review->rating }}/5
                                    </span>

                                </div>

                            </div>


                            <a
                                href="{{ route('admin.reviews.show', $job->review) }}"
                                class="inline-flex h-8 items-center justify-center rounded-md border border-[#33475B] px-3 text-[9px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                            >
                                View Review Details
                            </a>

                        </div>


                        <div class="mt-4 rounded-md bg-[#17283A] p-4">

                            <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                Written Review
                            </p>

                            <p class="mt-2 text-[10px] leading-5 text-[#CBD5E1]">
                                {{ $job->review->review ?: 'No written review was submitted.' }}
                            </p>

                        </div>

                    </div>

                </section>

            @endif

        </div>


        {{-- Right Column --}}
        <aside class="space-y-4">

            {{-- Hirer --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="border-b border-[#223345] px-4 py-4">

                    <h2 class="text-[16px] font-bold text-white">
                        Hirer
                    </h2>

                </div>


                <div class="p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#123E2D] text-[14px] font-bold text-[#4ADE80]">
                            {{ strtoupper(substr($job->hirer?->name ?? 'H', 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-[12px] font-semibold text-white">
                                {{ $job->hirer?->name ?? 'Deleted Hirer' }}
                            </p>

                            <p class="mt-1 truncate text-[9px] text-[#94A3B8]">
                                {{ $job->hirer?->email }}
                            </p>

                        </div>

                    </div>


                    <div class="mt-4 space-y-4 border-t border-[#223345] pt-4">

                        <div>

                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                WhatsApp
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $job->hirer?->whatsapp_number ?: 'Not provided' }}
                            </p>

                        </div>


                        <div>

                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Address
                            </p>

                            <p class="mt-1 text-[10px] leading-5 text-[#CBD5E1]">
                                {{ $job->hirer?->address ?: 'Not provided' }}
                            </p>

                        </div>

                    </div>


                    @if($job->hirer)

                        <a
                            href="{{ route('admin.users.show', $job->hirer) }}"
                            class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md border border-[#33475B] text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                        >
                            View Hirer Profile
                        </a>

                    @endif

                </div>

            </section>


            {{-- Selected Worker --}}
            <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                <div class="border-b border-[#223345] px-4 py-4">

                    <h2 class="text-[16px] font-bold text-white">
                        Selected Worker
                    </h2>

                </div>


                @if($job->selectedWorker)

                    <div class="p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[14px] font-bold text-[#60A5FA]">
                                {{ strtoupper(substr($job->selectedWorker->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0">

                                <p class="truncate text-[12px] font-semibold text-white">
                                    {{ $job->selectedWorker->name }}
                                </p>

                                <p class="mt-1 truncate text-[9px] text-[#94A3B8]">
                                    {{ $job->selectedWorker->email }}
                                </p>

                            </div>

                        </div>


                        @if($selectedApplication)

                            <div class="mt-4 rounded-md bg-[#17283A] p-3">

                                <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                    Accepted Offer
                                </p>

                                <p class="mt-1 text-[14px] font-bold text-white">
                                    ৳{{ number_format($selectedApplication->offered_price, 0) }}
                                </p>

                            </div>

                        @endif


                        <a
                            href="{{ route('admin.users.show', $job->selectedWorker) }}"
                            class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md border border-[#33475B] text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                        >
                            View Worker Profile
                        </a>

                    </div>

                @else

                    <div class="px-5 py-10 text-center">

                        <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-[#17283A] text-[#94A3B8]">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-5 w-5"
                            >
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M2 21a7 7 0 0 1 14 0"/>
                            </svg>
                        </div>

                        <h3 class="mt-3 text-[12px] font-semibold text-white">
                            No Worker selected
                        </h3>

                        <p class="mt-1 text-[9px] text-[#94A3B8]">
                            This job has not been assigned.
                        </p>

                    </div>

                @endif

            </section>

        </aside>

    </div>

</div>

@endsection