@extends('layouts.admin')

@section('title', 'Manage Jobs - KormoShala')

@section('content')

<div class="mx-auto max-w-[1600px]">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                Jobs
            </h1>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                Monitor and manage all marketplace jobs.
            </p>
        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            class="inline-flex h-9 w-fit items-center gap-2 rounded-md border border-[#33475B] px-4 text-[11px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                class="h-4 w-4"
            >
                <path d="M3 11 12 4l9 7"/>
                <path d="M5 10v10h14V10"/>
            </svg>

            Dashboard
        </a>

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


    {{-- Statistics --}}
    <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total Jobs --}}
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
                        Total Jobs
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($totalJobs) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Open Jobs --}}
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
                        <path d="M12 8v4l3 2"/>
                    </svg>

                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Open Jobs
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($openJobs) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Assigned Jobs --}}
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
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21a7 7 0 0 1 14 0"/>
                    </svg>

                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Assigned Jobs
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($assignedJobs) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Completed Jobs --}}
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
                        <path d="M8 12l3 3 5-6"/>
                    </svg>

                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Completed Jobs
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($completedJobs) }}
                    </p>
                </div>

            </div>

        </article>

    </div>


    {{-- Jobs Panel --}}
    <section class="mt-4 overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

        {{-- Panel Header --}}
        <div class="flex flex-col gap-3 border-b border-[#223345] px-4 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-[16px] font-bold text-white">
                    Marketplace Jobs
                </h2>

                <p class="mt-1 text-[10px] text-[#94A3B8]">
                    Search, filter, inspect or remove inappropriate jobs.
                </p>
            </div>

            <span class="w-fit rounded-md bg-[#123E2D] px-3 py-1.5 text-[9px] font-semibold text-[#4ADE80]">
                {{ $jobs->total() }} results
            </span>

        </div>


        {{-- Filters --}}
        <form
            method="GET"
            action="{{ route('admin.jobs.index') }}"
            class="border-b border-[#223345] p-4"
        >

            <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-[minmax(280px,1.6fr)_0.8fr_1fr_auto]">

                {{-- Search --}}
                <div class="relative">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#94A3B8]"
                    >
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>

                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search title, Hirer, category or area..."
                        class="h-10 w-full rounded-md border border-[#2C4054] bg-[#17283A] pl-9 pr-3 text-[11px] text-white placeholder:text-[#94A3B8] focus:border-[#1E7B4A] focus:outline-none focus:ring-2 focus:ring-[#22C55E]/10"
                    >

                </div>


                {{-- Status --}}
                <select
                    name="status"
                    class="h-10 rounded-md border border-[#2C4054] bg-[#17283A] px-3 text-[11px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none"
                >
                    <option value="">All Statuses</option>

                    <option value="open" @selected(request('status') === 'open')>
                        Open
                    </option>

                    <option value="assigned" @selected(request('status') === 'assigned')>
                        Assigned
                    </option>

                    <option value="completed" @selected(request('status') === 'completed')>
                        Completed
                    </option>
                </select>


                {{-- Category --}}
                <select
                    name="category"
                    class="h-10 rounded-md border border-[#2C4054] bg-[#17283A] px-3 text-[11px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none"
                >
                    <option value="">All Categories</option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category }}"
                            @selected(request('category') === $category)
                        >
                            {{ $category }}
                        </option>
                    @endforeach
                </select>


                {{-- Filter Actions --}}
                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="inline-flex h-10 flex-1 items-center justify-center rounded-md bg-[#159447] px-4 text-[11px] font-semibold text-white transition-colors hover:bg-[#15803D]"
                    >
                        Filter
                    </button>

                    @if(request()->hasAny(['search', 'status', 'category']))
                        <a
                            href="{{ route('admin.jobs.index') }}"
                            class="inline-flex h-10 items-center justify-center rounded-md border border-[#33475B] px-3 text-[11px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                        >
                            Reset
                        </a>
                    @endif

                </div>

            </div>

        </form>


        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto lg:block">

            <table class="w-full text-left">

                <thead class="border-b border-[#223345] bg-[#152435]">

                    <tr>
                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Job
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Hirer
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Category / Area
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Budget
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Applicants
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Status
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Created
                        </th>

                        <th class="px-4 py-3 text-right text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Actions
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-[#223345]">

                    @forelse($jobs as $job)

                        @php
                            $statusClasses = match(strtolower($job->status)) {
                                'open' => 'bg-[#123E2D] text-[#4ADE80]',
                                'assigned' => 'bg-[#17365F] text-[#60A5FA]',
                                'completed' => 'bg-[#4A3515] text-[#FBBF24]',
                                default => 'bg-[#17283A] text-[#CBD5E1]',
                            };
                        @endphp

                        <tr class="transition-colors hover:bg-[#17283A]">

                            {{-- Job --}}
                            <td class="px-4 py-3">

                                <div class="flex min-w-[190px] items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-[#17365F] text-[#60A5FA]">

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

                                    <div class="min-w-0">

                                        <p class="max-w-[220px] truncate text-[11px] font-semibold text-white">
                                            {{ $job->title }}
                                        </p>

                                        <p class="mt-0.5 text-[8px] text-[#94A3B8]">
                                            Job #{{ $job->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Hirer --}}
                            <td class="px-4 py-3">

                                <p class="text-[10px] font-medium text-[#CBD5E1]">
                                    {{ $job->hirer?->name ?? 'Deleted Hirer' }}
                                </p>

                                <p class="mt-1 max-w-[150px] truncate text-[8px] text-[#94A3B8]">
                                    {{ $job->hirer?->email }}
                                </p>

                            </td>


                            {{-- Category and Area --}}
                            <td class="px-4 py-3">

                                <p class="text-[10px] text-[#CBD5E1]">
                                    {{ $job->category }}
                                </p>

                                <p class="mt-1 max-w-[150px] truncate text-[8px] text-[#94A3B8]">
                                    {{ $job->area }}
                                </p>

                            </td>


                            {{-- Budget --}}
                            <td class="px-4 py-3">

                                <p class="whitespace-nowrap text-[11px] font-bold text-white">
                                    ৳{{ number_format($job->budget, 0) }}
                                </p>

                            </td>


                            {{-- Applicants --}}
                            <td class="px-4 py-3">

                                <span class="inline-flex h-7 min-w-7 items-center justify-center rounded-md bg-[#17283A] px-2 text-[9px] font-semibold text-[#CBD5E1]">
                                    {{ $job->applications_count }}
                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-3">

                                <span class="inline-flex rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $statusClasses }}">
                                    {{ $job->status }}
                                </span>

                            </td>


                            {{-- Created --}}
                            <td class="px-4 py-3">

                                <p class="text-[10px] text-[#CBD5E1]">
                                    {{ $job->created_at->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-[8px] text-[#94A3B8]">
                                    {{ $job->created_at->diffForHumans() }}
                                </p>

                            </td>


                            {{-- Actions --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center justify-end gap-2">

                                    <a
                                        href="{{ route('admin.jobs.show', $job) }}"
                                        class="inline-flex h-8 items-center justify-center rounded-md border border-[#33475B] px-3 text-[9px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white"
                                    >
                                        View
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('admin.jobs.destroy', $job) }}"
                                        onsubmit="return confirm('Remove this job permanently? Related applications and reviews may also be removed.');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex h-8 items-center justify-center gap-1.5 rounded-md border border-[#7F2D3B] bg-[#4A2029] px-3 text-[9px] font-semibold text-[#FB7185] transition-colors hover:bg-[#642938]"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="h-3.5 w-3.5"
                                            >
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4h8v2"/>
                                                <path d="m19 6-1 14H6L5 6"/>
                                                <path d="M10 11v5M14 11v5"/>
                                            </svg>

                                            Remove
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center">

                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-[#17283A] text-[#94A3B8]">

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

                                <h3 class="mt-3 text-[13px] font-bold text-white">
                                    No jobs found
                                </h3>

                                <p class="mt-1 text-[10px] text-[#94A3B8]">
                                    Try changing the selected filters.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Mobile Cards --}}
        <div class="divide-y divide-[#223345] lg:hidden">

            @forelse($jobs as $job)

                @php
                    $statusClasses = match(strtolower($job->status)) {
                        'open' => 'bg-[#123E2D] text-[#4ADE80]',
                        'assigned' => 'bg-[#17365F] text-[#60A5FA]',
                        'completed' => 'bg-[#4A3515] text-[#FBBF24]',
                        default => 'bg-[#17283A] text-[#CBD5E1]',
                    };
                @endphp

                <article class="p-4">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0">

                            <h3 class="truncate text-[12px] font-semibold text-white">
                                {{ $job->title }}
                            </h3>

                            <p class="mt-1 text-[9px] text-[#94A3B8]">
                                {{ $job->category }} · {{ $job->area }}
                            </p>

                        </div>

                        <span class="rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $statusClasses }}">
                            {{ $job->status }}
                        </span>

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-4">

                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Hirer
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $job->hirer?->name ?? 'Deleted Hirer' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Budget
                            </p>

                            <p class="mt-1 text-[11px] font-bold text-white">
                                ৳{{ number_format($job->budget, 0) }}
                            </p>
                        </div>


                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Applicants
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $job->applications_count }}
                            </p>
                        </div>


                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Created
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $job->created_at->format('d M Y') }}
                            </p>
                        </div>

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-2">

                        <a
                            href="{{ route('admin.jobs.show', $job) }}"
                            class="inline-flex h-9 items-center justify-center rounded-md border border-[#33475B] text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                        >
                            View Details
                        </a>


                        <form
                            method="POST"
                            action="{{ route('admin.jobs.destroy', $job) }}"
                            onsubmit="return confirm('Remove this job permanently? Related applications and reviews may also be removed.');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex h-9 w-full items-center justify-center rounded-md border border-[#7F2D3B] bg-[#4A2029] text-[10px] font-semibold text-[#FB7185]"
                            >
                                Remove Job
                            </button>

                        </form>

                    </div>

                </article>

            @empty

                <div class="px-5 py-12 text-center text-[11px] text-[#94A3B8]">
                    No jobs match the selected filters.
                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($jobs->hasPages())

            <div class="border-t border-[#223345] px-4 py-3">
                {{ $jobs->links() }}
            </div>

        @endif

    </section>

</div>

@endsection