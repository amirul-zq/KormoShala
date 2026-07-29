@extends('layouts.admin')

@section('title', 'Manage Applications - KormoShala')

@section('content')

<div class="mx-auto max-w-[1600px]">

    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                Applications
            </h1>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                Monitor Worker applications, messages and offered prices.
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


    {{-- Statistics --}}
    <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#302557] text-[#A78BFA]">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                        <rect x="4" y="4" width="16" height="16" rx="2"/>
                        <path d="M8 9h8M8 13h6M8 17h4"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Total Applications
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($totalApplications) }}
                    </p>
                </div>

            </div>
        </article>


        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#123E2D] text-[#4ADE80]">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 8v4l3 2"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Open Job Applications
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($openJobApplications) }}
                    </p>
                </div>

            </div>
        </article>


        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#17365F] text-[#60A5FA]">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21a7 7 0 0 1 14 0"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Assigned Job Applications
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($assignedJobApplications) }}
                    </p>
                </div>

            </div>
        </article>


        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#4A3515] text-[#FBBF24]">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M8 12l3 3 5-6"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Completed Job Applications
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($completedJobApplications) }}
                    </p>
                </div>

            </div>
        </article>

    </div>


    {{-- Main Panel --}}
    <section class="mt-4 overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

        <div class="flex flex-col gap-3 border-b border-[#223345] px-4 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-[16px] font-bold text-white">
                    Worker Applications
                </h2>

                <p class="mt-1 text-[10px] text-[#94A3B8]">
                    Search applications and inspect submitted price offers.
                </p>
            </div>

            <span class="w-fit rounded-md bg-[#123E2D] px-3 py-1.5 text-[9px] font-semibold text-[#4ADE80]">
                {{ $applications->total() }} results
            </span>

        </div>


        {{-- Filters --}}
        <form
            method="GET"
            action="{{ route('admin.applications.index') }}"
            class="border-b border-[#223345] p-4"
        >

            <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-[minmax(280px,1.6fr)_0.85fr_1fr_auto]">

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
                        placeholder="Search job, Worker, message or area..."
                        class="h-10 w-full rounded-md border border-[#2C4054] bg-[#17283A] pl-9 pr-3 text-[11px] text-white placeholder:text-[#94A3B8] focus:border-[#1E7B4A] focus:outline-none focus:ring-2 focus:ring-[#22C55E]/10"
                    >

                </div>


                <select
                    name="job_status"
                    class="h-10 rounded-md border border-[#2C4054] bg-[#17283A] px-3 text-[11px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none"
                >
                    <option value="">All Job Statuses</option>

                    <option value="open" @selected(request('job_status') === 'open')>
                        Open
                    </option>

                    <option value="assigned" @selected(request('job_status') === 'assigned')>
                        Assigned
                    </option>

                    <option value="completed" @selected(request('job_status') === 'completed')>
                        Completed
                    </option>
                </select>


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


                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="inline-flex h-10 flex-1 items-center justify-center rounded-md bg-[#159447] px-4 text-[11px] font-semibold text-white transition-colors hover:bg-[#15803D]"
                    >
                        Filter
                    </button>

                    @if(request()->hasAny(['search', 'job_status', 'category']))
                        <a
                            href="{{ route('admin.applications.index') }}"
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
                            Worker
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Offered Price
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Message
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Job Status
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Applied
                        </th>

                        <th class="px-4 py-3 text-right text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Action
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-[#223345]">

                    @forelse($applications as $application)

                        @php
                            $statusClasses = match(strtolower($application->job?->status ?? 'unknown')) {
                                'open' => 'bg-[#123E2D] text-[#4ADE80]',
                                'assigned' => 'bg-[#17365F] text-[#60A5FA]',
                                'completed' => 'bg-[#4A3515] text-[#FBBF24]',
                                default => 'bg-[#17283A] text-[#CBD5E1]',
                            };
                        @endphp

                        <tr class="transition-colors hover:bg-[#17283A]">

                            <td class="px-4 py-3">

                                <div class="flex min-w-[190px] items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-[#4A3515] text-[#FBBF24]">

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
                                            {{ $application->job?->title ?? 'Deleted Job' }}
                                        </p>

                                        <p class="mt-0.5 truncate text-[8px] text-[#94A3B8]">
                                            {{ $application->job?->category }}
                                            @if($application->job?->area)
                                                · {{ $application->job->area }}
                                            @endif
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-4 py-3">

                                <div class="flex min-w-[150px] items-center gap-2">

                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[10px] font-bold text-[#60A5FA]">
                                        {{ strtoupper(substr($application->worker?->name ?? 'W', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-[10px] font-medium text-[#CBD5E1]">
                                            {{ $application->worker?->name ?? 'Deleted Worker' }}
                                        </p>

                                        <p class="mt-0.5 truncate text-[8px] text-[#94A3B8]">
                                            {{ $application->worker?->workerProfile?->category ?? 'No category' }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-4 py-3">

                                <p class="whitespace-nowrap text-[12px] font-bold text-white">
                                    ৳{{ number_format($application->offered_price, 0) }}
                                </p>

                                @if($application->job)
                                    <p class="mt-1 text-[8px] text-[#94A3B8]">
                                        Budget: ৳{{ number_format($application->job->budget, 0) }}
                                    </p>
                                @endif

                            </td>


                            <td class="px-4 py-3">

                                <p
                                    class="max-w-[240px] truncate text-[10px] text-[#CBD5E1]"
                                    title="{{ $application->message }}"
                                >
                                    {{ \Illuminate\Support\Str::limit($application->message, 55) }}
                                </p>

                            </td>


                            <td class="px-4 py-3">

                                <span class="inline-flex rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $statusClasses }}">
                                    {{ $application->job?->status ?? 'Unavailable' }}
                                </span>

                            </td>


                            <td class="px-4 py-3">

                                <p class="text-[10px] text-[#CBD5E1]">
                                    {{ $application->created_at->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-[8px] text-[#94A3B8]">
                                    {{ $application->created_at->diffForHumans() }}
                                </p>

                            </td>


                            <td class="px-4 py-3 text-right">

                                <a
                                    href="{{ route('admin.applications.show', $application) }}"
                                    class="inline-flex h-8 items-center justify-center rounded-md border border-[#33475B] px-3 text-[9px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">

                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-[#17283A] text-[#94A3B8]">

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

                                <h3 class="mt-3 text-[13px] font-bold text-white">
                                    No applications found
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

            @forelse($applications as $application)

                @php
                    $statusClasses = match(strtolower($application->job?->status ?? 'unknown')) {
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
                                {{ $application->job?->title ?? 'Deleted Job' }}
                            </h3>

                            <p class="mt-1 text-[9px] text-[#94A3B8]">
                                {{ $application->worker?->name ?? 'Deleted Worker' }}
                            </p>

                        </div>

                        <span class="rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $statusClasses }}">
                            {{ $application->job?->status ?? 'Unavailable' }}
                        </span>

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-4">

                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Offered Price
                            </p>

                            <p class="mt-1 text-[12px] font-bold text-white">
                                ৳{{ number_format($application->offered_price, 0) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Applied
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $application->created_at->format('d M Y') }}
                            </p>
                        </div>

                    </div>


                    <div class="mt-4 rounded-md bg-[#17283A] p-3">

                        <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                            Message
                        </p>

                        <p class="mt-1 text-[10px] leading-5 text-[#CBD5E1]">
                            {{ \Illuminate\Support\Str::limit($application->message, 120) }}
                        </p>

                    </div>


                    <a
                        href="{{ route('admin.applications.show', $application) }}"
                        class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md border border-[#33475B] text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                    >
                        View Application Details
                    </a>

                </article>

            @empty

                <div class="px-5 py-12 text-center text-[11px] text-[#94A3B8]">
                    No applications match the selected filters.
                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($applications->hasPages())

            <div class="border-t border-[#223345] px-4 py-3">
                {{ $applications->links() }}
            </div>

        @endif

    </section>

</div>

@endsection