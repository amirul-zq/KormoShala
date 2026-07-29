@extends('layouts.app')

@section('title', 'My Applications - KormoShala')

@section('content')

<div class="mx-auto max-w-[1180px]">

    <div>
        <h1 class="text-[22px] font-bold leading-tight text-slate-900">
            My Applications
        </h1>

        <p class="mt-1 text-[12px] text-slate-500">
            Track your submitted applications and job offers.
        </p>
    </div>


    @if (session('success'))
        <div class="mt-4 rounded-md border border-brand-border bg-brand-light px-4 py-3 text-[12px] font-medium text-brand">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mt-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-[12px] font-medium text-red-700">
            {{ session('error') }}
        </div>
    @endif


    <div class="mt-4 overflow-hidden rounded-lg border border-border bg-white">

        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto md:block">

            <table class="w-full">

                <thead class="border-b border-border-light bg-slate-50">

                    <tr class="text-left">

                        <th class="px-4 py-3 text-[10px] font-semibold uppercase tracking-wide text-slate-500">
                            Job
                        </th>

                        <th class="px-4 py-3 text-[10px] font-semibold uppercase tracking-wide text-slate-500">
                            Offered Price
                        </th>

                        <th class="px-4 py-3 text-[10px] font-semibold uppercase tracking-wide text-slate-500">
                            Job Status
                        </th>

                        <th class="px-4 py-3 text-[10px] font-semibold uppercase tracking-wide text-slate-500">
                            Applied On
                        </th>

                        <th class="px-4 py-3 text-right text-[10px] font-semibold uppercase tracking-wide text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-border-light">

                    @forelse ($applications as $application)

                        @php
                            $status = strtolower($application->job->status);

                            $statusClasses = match ($status) {
                                'open' => 'bg-brand-light text-brand',
                                'assigned' => 'bg-info-light text-info',
                                'completed' => 'bg-brand-light text-brand',
                                default => 'bg-slate-100 text-slate-600',
                            };
                        @endphp

                        <tr class="hover:bg-slate-50">

                            {{-- Job --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-warning-light text-warning">

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

                                        <p class="truncate text-[12px] font-semibold text-slate-900">
                                            {{ $application->job->title }}
                                        </p>

                                        <p class="mt-0.5 text-[10px] text-slate-500">
                                            {{ $application->job->area }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Offer --}}
                            <td class="px-4 py-3">

                                <p class="text-[12px] font-bold text-slate-900">
                                    ৳{{ number_format($application->offered_price, 0) }}
                                </p>

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-3">

                                <span class="inline-flex rounded-md px-2 py-1 text-[9px] font-semibold {{ $statusClasses }}">
                                    {{ ucfirst($application->job->status) }}
                                </span>

                            </td>


                            {{-- Applied On --}}
                            <td class="px-4 py-3">

                                <p class="text-[11px] text-slate-600">
                                    {{ $application->created_at->format('d M Y') }}
                                </p>

                            </td>


                            {{-- Action --}}
                            <td class="px-4 py-3 text-right">

                                <a
                                    href="{{ route('worker.jobs.show', $application->job) }}"
                                    class="inline-flex h-8 items-center justify-center rounded-md border border-brand-border bg-white px-3 text-[10px] font-semibold text-brand hover:bg-brand-light"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center">

                                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-brand-light text-brand">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="h-5 w-5"
                                    >
                                        <rect x="4" y="4" width="16" height="16" rx="2"/>
                                        <path d="M8 9h8M8 13h6"/>
                                    </svg>

                                </div>

                                <h2 class="mt-3 text-[13px] font-bold text-slate-900">
                                    No applications yet
                                </h2>

                                <p class="mt-1 text-[11px] text-slate-500">
                                    Browse available jobs and submit your first application.
                                </p>

                                <a
                                    href="{{ route('worker.jobs.index') }}"
                                    class="mt-4 inline-flex h-9 items-center justify-center rounded-md bg-brand px-4 text-[11px] font-semibold text-white hover:bg-brand-dark"
                                >
                                    Browse Jobs
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Mobile Cards --}}
        <div class="divide-y divide-border-light md:hidden">

            @forelse ($applications as $application)

                @php
                    $status = strtolower($application->job->status);

                    $statusClasses = match ($status) {
                        'open' => 'bg-brand-light text-brand',
                        'assigned' => 'bg-info-light text-info',
                        'completed' => 'bg-brand-light text-brand',
                        default => 'bg-slate-100 text-slate-600',
                    };
                @endphp

                <article class="p-4">

                    <div class="flex items-start justify-between gap-3">

                        <div>
                            <h2 class="text-[12px] font-bold text-slate-900">
                                {{ $application->job->title }}
                            </h2>

                            <p class="mt-1 text-[10px] text-slate-500">
                                {{ $application->job->area }}
                            </p>
                        </div>

                        <span class="rounded-md px-2 py-1 text-[9px] font-semibold {{ $statusClasses }}">
                            {{ ucfirst($application->job->status) }}
                        </span>

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-4">

                        <div>
                            <p class="text-[9px] uppercase tracking-wide text-slate-400">
                                Offered Price
                            </p>

                            <p class="mt-1 text-[12px] font-bold text-slate-900">
                                ৳{{ number_format($application->offered_price, 0) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-[9px] uppercase tracking-wide text-slate-400">
                                Applied On
                            </p>

                            <p class="mt-1 text-[11px] text-slate-700">
                                {{ $application->created_at->format('d M Y') }}
                            </p>
                        </div>

                    </div>


                    <a
                        href="{{ route('worker.jobs.show', $application->job) }}"
                        class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md border border-brand-border bg-white text-[11px] font-semibold text-brand hover:bg-brand-light"
                    >
                        View
                    </a>

                </article>

            @empty

                <div class="px-5 py-10 text-center">

                    <h2 class="text-[13px] font-bold text-slate-900">
                        No applications yet
                    </h2>

                    <p class="mt-1 text-[11px] text-slate-500">
                        Browse available jobs and submit your first application.
                    </p>

                    <a
                        href="{{ route('worker.jobs.index') }}"
                        class="mt-4 inline-flex h-9 items-center justify-center rounded-md bg-brand px-4 text-[11px] font-semibold text-white"
                    >
                        Browse Jobs
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection