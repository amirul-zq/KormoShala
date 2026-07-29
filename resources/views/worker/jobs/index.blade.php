@extends('layouts.app')

@section('title', 'Browse Jobs - KormoShala')

@section('content')

<div class="mx-auto max-w-[1180px]">

    {{-- Page Header --}}
    <div>
        <h1 class="text-[22px] font-bold leading-tight text-slate-900">
            Open Jobs
        </h1>

        <p class="mt-1 text-[12px] text-slate-500">
            Find available work opportunities near you.
        </p>
    </div>


    {{-- Filters --}}
    <div class="mt-4 rounded-lg border border-border bg-white p-3">

        <div class="grid gap-3 sm:grid-cols-3">

            <select
                id="category-filter"
                class="h-9 rounded-md border border-border bg-white px-3 text-[12px] text-slate-600 focus:border-brand focus:ring-1 focus:ring-brand/20"
            >
                <option value="">All Categories</option>

                @foreach($jobs->pluck('category')->filter()->unique()->sort() as $category)
                    <option value="{{ strtolower($category) }}">
                        {{ $category }}
                    </option>
                @endforeach
            </select>


            <select
                id="area-filter"
                class="h-9 rounded-md border border-border bg-white px-3 text-[12px] text-slate-600 focus:border-brand focus:ring-1 focus:ring-brand/20"
            >
                <option value="">All Areas</option>

                @foreach($jobs->pluck('area')->filter()->unique()->sort() as $area)
                    <option value="{{ strtolower($area) }}">
                        {{ $area }}
                    </option>
                @endforeach
            </select>


            <select
                id="sort-filter"
                class="h-9 rounded-md border border-border bg-white px-3 text-[12px] text-slate-600 focus:border-brand focus:ring-1 focus:ring-brand/20"
            >
                <option value="newest">
                    Sort: Newest
                </option>

                <option value="oldest">
                    Sort: Oldest
                </option>

                <option value="budget-high">
                    Budget: High to Low
                </option>

                <option value="budget-low">
                    Budget: Low to High
                </option>
            </select>

        </div>

    </div>


    {{-- Result Count --}}
    <div class="mt-4 flex items-center justify-between">

        <p class="text-[11px] font-medium text-slate-500">
            Showing
            <span id="visible-job-count" class="font-bold text-slate-900">
                {{ $jobs->count() }}
            </span>
            {{ Str::plural('job', $jobs->count()) }}
        </p>

    </div>


    {{-- Job List --}}
    <div
        id="job-list"
        class="mt-3 space-y-3"
    >

        @forelse($jobs as $job)

            <article
                class="job-row rounded-lg border border-border bg-white p-4 transition-colors hover:border-brand-border hover:bg-slate-50"
                data-category="{{ strtolower($job->category) }}"
                data-area="{{ strtolower($job->area) }}"
                data-date="{{ $job->work_date->timestamp }}"
                data-budget="{{ $job->budget }}"
            >

                <div class="flex flex-col gap-4 md:flex-row md:items-center">

                    {{-- Category Icon --}}
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-warning-light text-warning">

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


                    {{-- Job Information --}}
                    <div class="min-w-0 flex-1">

                        <h2 class="truncate text-[13px] font-bold text-slate-900">
                            {{ $job->title }}
                        </h2>

                        <div class="mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-[10px] text-slate-500">

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


                    {{-- Status --}}
                    <span class="w-fit shrink-0 rounded-md bg-brand-light px-2 py-1 text-[9px] font-semibold text-brand">
                        Open
                    </span>


                    {{-- Budget --}}
                    <div class="shrink-0 md:w-[110px] md:text-right">

                        <p class="text-[10px] text-slate-400">
                            Budget
                        </p>

                        <p class="mt-0.5 text-[13px] font-bold text-slate-900">
                            ৳{{ number_format($job->budget, 0) }}
                        </p>

                    </div>


                    {{-- Action --}}
                    <a
                        href="{{ route('worker.jobs.show', $job) }}"
                        class="inline-flex h-9 shrink-0 items-center justify-center rounded-md bg-brand px-4 text-[11px] font-semibold text-white hover:bg-brand-dark"
                    >
                        View Details
                    </a>

                </div>

            </article>

        @empty

            <div class="rounded-lg border border-border bg-white px-5 py-10 text-center">

                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-brand-light text-brand">

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
                    No available jobs
                </h2>

                <p class="mt-1 text-[11px] text-slate-500">
                    There are currently no open jobs available.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Filter Empty State --}}
    <div
        id="filter-empty-state"
        class="mt-3 hidden rounded-lg border border-border bg-white px-5 py-10 text-center"
    >

        <h2 class="text-[13px] font-bold text-slate-900">
            No matching jobs
        </h2>

        <p class="mt-1 text-[11px] text-slate-500">
            Try changing the selected filters.
        </p>

    </div>

</div>


<script>
    const categoryFilter = document.getElementById('category-filter');
    const areaFilter = document.getElementById('area-filter');
    const sortFilter = document.getElementById('sort-filter');
    const jobList = document.getElementById('job-list');
    const jobRows = Array.from(document.querySelectorAll('.job-row'));
    const visibleJobCount = document.getElementById('visible-job-count');
    const filterEmptyState = document.getElementById('filter-empty-state');

    function updateJobs() {
        const category = categoryFilter?.value.toLowerCase() ?? '';
        const area = areaFilter?.value.toLowerCase() ?? '';
        const sort = sortFilter?.value ?? 'newest';

        const visibleRows = jobRows.filter((row) => {
            const matchesCategory =
                !category || row.dataset.category === category;

            const matchesArea =
                !area || row.dataset.area === area;

            const visible = matchesCategory && matchesArea;

            row.classList.toggle('hidden', !visible);

            return visible;
        });

        visibleRows.sort((first, second) => {
            if (sort === 'oldest') {
                return Number(first.dataset.date) - Number(second.dataset.date);
            }

            if (sort === 'budget-high') {
                return Number(second.dataset.budget) - Number(first.dataset.budget);
            }

            if (sort === 'budget-low') {
                return Number(first.dataset.budget) - Number(second.dataset.budget);
            }

            return Number(second.dataset.date) - Number(first.dataset.date);
        });

        visibleRows.forEach((row) => jobList?.appendChild(row));

        if (visibleJobCount) {
            visibleJobCount.textContent = visibleRows.length;
        }

        filterEmptyState?.classList.toggle(
            'hidden',
            visibleRows.length !== 0 || jobRows.length === 0
        );
    }

    categoryFilter?.addEventListener('change', updateJobs);
    areaFilter?.addEventListener('change', updateJobs);
    sortFilter?.addEventListener('change', updateJobs);

    updateJobs();
</script>

@endsection