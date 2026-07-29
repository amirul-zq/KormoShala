@extends('layouts.admin')

@section('title', 'Manage Users - KormoShala')

@section('content')

<div class="mx-auto max-w-[1600px]">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                Users
            </h1>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                View, filter and manage all registered KormoShala users.
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
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21a7 7 0 0 1 14 0"/>
                        <path d="M16 3.5a4 4 0 0 1 0 7.5"/>
                        <path d="M17 14a6 6 0 0 1 5 6"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">Total Users</p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($totalUsers) }}
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
                        <path d="m8 12 3 3 5-6"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">Active Users</p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($activeUsers) }}
                    </p>
                </div>

            </div>
        </article>


        <article class="rounded-lg border border-[#26384A] bg-[#142130] p-4">
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#4A2029] text-[#FB7185]">
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
                    <p class="text-[10px] text-[#94A3B8]">Blocked Users</p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($blockedUsers) }}
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
                    <p class="text-[10px] text-[#94A3B8]">Workers</p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($totalWorkers) }}
                    </p>
                </div>

            </div>
        </article>

    </div>


    {{-- Main Users Panel --}}
    <section class="mt-4 overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

        {{-- Panel Header --}}
        <div class="flex flex-col gap-3 border-b border-[#223345] px-4 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-[16px] font-bold text-white">
                    Registered Users
                </h2>

                <p class="mt-1 text-[10px] text-[#94A3B8]">
                    Search users and manage their account access.
                </p>
            </div>

            <span class="w-fit rounded-md bg-[#123E2D] px-3 py-1.5 text-[9px] font-semibold text-[#4ADE80]">
                {{ $users->total() }} results
            </span>

        </div>


        {{-- Filters --}}
        <form
            method="GET"
            action="{{ route('admin.users.index') }}"
            class="border-b border-[#223345] p-4"
        >

            <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-[minmax(240px,1.5fr)_0.75fr_0.75fr_1fr_auto]">

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
                        placeholder="Search name, email, phone or address..."
                        class="h-10 w-full rounded-md border border-[#2C4054] bg-[#17283A] pl-9 pr-3 text-[11px] text-white placeholder:text-[#94A3B8] focus:border-[#1E7B4A] focus:outline-none focus:ring-2 focus:ring-[#22C55E]/10"
                    >

                </div>


                {{-- Role --}}
                <select
                    name="role"
                    class="h-10 rounded-md border border-[#2C4054] bg-[#17283A] px-3 text-[11px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none"
                >
                    <option value="">All Roles</option>

                    <option value="hirer" @selected(request('role') === 'hirer')>
                        Hirer
                    </option>

                    <option value="worker" @selected(request('role') === 'worker')>
                        Worker
                    </option>

                    <option value="admin" @selected(request('role') === 'admin')>
                        Admin
                    </option>
                </select>


                {{-- Status --}}
                <select
                    name="status"
                    class="h-10 rounded-md border border-[#2C4054] bg-[#17283A] px-3 text-[11px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none"
                >
                    <option value="">All Statuses</option>

                    <option value="active" @selected(request('status') === 'active')>
                        Active
                    </option>

                    <option value="blocked" @selected(request('status') === 'blocked')>
                        Blocked
                    </option>
                </select>


                {{-- Worker Category --}}
                <select
                    name="category"
                    class="h-10 rounded-md border border-[#2C4054] bg-[#17283A] px-3 text-[11px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none"
                >
                    <option value="">All Worker Categories</option>

                    @foreach($workerCategories as $category)
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

                    @if(request()->hasAny(['search', 'role', 'status', 'category']))
                        <a
                            href="{{ route('admin.users.index') }}"
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
                            User
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Contact
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Role
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Worker Category
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Status
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Registered
                        </th>

                        <th class="px-4 py-3 text-right text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Actions
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-[#223345]">

                    @forelse($users as $user)

                        @php
                            $isActive = $user->status === 'active';

                            $roleClasses = match($user->role) {
                                'admin' => 'bg-[#302557] text-[#A78BFA]',
                                'worker' => 'bg-[#17365F] text-[#60A5FA]',
                                default => 'bg-[#4A3515] text-[#FBBF24]',
                            };
                        @endphp

                        <tr class="transition-colors hover:bg-[#17283A]">

                            {{-- User --}}
                            <td class="px-4 py-3">

                                <div class="flex min-w-[180px] items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#123E2D] text-[11px] font-bold text-[#4ADE80]">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-[11px] font-semibold text-white">
                                            {{ $user->name }}
                                        </p>

                                        <p class="mt-0.5 truncate text-[9px] text-[#94A3B8]">
                                            {{ $user->email }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Contact --}}
                            <td class="px-4 py-3">

                                <p class="text-[10px] text-[#CBD5E1]">
                                    {{ $user->whatsapp_number }}
                                </p>

                                <p class="mt-1 max-w-[180px] truncate text-[9px] text-[#94A3B8]">
                                    {{ $user->address }}
                                </p>

                            </td>


                            {{-- Role --}}
                            <td class="px-4 py-3">

                                <span class="inline-flex rounded-md px-2 py-1 text-[8px] font-semibold capitalize {{ $roleClasses }}">
                                    {{ $user->role }}
                                </span>

                            </td>


                            {{-- Worker Category --}}
                            <td class="px-4 py-3">

                                <span class="text-[10px] text-[#CBD5E1]">
                                    {{ $user->workerProfile?->category ?? '—' }}
                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-3">

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-md px-2 py-1 text-[8px] font-semibold
                                    {{ $isActive
                                        ? 'bg-[#123E2D] text-[#4ADE80]'
                                        : 'bg-[#4A2029] text-[#FB7185]' }}"
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full
                                        {{ $isActive
                                            ? 'bg-[#22C55E]'
                                            : 'bg-[#EF4444]' }}"
                                    ></span>

                                    {{ ucfirst($user->status) }}
                                </span>

                            </td>


                            {{-- Registered --}}
                            <td class="px-4 py-3">

                                <p class="text-[10px] text-[#CBD5E1]">
                                    {{ $user->created_at->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-[8px] text-[#94A3B8]">
                                    {{ $user->created_at->diffForHumans() }}
                                </p>

                            </td>


                            {{-- Actions --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center justify-end gap-2">

                                    <a
                                        href="{{ route('admin.users.show', $user) }}"
                                        class="inline-flex h-8 items-center justify-center rounded-md border border-[#33475B] px-3 text-[9px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D] hover:text-white"
                                    >
                                        View
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
                                                class="inline-flex h-8 items-center justify-center rounded-md px-3 text-[9px] font-semibold transition-colors
                                                {{ $isActive
                                                    ? 'border border-[#7F2D3B] bg-[#4A2029] text-[#FB7185] hover:bg-[#642938]'
                                                    : 'border border-[#1E7B4A] bg-[#123E2D] text-[#4ADE80] hover:bg-[#174D38]' }}"
                                            >
                                                {{ $isActive ? 'Block' : 'Unblock' }}
                                            </button>

                                        </form>

                                    @else

                                        <span class="rounded-md bg-[#302557] px-2 py-1 text-[8px] font-semibold text-[#A78BFA]">
                                            Protected
                                        </span>

                                    @endif

                                </div>

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
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M2 21a7 7 0 0 1 14 0"/>
                                    </svg>
                                </div>

                                <h3 class="mt-3 text-[13px] font-bold text-white">
                                    No users found
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


        {{-- Mobile User Cards --}}
        <div class="divide-y divide-[#223345] lg:hidden">

            @forelse($users as $user)

                @php
                    $isActive = $user->status === 'active';
                @endphp

                <article class="p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#123E2D] text-[12px] font-bold text-[#4ADE80]">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0 flex-1">

                            <div class="flex flex-wrap items-center gap-2">

                                <h3 class="text-[12px] font-semibold text-white">
                                    {{ $user->name }}
                                </h3>

                                <span class="rounded-md bg-[#17283A] px-2 py-1 text-[8px] capitalize text-[#CBD5E1]">
                                    {{ $user->role }}
                                </span>

                            </div>

                            <p class="mt-1 truncate text-[9px] text-[#94A3B8]">
                                {{ $user->email }}
                            </p>

                        </div>

                        <span
                            class="rounded-md px-2 py-1 text-[8px] font-semibold
                            {{ $isActive
                                ? 'bg-[#123E2D] text-[#4ADE80]'
                                : 'bg-[#4A2029] text-[#FB7185]' }}"
                        >
                            {{ ucfirst($user->status) }}
                        </span>

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-4">

                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                WhatsApp
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $user->whatsapp_number }}
                            </p>
                        </div>

                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Category
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $user->workerProfile?->category ?? '—' }}
                            </p>
                        </div>

                    </div>


                    <p class="mt-3 text-[9px] text-[#94A3B8]">
                        {{ $user->address }}
                    </p>


                    <div class="mt-4 flex gap-2">

                        <a
                            href="{{ route('admin.users.show', $user) }}"
                            class="inline-flex h-9 flex-1 items-center justify-center rounded-md border border-[#33475B] text-[10px] font-semibold text-[#CBD5E1]"
                        >
                            View Details
                        </a>

                        @if($user->role !== 'admin')

                            <form
                                method="POST"
                                action="{{ route('admin.users.status', $user) }}"
                                class="flex-1"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="inline-flex h-9 w-full items-center justify-center rounded-md text-[10px] font-semibold
                                    {{ $isActive
                                        ? 'bg-[#4A2029] text-[#FB7185]'
                                        : 'bg-[#123E2D] text-[#4ADE80]' }}"
                                >
                                    {{ $isActive ? 'Block' : 'Unblock' }}
                                </button>

                            </form>

                        @endif

                    </div>

                </article>

            @empty

                <div class="px-5 py-12 text-center text-[11px] text-[#94A3B8]">
                    No users match the selected filters.
                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($users->hasPages())

            <div class="border-t border-[#223345] px-4 py-3">

                {{ $users->links() }}

            </div>

        @endif

    </section>

</div>

@endsection