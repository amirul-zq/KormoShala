<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KormoShala - Local Work Marketplace</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 450ms ease-out both;
        }

        .fade-up-delay {
            animation: fadeUp 550ms 80ms ease-out both;
        }
    </style>
</head>

<body class="min-h-screen bg-white text-slate-900">

{{-- =========================
     PUBLIC HEADER
========================= --}}
<header class="border-b border-border bg-white">
    <div class="mx-auto flex h-[62px] max-w-[1240px] items-center justify-between px-5 lg:px-6">

        {{-- Brand --}}
        <a
            href="{{ route('home') }}"
            class="flex items-center gap-2 text-[19px] font-bold text-slate-900"
        >
            <span class="flex h-7 w-7 items-center justify-center rounded-md bg-brand text-white">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="h-4 w-4"
                >
                    <path d="M6 8h12"/>
                    <path d="M8 5v6"/>
                    <path d="M16 5v6"/>
                    <rect x="4" y="8" width="16" height="11" rx="2"/>
                </svg>
            </span>

            KormoShala
        </a>


        {{-- Desktop Navigation --}}
        <nav class="hidden items-center gap-7 md:flex">

            <a
                href="#categories"
                class="text-[13px] font-medium text-slate-700 hover:text-brand"
            >
                Browse Jobs
            </a>

            <a
                href="#how-it-works"
                class="text-[13px] font-medium text-slate-700 hover:text-brand"
            >
                How It Works
            </a>

            <a
                href="#about"
                class="text-[13px] font-medium text-slate-700 hover:text-brand"
            >
                About Us
            </a>


            @auth

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex h-9 items-center justify-center rounded-md bg-brand px-4 text-[13px] font-semibold text-white hover:bg-brand-dark"
                >
                    Dashboard
                </a>

            @else

                <a
                    href="{{ route('login') }}"
                    class="inline-flex h-9 items-center justify-center rounded-md border border-brand-border bg-white px-4 text-[13px] font-semibold text-brand hover:bg-brand-light"
                >
                    Login
                </a>

                <a
                    href="{{ route('register') }}"
                    class="inline-flex h-9 items-center justify-center rounded-md bg-brand px-4 text-[13px] font-semibold text-white hover:bg-brand-dark"
                >
                    Register
                </a>

            @endauth

        </nav>


        {{-- Mobile Action --}}
        <div class="md:hidden">

            @auth
                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex h-9 items-center justify-center rounded-md bg-brand px-4 text-sm font-semibold text-white"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-flex h-9 items-center justify-center rounded-md border border-brand-border px-4 text-sm font-semibold text-brand"
                >
                    Login
                </a>
            @endauth

        </div>

    </div>
</header>


