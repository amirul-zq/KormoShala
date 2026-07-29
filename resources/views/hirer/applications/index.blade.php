@extends('layouts.app')

@section('title', 'Applicants - ' . $job->title . ' - KormoShala')

@section('content')

<div class="mx-auto max-w-7xl">

    {{-- Back Navigation --}}
    <a
        href="{{ route('hirer.jobs.show', $job) }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-brand"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" class="h-4 w-4">
            <path d="m15 18-6-6 6-6"/>
        </svg>

        Back to Job
    </a>


    {{-- Page Header --}}
    <div class="mt-4">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Applicants
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Compare workers and select the best person for
                    <span class="font-semibold text-slate-700">
                        {{ $job->title }}
                    </span>.
                </p>
            </div>


            <div class="rounded-md bg-brand-light px-3 py-2 text-sm font-semibold text-brand">
                {{ $job->applications->count() }}
                {{ Str::plural('Applicant', $job->applications->count()) }}
            </div>

        </div>

    </div>


    {{-- Applicants --}}
    <div class="mt-6 space-y-5">

        @forelse ($job->applications as $application)

            @php
                $worker = $application->worker;
                $profile = $worker->workerProfile;
                $averageRating = $worker->reviewsReceived->avg('rating') ?? 0;
                $reviewCount = $worker->reviewsReceived->count();
            @endphp


            <article class="rounded-lg border border-border bg-white">

                {{-- Worker Header --}}
                <div class="flex flex-col gap-5 border-b border-border-light p-5 sm:p-6 lg:flex-row lg:items-start lg:justify-between">

                    <div class="flex min-w-0 items-center gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand-light text-lg font-bold text-brand">
                            {{ strtoupper(substr($worker->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <h2 class="truncate text-lg font-bold text-slate-900">
                                {{ $worker->name }}
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $profile?->category ?? 'Category not provided' }}
                            </p>


                            <div class="mt-2 flex flex-wrap items-center gap-2 text-sm">

                                <span class="font-bold text-slate-900">
                                    {{ number_format($averageRating, 1) }}
                                </span>

                                <span class="text-amber-500">
                                    ★
                                </span>

                                <span class="text-slate-400">
                                    {{ $reviewCount }}
                                    {{ Str::plural('review', $reviewCount) }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Offered Price --}}
                    <div class="shrink-0 lg:text-right">

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Offered Price
                        </p>

                        <p class="mt-1 text-2xl font-bold text-brand">
                            ৳{{ number_format($application->offered_price, 0) }}
                        </p>

                    </div>

                </div>


                {{-- Applicant Details --}}
                <div class="p-5 sm:p-6">

                    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_260px]">

                        <div>

                            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Service Area
                                    </p>

                                    <p class="mt-1.5 text-sm font-semibold text-slate-700">
                                        {{ $profile?->area ?? 'Not provided' }}
                                    </p>
                                </div>


                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Expected Rate
                                    </p>

                                    <p class="mt-1.5 text-sm font-semibold text-slate-700">
                                        @if ($profile)
                                            ৳{{ number_format($profile->expected_rate, 0) }}
                                        @else
                                            Not provided
                                        @endif
                                    </p>
                                </div>


                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        WhatsApp
                                    </p>

                                    <p class="mt-1.5 break-all text-sm font-semibold text-slate-700">
                                        {{ $worker->whatsapp_number }}
                                    </p>
                                </div>


                                <div class="sm:col-span-2 xl:col-span-3">
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Address
                                    </p>

                                    <p class="mt-1.5 text-sm leading-6 text-slate-700">
                                        {{ $worker->address }}
                                    </p>
                                </div>

                            </div>


                            @if ($profile)

                                <div class="mt-6 border-t border-border-light pt-5">

                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        About the Worker
                                    </p>

                                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-600">
                                        {{ $profile->description }}
                                    </p>

                                </div>

                            @endif


                            <div class="mt-6 border-t border-border-light pt-5">

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Application Message
                                </p>

                                <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-600">
                                    {{ $application->message }}
                                </p>

                            </div>

                        </div>


                        {{-- Selection Panel --}}
                        <aside class="h-fit rounded-lg bg-page p-4">

                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Worker Offer
                            </p>

                            <p class="mt-2 text-xl font-bold text-slate-900">
                                ৳{{ number_format($application->offered_price, 0) }}
                            </p>


                            @if ($job->status === 'open')

                                <p class="mt-3 text-xs leading-5 text-slate-500">
                                    Selecting this worker will assign the job and close worker selection.
                                </p>

                                <form
                                    method="POST"
                                    action="{{ route('hirer.applications.select', [$job, $worker->id]) }}"
                                    class="mt-4"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="inline-flex h-10 w-full items-center justify-center rounded-md bg-brand px-4 text-sm font-semibold text-white hover:bg-brand-dark"
                                    >
                                        Select Worker
                                    </button>

                                </form>

                            @else

                                <div class="mt-4 rounded-md border border-border bg-white px-3 py-2 text-sm font-medium text-slate-500">
                                    Selection closed
                                </div>

                            @endif

                        </aside>

                    </div>

                </div>

            </article>

        @empty

            <div class="rounded-lg border border-border bg-white px-6 py-14 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-brand-light text-brand">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         class="h-5 w-5">
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21a7 7 0 0 1 14 0"/>
                        <path d="M16 3.5a4 4 0 0 1 0 7.5"/>
                        <path d="M17 14a6 6 0 0 1 5 6"/>
                    </svg>

                </div>

                <h2 class="mt-4 font-bold text-slate-900">
                    No applications received yet
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                    Workers have not applied to this job yet. New applications will appear here.
                </p>

                <a
                    href="{{ route('hirer.jobs.show', $job) }}"
                    class="mt-5 inline-flex h-10 items-center justify-center rounded-md border border-border bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                >
                    Back to Job
                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection