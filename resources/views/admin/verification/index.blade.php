@extends('layouts.admin')

@section('title', 'Worker Verification - KormoShala')

@section('content')

<div class="mx-auto max-w-[1600px]">

    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                Worker Verification
            </h1>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                Review Worker profiles and manage verification status.
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


    @if($errors->any())
        <div class="mt-4 rounded-md border border-[#7F2D3B] bg-[#4A2029] px-4 py-3 text-[11px] text-[#FB7185]">
            {{ $errors->first() }}
        </div>
    @endif


    {{-- Statistics --}}
    <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total --}}
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
                        <path d="M12 3 5 6v5c0 5 3 8 7 10 4-2 7-5 7-10V6z"/>
                    </svg>

                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Total Profiles
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($totalProfiles) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Pending --}}
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
                        <path d="M12 8v4l3 2"/>
                    </svg>

                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Pending
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($pendingProfiles) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Verified --}}
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
                        Verified
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($verifiedProfiles) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Rejected --}}
        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#4A2029] text-[#FB7185]">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="m8 8 8 8M16 8l-8 8"/>
                    </svg>

                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Rejected
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($rejectedProfiles) }}
                    </p>
                </div>

            </div>

        </article>

    </div>


    {{-- Main Panel --}}
    <section class="mt-4 overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

        {{-- Panel Header --}}
        <div class="flex flex-col gap-3 border-b border-[#223345] px-4 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-[16px] font-bold text-white">
                    Worker Profiles
                </h2>

                <p class="mt-1 text-[10px] text-[#94A3B8]">
                    Search profiles and approve or reject Worker verification.
                </p>
            </div>

            <span class="w-fit rounded-md bg-[#123E2D] px-3 py-1.5 text-[9px] font-semibold text-[#4ADE80]">
                {{ $profiles->total() }} results
            </span>

        </div>


        {{-- Filters --}}
        <form
            method="GET"
            action="{{ route('admin.verification.index') }}"
            class="border-b border-[#223345] p-4"
        >

            <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-[minmax(280px,1.6fr)_0.85fr_1fr_auto]">

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
                        placeholder="Search Worker, email, category or area..."
                        class="h-10 w-full rounded-md border border-[#2C4054] bg-[#17283A] pl-9 pr-3 text-[11px] text-white placeholder:text-[#94A3B8] focus:border-[#1E7B4A] focus:outline-none focus:ring-2 focus:ring-[#22C55E]/10"
                    >

                </div>


                {{-- Status --}}
                <select
                    name="status"
                    class="h-10 rounded-md border border-[#2C4054] bg-[#17283A] px-3 text-[11px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none"
                >
                    <option value="">All Statuses</option>

                    <option value="pending" @selected(request('status') === 'pending')>
                        Pending
                    </option>

                    <option value="verified" @selected(request('status') === 'verified')>
                        Verified
                    </option>

                    <option value="rejected" @selected(request('status') === 'rejected')>
                        Rejected
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
                            href="{{ route('admin.verification.index') }}"
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
                            Worker
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Category
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Service Area
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Expected Rate
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Status
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Updated
                        </th>

                        <th class="px-4 py-3 text-right text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Actions
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-[#223345]">

                    @forelse($profiles as $profile)

                        @php
                            $statusClasses = match($profile->verification_status) {
                                'verified' => 'bg-[#123E2D] text-[#4ADE80]',
                                'rejected' => 'bg-[#4A2029] text-[#FB7185]',
                                default => 'bg-[#4A3515] text-[#FBBF24]',
                            };
                        @endphp

                        <tr class="transition-colors hover:bg-[#17283A]">

                            {{-- Worker --}}
                            <td class="px-4 py-3">

                                <div class="flex min-w-[190px] items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[11px] font-bold text-[#60A5FA]">
                                        {{ strtoupper(substr($profile->user?->name ?? 'W', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-[11px] font-semibold text-white">
                                            {{ $profile->user?->name ?? 'Deleted Worker' }}
                                        </p>

                                        <p class="mt-0.5 max-w-[190px] truncate text-[8px] text-[#94A3B8]">
                                            {{ $profile->user?->email }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}
                            <td class="px-4 py-3">

                                <span class="inline-flex rounded-md bg-[#17365F] px-2 py-1 text-[8px] font-semibold text-[#60A5FA]">
                                    {{ $profile->category }}
                                </span>

                            </td>


                            {{-- Area --}}
                            <td class="px-4 py-3">

                                <p class="max-w-[180px] truncate text-[10px] text-[#CBD5E1]">
                                    {{ $profile->area }}
                                </p>

                            </td>


                            {{-- Expected Rate --}}
                            <td class="px-4 py-3">

                                <p class="whitespace-nowrap text-[11px] font-bold text-white">
                                    ৳{{ number_format($profile->expected_rate, 0) }}
                                </p>

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-3">

                                <span class="inline-flex rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $statusClasses }}">
                                    {{ $profile->verification_status }}
                                </span>

                            </td>


                            {{-- Updated --}}
                            <td class="px-4 py-3">

                                <p class="text-[10px] text-[#CBD5E1]">
                                    {{ $profile->updated_at->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-[8px] text-[#94A3B8]">
                                    {{ $profile->updated_at->diffForHumans() }}
                                </p>

                            </td>


                            {{-- Actions --}}
                            <td class="px-4 py-3">

                                <form
                                    method="POST"
                                    action="{{ route('admin.verification.update', $profile) }}"
                                    class="flex items-center justify-end gap-2"
                                >
                                    @csrf
                                    @method('PATCH')


                                    @if($profile->verification_status !== 'verified')

                                        <button
                                            type="submit"
                                            name="verification_status"
                                            value="verified"
                                            class="inline-flex h-8 items-center justify-center rounded-md border border-[#1E7B4A] bg-[#123E2D] px-3 text-[9px] font-semibold text-[#4ADE80] transition-colors hover:bg-[#174D38]"
                                        >
                                            Verify
                                        </button>

                                    @endif


                                    @if($profile->verification_status !== 'rejected')

                                        <button
                                            type="submit"
                                            name="verification_status"
                                            value="rejected"
                                            class="inline-flex h-8 items-center justify-center rounded-md border border-[#7F2D3B] bg-[#4A2029] px-3 text-[9px] font-semibold text-[#FB7185] transition-colors hover:bg-[#642938]"
                                            onclick="return confirm('Reject this Worker profile?');"
                                        >
                                            Reject
                                        </button>

                                    @endif


                                    @if($profile->verification_status !== 'pending')

                                        <button
                                            type="submit"
                                            name="verification_status"
                                            value="pending"
                                            class="inline-flex h-8 items-center justify-center rounded-md border border-[#765B20] bg-[#4A3515] px-3 text-[9px] font-semibold text-[#FBBF24] transition-colors hover:bg-[#604618]"
                                        >
                                            Pending
                                        </button>

                                    @endif

                                </form>

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
                                        <path d="M12 3 5 6v5c0 5 3 8 7 10 4-2 7-5 7-10V6z"/>
                                    </svg>

                                </div>

                                <h3 class="mt-3 text-[13px] font-bold text-white">
                                    No Worker profiles found
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

            @forelse($profiles as $profile)

                @php
                    $statusClasses = match($profile->verification_status) {
                        'verified' => 'bg-[#123E2D] text-[#4ADE80]',
                        'rejected' => 'bg-[#4A2029] text-[#FB7185]',
                        default => 'bg-[#4A3515] text-[#FBBF24]',
                    };
                @endphp

                <article class="p-4">

                    <div class="flex items-start justify-between gap-3">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[12px] font-bold text-[#60A5FA]">
                                {{ strtoupper(substr($profile->user?->name ?? 'W', 0, 1)) }}
                            </div>

                            <div class="min-w-0">

                                <h3 class="truncate text-[12px] font-semibold text-white">
                                    {{ $profile->user?->name ?? 'Deleted Worker' }}
                                </h3>

                                <p class="mt-1 truncate text-[9px] text-[#94A3B8]">
                                    {{ $profile->user?->email }}
                                </p>

                            </div>

                        </div>

                        <span class="rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $statusClasses }}">
                            {{ $profile->verification_status }}
                        </span>

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-4">

                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Category
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $profile->category }}
                            </p>
                        </div>

                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Expected Rate
                            </p>

                            <p class="mt-1 text-[11px] font-bold text-white">
                                ৳{{ number_format($profile->expected_rate, 0) }}
                            </p>
                        </div>

                    </div>


                    <div class="mt-3">

                        <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                            Service Area
                        </p>

                        <p class="mt-1 text-[10px] text-[#CBD5E1]">
                            {{ $profile->area }}
                        </p>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('admin.verification.update', $profile) }}"
                        class="mt-4 grid grid-cols-3 gap-2"
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            name="verification_status"
                            value="verified"
                            class="inline-flex h-9 items-center justify-center rounded-md bg-[#123E2D] text-[9px] font-semibold text-[#4ADE80]"
                        >
                            Verify
                        </button>

                        <button
                            type="submit"
                            name="verification_status"
                            value="rejected"
                            class="inline-flex h-9 items-center justify-center rounded-md bg-[#4A2029] text-[9px] font-semibold text-[#FB7185]"
                        >
                            Reject
                        </button>

                        <button
                            type="submit"
                            name="verification_status"
                            value="pending"
                            class="inline-flex h-9 items-center justify-center rounded-md bg-[#4A3515] text-[9px] font-semibold text-[#FBBF24]"
                        >
                            Pending
                        </button>

                    </form>

                </article>

            @empty

                <div class="px-5 py-12 text-center text-[11px] text-[#94A3B8]">
                    No Worker profiles match the selected filters.
                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($profiles->hasPages())

            <div class="border-t border-[#223345] px-4 py-3">
                {{ $profiles->links() }}
            </div>

        @endif

    </section>

</div>

@endsection