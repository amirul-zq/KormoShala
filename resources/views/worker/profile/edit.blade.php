@extends('layouts.app')

@section('title', 'Edit Worker Profile - KormoShala')

@section('content')

<div class="mx-auto max-w-6xl">

    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            My Profile
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Manage your worker information and marketplace profile.
        </p>
    </div>


    @if (session('success'))
        <div class="mt-6 rounded-md border border-brand-border bg-brand-light px-4 py-3 text-sm font-medium text-brand">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mt-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            {{ session('error') }}
        </div>
    @endif


    <div class="mt-6 grid gap-6 lg:grid-cols-[300px_minmax(0,1fr)]">

        {{-- Profile Summary --}}
        <aside class="h-fit rounded-lg border border-border bg-white p-5">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-brand-light text-xl font-bold text-brand">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <h2 class="truncate text-lg font-bold text-slate-900">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $profile->category }}
                    </p>
                </div>

            </div>


            <div class="mt-5 border-t border-border-light pt-5">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        WhatsApp
                    </p>

                    <p class="mt-1.5 text-sm font-semibold text-slate-700">
                        {{ auth()->user()->whatsapp_number }}
                    </p>
                </div>


                <div class="mt-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Address
                    </p>

                    <p class="mt-1.5 text-sm leading-6 text-slate-700">
                        {{ auth()->user()->address }}
                    </p>
                </div>


                <div class="mt-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Rating
                    </p>

                    <div class="mt-1.5 flex items-center gap-2">

                        <span class="text-sm font-bold text-slate-900">
                            {{ number_format(auth()->user()->receivedReviews()->avg('rating') ?? 0, 1) }}
                        </span>

                        <span class="text-amber-500">★</span>

                        <span class="text-xs text-slate-400">
                            {{ auth()->user()->receivedReviews()->count() }}
                            {{ Str::plural('review', auth()->user()->receivedReviews()->count()) }}
                        </span>

                    </div>
                </div>

            </div>

        </aside>


        {{-- Edit Form --}}
        <section class="rounded-lg border border-border bg-white p-5 sm:p-6">

            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Work Information
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Keep your service details accurate and up to date.
                </p>
            </div>


            <form
                method="POST"
                action="{{ route('worker.profile.update') }}"
                class="mt-6 space-y-6"
            >
                @csrf
                @method('PUT')


                <div class="grid gap-5 sm:grid-cols-2">

                    <div>
                        <label for="category" class="block text-sm font-semibold text-slate-700">
                            Work Category
                        </label>

                        <input
                            id="category"
                            name="category"
                            type="text"
                            value="{{ old('category', $profile->category) }}"
                            required
                            class="mt-2 h-11 w-full rounded-md border {{ $errors->has('category') ? 'border-danger' : 'border-border' }} bg-white px-3 text-sm text-slate-900 focus:border-brand focus:ring-0"
                        >

                        @error('category')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="area" class="block text-sm font-semibold text-slate-700">
                            Service Area
                        </label>

                        <input
                            id="area"
                            name="area"
                            type="text"
                            value="{{ old('area', $profile->area) }}"
                            required
                            class="mt-2 h-11 w-full rounded-md border {{ $errors->has('area') ? 'border-danger' : 'border-border' }} bg-white px-3 text-sm text-slate-900 focus:border-brand focus:ring-0"
                        >

                        @error('area')
                            <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <div>
                    <label for="expected_rate" class="block text-sm font-semibold text-slate-700">
                        Expected Rate (৳)
                    </label>

                    <div class="relative mt-2">
                        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                            ৳
                        </span>

                        <input
                            id="expected_rate"
                            name="expected_rate"
                            type="number"
                            min="0"
                            step="0.01"
                            value="{{ old('expected_rate', $profile->expected_rate) }}"
                            required
                            class="h-11 w-full rounded-md border {{ $errors->has('expected_rate') ? 'border-danger' : 'border-border' }} bg-white pl-8 pr-3 text-sm text-slate-900 focus:border-brand focus:ring-0"
                        >
                    </div>

                    @error('expected_rate')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700">
                        About Your Work
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="7"
                        required
                        class="mt-2 w-full resize-none rounded-md border {{ $errors->has('description') ? 'border-danger' : 'border-border' }} bg-white px-3 py-3 text-sm leading-6 text-slate-900 focus:border-brand focus:ring-0"
                    >{{ old('description', $profile->description) }}</textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex justify-end border-t border-border-light pt-5">

                    <button
                        type="submit"
                        class="inline-flex h-11 w-full items-center justify-center rounded-md bg-brand px-6 text-sm font-semibold text-white hover:bg-brand-dark sm:w-auto"
                    >
                        Update Profile
                    </button>

                </div>

            </form>

        </section>

    </div>

</div>

@endsection