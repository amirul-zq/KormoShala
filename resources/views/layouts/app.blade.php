<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KormoShala')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-page text-text-primary">

<div class="min-h-screen">

    {{-- =========================
         TOP HEADER
    ========================= --}}
    <header class="fixed left-0 right-0 top-0 z-50 h-[60px] border-b border-border bg-white lg:left-[205px]">

        <div class="flex h-full items-center justify-between gap-4 px-4 sm:px-5 lg:px-6">

            {{-- Mobile Menu --}}
            <button
                id="mobile-menu-button"
                type="button"
                class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-border text-slate-600 hover:bg-slate-50 lg:hidden"
                aria-label="Open navigation"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="h-5 w-5"
                >
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>


            {{-- Mobile Brand --}}
            <a
                href="{{ route('dashboard') }}"
                class="text-[18px] font-bold text-slate-900 lg:hidden"
            >
                KormoShala
            </a>


            {{-- Search --}}
            <div class="hidden w-full max-w-[430px] lg:block">

                <div class="relative">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                    >
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>

                    <input
                        type="text"
                        placeholder="Search jobs by title or category..."
                        class="h-9 w-full rounded-md border border-border bg-white pl-9 pr-3 text-[12px] text-slate-700 placeholder:text-slate-400 focus:border-brand focus:ring-1 focus:ring-brand/20"
                    >

                </div>

            </div>


            {{-- Right Controls --}}
            <div class="ml-auto flex items-center gap-3">

                {{-- Bell --}}
                <button
                    type="button"
                    class="hidden h-9 w-9 items-center justify-center rounded-md text-slate-600 hover:bg-slate-50 sm:inline-flex"
                    aria-label="Notifications"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>
                    </svg>
                </button>


                {{-- User --}}
                <div class="flex items-center gap-2">

                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-light text-sm font-bold text-brand">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="hidden leading-tight sm:block">

                        <p class="max-w-[120px] truncate text-[12px] font-semibold text-slate-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="mt-0.5 text-[10px] capitalize text-slate-500">
                            {{ auth()->user()->role }}
                        </p>

                    </div>


                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="hidden h-4 w-4 text-slate-400 sm:block"
                    >
                        <path d="m6 9 6 6 6-6"/>
                    </svg>

                </div>

            </div>

        </div>

    </header>


    {{-- =========================
         SIDEBAR
    ========================= --}}
    <aside
        id="role-sidebar"
        class="fixed inset-y-0 left-0 z-[60] hidden w-[205px] border-r border-slate-800 bg-[#102234] lg:block"
    >

        <div class="flex h-full flex-col">

            {{-- Brand --}}
            <div class="flex h-[60px] items-center border-b border-white/10 px-4">

                <a
                    href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 text-[17px] font-bold text-white"
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

            </div>


            {{-- Navigation --}}
            <nav class="flex-1 space-y-1 px-3 py-4">

                @if(auth()->user()->role === 'worker')

                    <a
                        href="{{ route('worker.dashboard') }}"
                        class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                        {{ request()->routeIs('worker.dashboard')
                            ? 'bg-brand text-white'
                            : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <path d="M3 11 12 4l9 7"/>
                            <path d="M5 10v10h14V10"/>
                        </svg>

                        Dashboard
                    </a>


                    <a
                        href="{{ route('worker.jobs.index') }}"
                        class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                        {{ request()->routeIs('worker.jobs.*')
                            ? 'bg-brand text-white'
                            : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                            <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>

                        Browse Jobs
                    </a>


                    <a
                        href="{{ route('worker.applications.index') }}"
                        class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                        {{ request()->routeIs('worker.applications.*')
                            ? 'bg-brand text-white'
                            : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <rect x="4" y="4" width="16" height="16" rx="2"/>
                            <path d="M8 9h8M8 13h6"/>
                        </svg>

                        My Applications
                    </a>


                    <a
                        href="{{ route('worker.work.index') }}"
                        class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                        {{ request()->routeIs('worker.work.*')
                            ? 'bg-brand text-white'
                            : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                            <path d="M3 12h18"/>
                        </svg>

                        Assigned Jobs
                    </a>


                    @if(auth()->user()->workerProfile)

                        <a
                            href="{{ route('worker.profile.edit') }}"
                            class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                            {{ request()->routeIs('worker.profile.*')
                                ? 'bg-brand text-white'
                                : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21a8 8 0 0 1 16 0"/>
                            </svg>

                            My Profile
                        </a>

                    @else

                        <a
                            href="{{ route('worker.profile.create') }}"
                            class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                            {{ request()->routeIs('worker.profile.*')
                                ? 'bg-brand text-white'
                                : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21a8 8 0 0 1 16 0"/>
                            </svg>

                            My Profile
                        </a>

                    @endif


                @elseif(auth()->user()->role === 'hirer')

                    <a
                        href="{{ route('hirer.dashboard') }}"
                        class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                        {{ request()->routeIs('hirer.dashboard')
                            ? 'bg-brand text-white'
                            : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <path d="M3 11 12 4l9 7"/>
                            <path d="M5 10v10h14V10"/>
                        </svg>

                        Dashboard
                    </a>


                    <a
                        href="{{ route('hirer.jobs.create') }}"
                        class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                        {{ request()->routeIs('hirer.jobs.create')
                            ? 'bg-brand text-white'
                            : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <rect x="4" y="5" width="16" height="15" rx="2"/>
                            <path d="M12 9v7M8.5 12.5h7"/>
                        </svg>

                        Post a Job
                    </a>


                    <a
                        href="{{ route('hirer.jobs.index') }}"
                        class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                        {{ request()->routeIs('hirer.jobs.index') || request()->routeIs('hirer.jobs.show')
                            ? 'bg-brand text-white'
                            : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                            <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>

                        My Jobs
                    </a>


                    <a
                        href="{{ route('hirer.work.index') }}"
                        class="flex h-10 items-center gap-3 rounded-md px-3 text-[12px] font-medium
                        {{ request()->routeIs('hirer.work.*') || request()->routeIs('hirer.reviews.*')
                            ? 'bg-brand text-white'
                            : 'text-slate-200 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M2 21a7 7 0 0 1 14 0"/>
                            <path d="M17 8h4M19 6v4"/>
                        </svg>

                        Assigned Jobs
                    </a>

                @endif

            </nav>


            {{-- Logout --}}
            <div class="border-t border-white/10 p-3">

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="flex h-10 w-full items-center gap-3 rounded-md px-3 text-left text-[12px] font-medium text-slate-200 hover:bg-white/5 hover:text-white"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-[17px] w-[17px]">
                            <path d="M10 17l5-5-5-5"/>
                            <path d="M15 12H3"/>
                            <path d="M14 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5"/>
                        </svg>

                        Logout
                    </button>

                </form>

            </div>

        </div>

    </aside>


    {{-- Mobile Overlay --}}
    <div
        id="mobile-menu-overlay"
        class="fixed inset-0 z-[55] hidden bg-black/40 lg:hidden"
    ></div>


    {{-- =========================
         MAIN CONTENT
    ========================= --}}
    <main class="min-h-screen bg-page pt-[60px] lg:ml-[205px]">

        <div class="px-4 py-5 sm:px-5 lg:px-6 lg:py-5">
            @yield('content')
        </div>

    </main>

</div>


<script>
    const menuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('role-sidebar');
    const overlay = document.getElementById('mobile-menu-overlay');

    function toggleMobileMenu() {
        if (!sidebar || !overlay) {
            return;
        }

        sidebar.classList.toggle('hidden');
        overlay.classList.toggle('hidden');
    }

    menuButton?.addEventListener('click', toggleMobileMenu);
    overlay?.addEventListener('click', toggleMobileMenu);
</script>

</body>
</html>