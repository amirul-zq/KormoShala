@extends('layouts.app')

@section('title', 'Assigned Jobs - KormoShala')

@section('content')

<div class="mx-auto max-w-[1180px]">

    <div>
        <h1 class="text-[22px] font-bold leading-tight text-slate-900">
            Assigned Jobs
        </h1>

        <p class="mt-1 text-[12px] text-slate-500">
            View the jobs assigned to you and track completed work.
        </p>
    </div>


    <div class="mt-4 space-y-3">

        @forelse ($jobs as $job)

            @php
                $status = strtolower($job->status);

                $statusClasses = match ($status) {
                    'assigned' => 'bg-info-light text-info',
                    'completed' => 'bg-brand-light text-brand',
                    default => 'bg-slate-100 text-slate-600',
                };
            @endphp

            <article class="rounded-lg border border-border bg-white">

                <div class="flex flex-col gap-4 p-4 md:flex-row md:items-center">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-info-light text-info">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-[18px] w-[18px]"
                        >
                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                            <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>

                    </div>


                    <div class="min-w-0 flex-1">

                        <div class="flex flex-wrap items-center gap-2">

                            <h2 class="text-[13px] font-bold text-slate-900">
                                {{ $job->title }}
                            </h2>

                            <span class="rounded-md px-2 py-1 text-[9px] font-semibold {{ $statusClasses }}">
                                {{ ucfirst($job->status) }}
                            </span>

                        </div>

                        <p class="mt-1 text-[10px] text-slate-500">
                            Hirer: {{ $job->hirer->name }}
                        </p>


                        <div class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-[10px] text-slate-500">

                            <span class="inline-flex items-center gap-1">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-3.5 w-3.5"
                                >
                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="2"/>
                                </svg>

                                {{ $job->area }}

                            </span>


                            <span class="inline-flex items-center gap-1">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-3.5 w-3.5"
                                >
                                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                                    <path d="M16 3v4M8 3v4M3 11h18"/>
                                </svg>

                                {{ $job->work_date->format('d M Y') }}

                            </span>


                            <span>
                                {{ $job->category }}
                            </span>

                        </div>

                    </div>


                    <div class="shrink-0 md:w-[110px] md:text-right">

                        <p class="text-[9px] uppercase tracking-wide text-slate-400">
                            Budget
                        </p>

                        <p class="mt-1 text-[14px] font-bold text-slate-900">
                            ৳{{ number_format($job->budget, 0) }}
                        </p>

                    </div>


                    <div class="flex shrink-0 flex-col gap-2 sm:flex-row">

                        <a
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $job->hirer->whatsapp_number) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex h-9 items-center justify-center gap-2 rounded-md border border-brand-border bg-white px-4 text-[10px] font-semibold text-brand hover:bg-brand-light"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-4 w-4"
                            >
                                <path d="M21 11.5a8.4 8.4 0 0 1-9 8.4 9.5 9.5 0 0 1-4.1-.9L3 21l2-4.7A8.5 8.5 0 1 1 21 11.5Z"/>
                                <path d="M8.5 8.5c.6 3 2 4.4 5 5"/>
                            </svg>

                            WhatsApp
                        </a>

                    </div>

                </div>


                @if ($job->description)

                    <div class="border-t border-border-light px-4 py-3">

                        <p class="line-clamp-2 text-[11px] leading-5 text-slate-600">
                            {{ $job->description }}
                        </p>

                    </div>

                @endif

            </article>

        @empty

            <div class="rounded-lg border border-border bg-white px-5 py-10 text-center">

                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-info-light text-info">

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

                <h2 class="mt-3 text-[13px] font-bold text-slate-900">
                    No assigned jobs
                </h2>

                <p class="mt-1 text-[11px] text-slate-500">
                    Jobs will appear here after a Hirer selects you.
                </p>

                <a
                    href="{{ route('worker.jobs.index') }}"
                    class="mt-4 inline-flex h-9 items-center justify-center rounded-md bg-brand px-4 text-[11px] font-semibold text-white hover:bg-brand-dark"
                >
                    Browse Jobs
                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection