@extends('layouts.admin')

@section('title', 'Manage Reviews - KormoShala')

@section('content')

<div class="mx-auto max-w-[1600px]">

    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-[27px] font-bold tracking-[-0.025em] text-white">
                Reviews
            </h1>

            <p class="mt-1 text-[13px] text-[#94A3B8]">
                Monitor ratings and feedback submitted after completed jobs.
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

        {{-- Total Reviews --}}
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
                        <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2 7.5 14 3 9.6l6.2-.9z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Total Reviews
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($totalReviews) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Average Rating --}}
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


        {{-- Five Star --}}
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
                        <path d="M8 12l3 3 5-6"/>
                        <circle cx="12" cy="12" r="9"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Five-Star Reviews
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($fiveStarReviews) }}
                    </p>
                </div>

            </div>

        </article>


        {{-- Four Star --}}
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
                        <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2 7.5 14 3 9.6l6.2-.9z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[10px] text-[#94A3B8]">
                        Four-Star Reviews
                    </p>

                    <p class="mt-1 text-[21px] font-bold text-white">
                        {{ number_format($fourStarReviews) }}
                    </p>
                </div>

            </div>

        </article>

    </div>


    {{-- Main Reviews Panel --}}
    <section class="mt-4 overflow-hidden rounded-lg border border-[#26384A] bg-[#142130]">

        {{-- Panel Header --}}
        <div class="flex flex-col gap-3 border-b border-[#223345] px-4 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-[16px] font-bold text-white">
                    Marketplace Reviews
                </h2>

                <p class="mt-1 text-[10px] text-[#94A3B8]">
                    Search reviews and inspect marketplace feedback.
                </p>
            </div>

            <span class="w-fit rounded-md bg-[#123E2D] px-3 py-1.5 text-[9px] font-semibold text-[#4ADE80]">
                {{ $reviews->total() }} results
            </span>

        </div>


        {{-- Filters --}}
        <form
            method="GET"
            action="{{ route('admin.reviews.index') }}"
            class="border-b border-[#223345] p-4"
        >

            <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-[minmax(300px,1.8fr)_0.75fr_auto]">

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
                        placeholder="Search job, Hirer, Worker or review..."
                        class="h-10 w-full rounded-md border border-[#2C4054] bg-[#17283A] pl-9 pr-3 text-[11px] text-white placeholder:text-[#94A3B8] focus:border-[#1E7B4A] focus:outline-none focus:ring-2 focus:ring-[#22C55E]/10"
                    >

                </div>


                {{-- Rating --}}
                <select
                    name="rating"
                    class="h-10 rounded-md border border-[#2C4054] bg-[#17283A] px-3 text-[11px] text-[#CBD5E1] focus:border-[#1E7B4A] focus:outline-none"
                >
                    <option value="">All Ratings</option>

                    @for($rating = 5; $rating >= 1; $rating--)
                        <option
                            value="{{ $rating }}"
                            @selected((string) request('rating') === (string) $rating)
                        >
                            {{ $rating }} Star{{ $rating === 1 ? '' : 's' }}
                        </option>
                    @endfor
                </select>


                {{-- Actions --}}
                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="inline-flex h-10 flex-1 items-center justify-center rounded-md bg-[#159447] px-4 text-[11px] font-semibold text-white transition-colors hover:bg-[#15803D]"
                    >
                        Filter
                    </button>

                    @if(request()->hasAny(['search', 'rating']))
                        <a
                            href="{{ route('admin.reviews.index') }}"
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
                            Worker
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Rating
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Review
                        </th>

                        <th class="px-4 py-3 text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Submitted
                        </th>

                        <th class="px-4 py-3 text-right text-[9px] font-semibold uppercase tracking-wide text-[#94A3B8]">
                            Action
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-[#223345]">

                    @forelse($reviews as $review)

                        <tr class="transition-colors hover:bg-[#17283A]">

                            {{-- Job --}}
                            <td class="px-4 py-3">

                                <div class="flex min-w-[170px] items-center gap-3">

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

                                        <p class="max-w-[210px] truncate text-[11px] font-semibold text-white">
                                            {{ $review->job?->title ?? 'Deleted Job' }}
                                        </p>

                                        <p class="mt-0.5 text-[8px] text-[#94A3B8]">
                                            Review #{{ $review->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Hirer --}}
                            <td class="px-4 py-3">

                                <div class="flex min-w-[140px] items-center gap-2">

                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#123E2D] text-[10px] font-bold text-[#4ADE80]">
                                        {{ strtoupper(substr($review->hirer?->name ?? 'H', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-[10px] font-medium text-[#CBD5E1]">
                                            {{ $review->hirer?->name ?? 'Deleted Hirer' }}
                                        </p>

                                        <p class="mt-0.5 truncate text-[8px] text-[#94A3B8]">
                                            {{ $review->hirer?->email }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Worker --}}
                            <td class="px-4 py-3">

                                <div class="flex min-w-[140px] items-center gap-2">

                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#17365F] text-[10px] font-bold text-[#60A5FA]">
                                        {{ strtoupper(substr($review->worker?->name ?? 'W', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-[10px] font-medium text-[#CBD5E1]">
                                            {{ $review->worker?->name ?? 'Deleted Worker' }}
                                        </p>

                                        <p class="mt-0.5 truncate text-[8px] text-[#94A3B8]">
                                            {{ $review->worker?->workerProfile?->category ?? 'No category' }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Rating --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center gap-0.5 text-[11px] text-[#F59E0B]">

                                    @for($star = 1; $star <= 5; $star++)
                                        <span class="{{ $star <= $review->rating ? '' : 'text-[#475569]' }}">
                                            ★
                                        </span>
                                    @endfor

                                    <span class="ml-1 font-semibold text-white">
                                        {{ $review->rating }}/5
                                    </span>

                                </div>

                            </td>


                            {{-- Review --}}
                            <td class="px-4 py-3">

                                <p
                                    class="max-w-[250px] truncate text-[10px] text-[#CBD5E1]"
                                    title="{{ $review->review }}"
                                >
                                    {{ $review->review
                                        ? \Illuminate\Support\Str::limit($review->review, 60)
                                        : 'No written review' }}
                                </p>

                            </td>


                            {{-- Submitted --}}
                            <td class="px-4 py-3">

                                <p class="text-[10px] text-[#CBD5E1]">
                                    {{ $review->created_at->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-[8px] text-[#94A3B8]">
                                    {{ $review->created_at->diffForHumans() }}
                                </p>

                            </td>


                            {{-- Action --}}
                            <td class="px-4 py-3 text-right">

                                <a
                                    href="{{ route('admin.reviews.show', $review) }}"
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
                                        <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2 7.5 14 3 9.6l6.2-.9z"/>
                                    </svg>
                                </div>

                                <h3 class="mt-3 text-[13px] font-bold text-white">
                                    No reviews found
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

            @forelse($reviews as $review)

                <article class="p-4">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0">

                            <h3 class="truncate text-[12px] font-semibold text-white">
                                {{ $review->job?->title ?? 'Deleted Job' }}
                            </h3>

                            <p class="mt-1 text-[9px] text-[#94A3B8]">
                                {{ $review->hirer?->name ?? 'Deleted Hirer' }}
                                reviewed
                                {{ $review->worker?->name ?? 'Deleted Worker' }}
                            </p>

                        </div>


                        <div class="flex shrink-0 items-center gap-1 text-[10px] text-[#F59E0B]">
                            <span>★</span>

                            <span class="font-semibold text-white">
                                {{ $review->rating }}/5
                            </span>
                        </div>

                    </div>


                    <div class="mt-4 rounded-md bg-[#17283A] p-3">

                        <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                            Review
                        </p>

                        <p class="mt-1 text-[10px] leading-5 text-[#CBD5E1]">
                            {{ $review->review ?: 'No written review was submitted.' }}
                        </p>

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-4">

                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Worker Category
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $review->worker?->workerProfile?->category ?? '—' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-[8px] uppercase tracking-wide text-[#64748B]">
                                Submitted
                            </p>

                            <p class="mt-1 text-[10px] text-[#CBD5E1]">
                                {{ $review->created_at->format('d M Y') }}
                            </p>
                        </div>

                    </div>


                    <a
                        href="{{ route('admin.reviews.show', $review) }}"
                        class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md border border-[#33475B] text-[10px] font-semibold text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:bg-[#123E2D]"
                    >
                        View Review Details
                    </a>

                </article>

            @empty

                <div class="px-5 py-12 text-center text-[11px] text-[#94A3B8]">
                    No reviews match the selected filters.
                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($reviews->hasPages())

            <div class="border-t border-[#223345] px-4 py-3">
                {{ $reviews->links() }}
            </div>

        @endif

    </section>

</div>

@endsection