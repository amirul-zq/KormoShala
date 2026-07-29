@extends('layouts.admin')

@section('title', 'User Details - KormoShala')

@section('content')

@php
    $isActive = $user->status === 'active';

    $roleClasses = match($user->role) {
        'admin' => 'bg-[#302557] text-[#A78BFA]',
        'worker' => 'bg-[#17365F] text-[#60A5FA]',
        default => 'bg-[#4A3515] text-[#FBBF24]',
    };

    $postedJobsCount = $user->relationLoaded('postedJobs')
        ? $user->postedJobs->count()
        : 0;

    $applicationsCount = $user->relationLoaded('applications')
        ? $user->applications->count()
        : 0;

    $receivedReviewsCount = $user->relationLoaded('receivedReviews')
        ? $user->receivedReviews->count()
        : 0;

    $completedJobsCount = $user->relationLoaded('postedJobs')
        ? $user->postedJobs->where('status', 'completed')->count()
        : 0;

    $averageRating = $user->relationLoaded('receivedReviews')
        ? round((float) $user->receivedReviews->avg('rating'), 1)
        : 0;
@endphp


<div class="mx-auto max-w-[1600px]">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <div class="flex flex-wrap items-center gap-3">

                <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                    User Details
                </h1>

                <span class="inline-flex rounded-md px-2.5 py-1 text-[9px] font-semibold capitalize {{ $roleClasses }}">
                    {{ $user->role }}
                </span>

                <span
                    class="inline-flex items-center gap-1.5 rounded-md px-2.5 py-1 text-[9px] font-semibold
                    {{ $isActive
                        ? 'bg-[#123E2D] text-[#4ADE80]'
                        : 'bg-[#4A2029] text-[#FB7185]' }}"
                >
                    <span
                        class="h-1.5 w-1.5 rounded-full
                        {{ $isActive ? 'bg-[#22C55E]' : 'bg-[#EF4444]' }}"
                    ></span>

                    {{ ucfirst($user->status) }}
                </span>

            </div>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                View account information and marketplace activity.
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('admin.users.index') }}"
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

                Back to Users
            </a>


            @if($user->role !== 'admin')

                <form
                    method="POST"
                    action="{{ route('admin.users.status', $user) }}"
                    onsubmit="return confirm(
                        '{{ $isActive
                            ? 'Block this user account?'
                            : 'Unblock this user account?' }}'
                    );"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="inline-flex h-9 items-center gap-2 rounded-md px-4 text-[11px] font-semibold transition-colors
                        {{ $isActive
                            ? 'border border-[#7F2D3B] bg-[#4A2029] text-[#FB7185] hover:bg-[#642938]'
                            : 'border border-[#1E7B4A] bg-[#123E2D] text-[#4ADE80] hover:bg-[#174D38]' }}"
                    >
                        {{ $isActive ? 'Block User' : 'Unblock User' }}
                    </button>

                </form>

            @endif

        </div>

    </div>


    {{-- Feedback --}}
    @if(session('success'))

        <div class="mt-4 flex items-center gap-3 rounded-md border border-[#1E7B4A] bg-[#123E2D] px-4 py-3 text-[11px] text-[#4ADE80]">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                class="h-4 w-4 shrink-0"
            >
                <circle cx="12" cy="12" r="9"/>
                <path d="m8 12 3 3 5-6"/>
            </svg>

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="mt-4 flex items-center gap-3 rounded-md border border-[#7F2D3B] bg-[#4A2029] px-4 py-3 text-[11px] text-[#FB7185]">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                class="h-4 w-4 shrink-0"
            >
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 8v5M12 16h.01"/>
            </svg>

            {{ session('error') }}

        </div>

    @endif


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
                        Posted Jobs
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($postedJobsCount) }}
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
                        <rect x="4" y="4" width="16" height="16" rx="2"/>
                        <path d="M8 9h8M8 13h6M8 17h4"/>
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
                        <path d="M8 12l3 3 5-6"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Completed Jobs
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($completedJobsCount) }}
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
                        <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2 7.5 14 3 9.6l6.2-.9z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Average Rating
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($averageRating, 1) }}
                        <span class="text-[12px] text-[#F59E0B]">★</span>
                    </p>
                </div>

            </div>

        </article>

    </div>


    {{-- Main Information Grid --}}
    <div class="mt-4 grid gap-4 xl:grid-cols-[360px_minmax(0,1fr)]">

        {{-- Profile Card --}}
        <aside class="rounded-lg border border-[#26384A] bg-[#142130]">

            <div class="border-b border-[#223345] p-5">

                <div class="flex items-center gap-4">

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-[#123E2D] text-[22px] font-bold text-[#4ADE80]">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">

                        <h2 class="truncate text-[18px] font-bold text-white">
                            {{ $user->name }}
                        </h2>

                        <p class="mt-1 truncate text-[10px] text-[#94A3B8]">
                            {{ $user->email }}
                        </p>

                        <div class="mt-2 flex flex-wrap gap-2">

                            <span class="rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $roleClasses }}">
                                {{ $user->role }}
                            </span>

                            <span
                                class="rounded-md px-2 py-1 text-[8px] font-semibold
                                {{ $isActive
                                    ? 'bg-[#123E2D] text-[#4ADE80]'
                                    : 'bg-[#4A2029] text-[#FB7185]' }}"
                            >
                                {{ ucfirst($user->status) }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <div class="space-y-5 p-5">

                <div>

                    <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                        WhatsApp Number
                    </p>

                    <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                        {{ $user->whatsapp_number ?: 'Not provided' }}
                    </p>

                </div>


                <div>

                    <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                        Address
                    </p>

                    <p class="mt-1.5 text-[11px] leading-5 text-[#CBD5E1]">
                        {{ $user->address ?: 'Not provided' }}
                    </p>

                </div>


                <div>

                    <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                        Registered At
                    </p>

                    <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                        {{ $user->created_at->format('d M Y, h:i A') }}
                    </p>

                    <p class="mt-1 text-[8px] text-[#94A3B8]">
                        {{ $user->created_at->diffForHumans() }}
                    </p>

                </div>


                <div>

                    <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                        Last Updated
                    </p>

                    <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                        {{ $user->updated_at->format('d M Y, h:i A') }}
                    </p>

                </div>

            </div>

        </aside>


        {{-- Right Content --}}
        <div class="min-w-0 space-y-4">

            {{-- Worker Profile --}}
            @if($user->role === 'worker')

                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="border-b border-[#223345] px-4 py-4">

                        <h2 class="text-[16px] font-bold text-white">
                            Worker Profile
                        </h2>

                        <p class="mt-1 text-[10px] text-[#94A3B8]">
                            Service information provided by this Worker.
                        </p>

                    </div>


                    @if($user->workerProfile)

                        @php
                            $verificationClasses = match($user->workerProfile->verification_status) {
                                'verified' => 'bg-[#123E2D] text-[#4ADE80]',
                                'rejected' => 'bg-[#4A2029] text-[#FB7185]',
                                default => 'bg-[#4A3515] text-[#FBBF24]',
                            };
                        @endphp

                        <div class="grid gap-5 p-4 sm:grid-cols-2 xl:grid-cols-4">

                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Category
                                </p>

                                <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                    {{ $user->workerProfile->category }}
                                </p>

                            </div>


                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Service Area
                                </p>

                                <p class="mt-1.5 text-[11px] font-medium text-[#CBD5E1]">
                                    {{ $user->workerProfile->area }}
                                </p>

                            </div>


                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Expected Rate
                                </p>

                                <p class="mt-1.5 text-[12px] font-bold text-white">
                                    ৳{{ number_format($user->workerProfile->expected_rate, 0) }}
                                </p>

                            </div>


                            <div>

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    Verification
                                </p>

                                <span class="mt-1.5 inline-flex rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $verificationClasses }}">
                                    {{ $user->workerProfile->verification_status }}
                                </span>

                            </div>

                        </div>


                        @if($user->workerProfile->description)

                            <div class="border-t border-[#223345] px-4 py-4">

                                <p class="text-[8px] font-semibold uppercase tracking-wide text-[#64748B]">
                                    About Their Work
                                </p>

                                <p class="mt-2 text-[10px] leading-5 text-[#CBD5E1]">
                                    {{ $user->workerProfile->description }}
                                </p>

                            </div>

                        @endif

                    @else

                        <div class="px-5 py-10 text-center text-[11px] text-[#94A3B8]">
                            This Worker has not completed a Worker profile.
                        </div>

                    @endif

                </section>

            @endif


            {{-- Hirer Posted Jobs --}}
            @if($user->role === 'hirer')

                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="flex items-center justify-between border-b border-[#223345] px-4 py-4">

                        <div>

                            <h2 class="text-[16px] font-bold text-white">
                                Posted Jobs
                            </h2>

                            <p class="mt-1 text-[10px] text-[#94A3B8]">
                                Jobs created by this Hirer.
                            </p>

                        </div>

                        <span class="rounded-md bg-[#123E2D] px-2.5 py-1 text-[8px] font-semibold text-[#4ADE80]">
                            {{ $postedJobsCount }}
                        </span>

                    </div>


                    <div class="divide-y divide-[#223345]">

                        @forelse($user->postedJobs->take(6) as $job)

                            @php
                                $jobStatusClasses = match($job->status) {
                                    'open' => 'bg-[#123E2D] text-[#4ADE80]',
                                    'assigned' => 'bg-[#17365F] text-[#60A5FA]',
                                    'completed' => 'bg-[#4A3515] text-[#FBBF24]',
                                    default => 'bg-[#17283A] text-[#CBD5E1]',
                                };
                            @endphp

                            <div class="flex flex-col gap-3 px-4 py-3 sm:flex-row sm:items-center">

                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-[11px] font-semibold text-white">
                                        {{ $job->title }}
                                    </p>

                                    <p class="mt-1 truncate text-[8px] text-[#94A3B8]">
                                        {{ $job->category }} · {{ $job->area }}
                                    </p>

                                </div>


                                <span class="w-fit rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $jobStatusClasses }}">
                                    {{ $job->status }}
                                </span>


                                <p class="whitespace-nowrap text-[11px] font-bold text-white">
                                    ৳{{ number_format($job->budget, 0) }}
                                </p>


                                <a
                                    href="{{ route('admin.jobs.show', $job) }}"
                                    class="inline-flex h-8 items-center justify-center rounded-md border border-[#33475B] px-3 text-[9px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                                >
                                    View
                                </a>

                            </div>

                        @empty

                            <div class="px-5 py-10 text-center text-[11px] text-[#94A3B8]">
                                This Hirer has not posted any jobs.
                            </div>

                        @endforelse

                    </div>

                </section>

            @endif


            {{-- Worker Applications --}}
            @if($user->role === 'worker')

                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="flex items-center justify-between border-b border-[#223345] px-4 py-4">

                        <div>

                            <h2 class="text-[16px] font-bold text-white">
                                Applications
                            </h2>

                            <p class="mt-1 text-[10px] text-[#94A3B8]">
                                Applications submitted by this Worker.
                            </p>

                        </div>

                        <span class="rounded-md bg-[#17365F] px-2.5 py-1 text-[8px] font-semibold text-[#60A5FA]">
                            {{ $applicationsCount }}
                        </span>

                    </div>


                    <div class="divide-y divide-[#223345]">

                        @forelse($user->applications->take(6) as $application)

                            <div class="flex flex-col gap-3 px-4 py-3 sm:flex-row sm:items-center">

                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-[11px] font-semibold text-white">
                                        {{ $application->job?->title ?? 'Deleted Job' }}
                                    </p>

                                    <p class="mt-1 truncate text-[8px] text-[#94A3B8]">
                                        {{ \Illuminate\Support\Str::limit($application->message, 60) }}
                                    </p>

                                </div>


                                <p class="whitespace-nowrap text-[11px] font-bold text-white">
                                    ৳{{ number_format($application->offered_price, 0) }}
                                </p>


                                <p class="whitespace-nowrap text-[8px] text-[#94A3B8]">
                                    {{ $application->created_at->format('d M Y') }}
                                </p>


                                <a
                                    href="{{ route('admin.applications.show', $application) }}"
                                    class="inline-flex h-8 items-center justify-center rounded-md border border-[#33475B] px-3 text-[9px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                                >
                                    View
                                </a>

                            </div>

                        @empty

                            <div class="px-5 py-10 text-center text-[11px] text-[#94A3B8]">
                                This Worker has not submitted any applications.
                            </div>

                        @endforelse

                    </div>

                </section>

            @endif


            {{-- Reviews --}}
            @if($user->role === 'worker')

                <section class="overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

                    <div class="flex items-center justify-between border-b border-[#223345] px-4 py-4">

                        <div>

                            <h2 class="text-[16px] font-bold text-white">
                                Received Reviews
                            </h2>

                            <p class="mt-1 text-[10px] text-[#94A3B8]">
                                Reviews received by this Worker.
                            </p>

                        </div>

                        <span class="rounded-md bg-[#4A3515] px-2.5 py-1 text-[8px] font-semibold text-[#FBBF24]">
                            {{ $receivedReviewsCount }}
                        </span>

                    </div>


                    <div class="divide-y divide-[#223345]">

                        @forelse($user->receivedReviews->take(6) as $review)

                            <div class="flex flex-col gap-3 px-4 py-3 sm:flex-row sm:items-center">

                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-[11px] font-semibold text-white">
                                        {{ $review->job?->title ?? 'Deleted Job' }}
                                    </p>

                                    <p class="mt-1 truncate text-[8px] text-[#94A3B8]">
                                        {{ $review->review ?: 'No written review' }}
                                    </p>

                                </div>


                                <div class="flex items-center gap-0.5 text-[10px] text-[#F59E0B]">

                                    @for($star = 1; $star <= 5; $star++)

                                        <span class="{{ $star <= $review->rating ? '' : 'text-[#475569]' }}">
                                            ★
                                        </span>

                                    @endfor

                                    <span class="ml-1 font-semibold text-white">
                                        {{ $review->rating }}/5
                                    </span>

                                </div>


                                <a
                                    href="{{ route('admin.reviews.show', $review) }}"
                                    class="inline-flex h-8 items-center justify-center rounded-md border border-[#33475B] px-3 text-[9px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                                >
                                    View
                                </a>

                            </div>

                        @empty

                            <div class="px-5 py-10 text-center text-[11px] text-[#94A3B8]">
                                This Worker has not received any reviews.
                            </div>

                        @endforelse

                    </div>

                </section>

            @endif

        </div>

    </div>

</div>

@endsection