<main>

    {{-- =========================
         HERO
    ========================= --}}
    <section class="bg-white">

        <div class="mx-auto grid max-w-[1240px] items-center gap-8 px-5 py-10 md:grid-cols-[1fr_0.9fr] lg:px-6 lg:py-12">

            {{-- Hero Copy --}}
            <div class="fade-up max-w-[520px]">

                <h1 class="text-[36px] font-extrabold leading-[1.12] tracking-[-0.02em] text-slate-900 sm:text-[40px]">
                    Find Local Work
                    <span class="block">
                        Get Work Done
                    </span>
                </h1>


                <p class="mt-4 max-w-[470px] text-[14px] leading-6 text-slate-600">
                    KormoShala connects people who need short-term work done with skilled and trustworthy local workers.
                </p>


                <div class="mt-6 flex flex-wrap gap-3">

                    <a
                        href="{{ route('register') }}"
                        class="inline-flex h-10 items-center justify-center rounded-md bg-brand px-5 text-[13px] font-semibold text-white hover:bg-brand-dark"
                    >
                        Post a Job
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="inline-flex h-10 items-center justify-center rounded-md border border-brand-border bg-white px-5 text-[13px] font-semibold text-brand hover:bg-brand-light"
                    >
                        Find Work
                    </a>

                </div>

            </div>


            {{-- Hero Illustration --}}
            <div class="fade-up-delay flex items-center justify-center md:justify-end">

                <img
                    src="{{ asset('assets/images/hero-workers.png') }}"
                    alt="KormoShala local worker and hirer"
                    class="h-auto max-h-[285px] w-auto max-w-full object-contain sm:max-h-[310px]"
                >

            </div>

        </div>

    </section>


    {{-- =========================
         HOW IT WORKS
    ========================= --}}
    <section
        id="how-it-works"
        class="border-y border-border-light bg-white"
    >

        <div class="mx-auto max-w-[1240px] px-5 py-7 lg:px-6">

            <div class="grid grid-cols-2 gap-x-6 gap-y-7 md:grid-cols-4">

                {{-- Post a Job --}}
                <div class="text-center">

                    <div class="mx-auto flex h-9 w-9 items-center justify-center text-brand">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-6 w-6"
                        >
                            <rect x="5" y="6" width="14" height="14" rx="2"/>
                            <path d="M9 6V4h6v2"/>
                            <path d="M12 10v6M9 13h6"/>
                        </svg>
                    </div>

                    <h2 class="mt-2 text-[13px] font-bold text-slate-900">
                        Post a Job
                    </h2>

                    <p class="mx-auto mt-1 max-w-[180px] text-[11px] leading-[1.55] text-slate-500">
                        It's free and easy to get started.
                    </p>

                </div>


                {{-- Receive Offers --}}
                <div class="text-center">

                    <div class="mx-auto flex h-9 w-9 items-center justify-center text-brand">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-6 w-6"
                        >
                            <path d="M7 18h10"/>
                            <path d="M9 14l-3-3 3-3"/>
                            <path d="M15 8l3 3-3 3"/>
                            <path d="M6 11h12"/>
                        </svg>
                    </div>

                    <h2 class="mt-2 text-[13px] font-bold text-slate-900">
                        Receive Offers
                    </h2>

                    <p class="mx-auto mt-1 max-w-[180px] text-[11px] leading-[1.55] text-slate-500">
                        Workers apply with their best price.
                    </p>

                </div>


                {{-- Choose the Best --}}
                <div class="text-center">

                    <div class="mx-auto flex h-9 w-9 items-center justify-center text-brand">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-6 w-6"
                        >
                            <circle cx="12" cy="7" r="3"/>
                            <path d="M6 20a6 6 0 0 1 12 0"/>
                            <path d="m17 9 1.5 1.5L21 8"/>
                        </svg>
                    </div>

                    <h2 class="mt-2 text-[13px] font-bold text-slate-900">
                        Choose the Best
                    </h2>

                    <p class="mx-auto mt-1 max-w-[180px] text-[11px] leading-[1.55] text-slate-500">
                        Select the best worker for your job.
                    </p>

                </div>


                {{-- Get Work Done --}}
                <div class="text-center">

                    <div class="mx-auto flex h-9 w-9 items-center justify-center text-brand">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-6 w-6"
                        >
                            <path d="M4 12l5 5L20 6"/>
                            <path d="M5 5h5"/>
                            <path d="M5 5v5"/>
                        </svg>
                    </div>

                    <h2 class="mt-2 text-[13px] font-bold text-slate-900">
                        Get Work Done
                    </h2>

                    <p class="mx-auto mt-1 max-w-[180px] text-[11px] leading-[1.55] text-slate-500">
                        Mark complete and leave a review.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
         POPULAR CATEGORIES
    ========================= --}}
    <section
        id="categories"
        class="bg-white"
    >

        <div class="mx-auto max-w-[1240px] px-5 py-7 lg:px-6">

            {{-- Section Header --}}
            <div class="flex items-center justify-between gap-4">

                <h2 class="text-[15px] font-bold text-slate-900">
                    Popular Categories
                </h2>

                <a
                    href="{{ route('register') }}"
                    class="text-[12px] font-semibold text-brand hover:text-brand-dark"
                >
                    View all categories →
                </a>

            </div>


            {{-- Category Grid --}}
            <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">

                {{-- Electrical --}}
                <div class="group rounded-lg border border-border bg-white px-3 py-4 text-center hover:border-brand-border hover:bg-brand-light">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="mx-auto h-6 w-6 text-blue-600"
                    >
                        <path d="m13 2-7 11h6l-1 9 7-12h-6z"/>
                    </svg>

                    <p class="mt-2 text-[12px] font-semibold text-slate-800">
                        Electrical
                    </p>

                </div>


                {{-- Plumbing --}}
                <div class="group rounded-lg border border-border bg-white px-3 py-4 text-center hover:border-brand-border hover:bg-brand-light">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="mx-auto h-6 w-6 text-indigo-600"
                    >
                        <path d="M14 6l4-4 4 4-4 4"/>
                        <path d="M10 14l-6 6"/>
                        <path d="M13 7l4 4-6 6-4-4z"/>
                    </svg>

                    <p class="mt-2 text-[12px] font-semibold text-slate-800">
                        Plumbing
                    </p>

                </div>


                {{-- Cleaning --}}
                <div class="group rounded-lg border border-border bg-white px-3 py-4 text-center hover:border-brand-border hover:bg-brand-light">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="mx-auto h-6 w-6 text-cyan-600"
                    >
                        <path d="M8 3h8"/>
                        <path d="M12 3v5"/>
                        <path d="M6 10h12l-2 10H8z"/>
                    </svg>

                    <p class="mt-2 text-[12px] font-semibold text-slate-800">
                        Cleaning
                    </p>

                </div>


                {{-- Painting --}}
                <div class="group rounded-lg border border-border bg-white px-3 py-4 text-center hover:border-brand-border hover:bg-brand-light">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="mx-auto h-6 w-6 text-brand"
                    >
                        <path d="M4 6h11a3 3 0 0 1 0 6H9"/>
                        <path d="M9 9v11"/>
                        <path d="M7 20h4"/>
                    </svg>

                    <p class="mt-2 text-[12px] font-semibold text-slate-800">
                        Painting
                    </p>

                </div>


                {{-- Carpentry --}}
                <div class="group rounded-lg border border-border bg-white px-3 py-4 text-center hover:border-brand-border hover:bg-brand-light">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="mx-auto h-6 w-6 text-amber-600"
                    >
                        <path d="M4 20 20 4"/>
                        <path d="m14 4 6 6"/>
                        <path d="m4 14 6 6"/>
                    </svg>

                    <p class="mt-2 text-[12px] font-semibold text-slate-800">
                        Carpentry
                    </p>

                </div>


                {{-- Moving --}}
                <div class="group rounded-lg border border-border bg-white px-3 py-4 text-center hover:border-brand-border hover:bg-brand-light">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="mx-auto h-6 w-6 text-orange-600"
                    >
                        <path d="M3 7h11v10H3z"/>
                        <path d="M14 10h4l3 3v4h-7z"/>
                        <circle cx="7" cy="19" r="2"/>
                        <circle cx="18" cy="19" r="2"/>
                    </svg>

                    <p class="mt-2 text-[12px] font-semibold text-slate-800">
                        Moving
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
         ABOUT — COMPACT
    ========================= --}}
    <section
        id="about"
        class="border-t border-border-light bg-page"
    >

        <div class="mx-auto max-w-[1240px] px-5 py-7 text-center lg:px-6">

            <p class="text-[11px] font-semibold uppercase tracking-wide text-brand">
                About KormoShala
            </p>

            <h2 class="mt-2 text-[20px] font-bold text-slate-900">
                Local workers. Local opportunities.
            </h2>

            <p class="mx-auto mt-2 max-w-2xl text-[13px] leading-6 text-slate-500">
                KormoShala makes it simple to post short-term work, receive worker offers, choose the right person, and complete the job.
            </p>

        </div>

    </section>

</main>


{{-- Compact Footer --}}
<footer class="border-t border-border bg-white">

    <div class="mx-auto flex max-w-[1240px] items-center justify-between px-5 py-4 text-[11px] text-slate-400 lg:px-6">

        <span>
            © {{ date('Y') }} KormoShala
        </span>

        <span class="hidden sm:inline">
            Find Local Work · Get Work Done
        </span>

    </div>

</footer>

</body>
</html>