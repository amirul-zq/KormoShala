<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KormoShala Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#13212F] font-sans text-[#F8FAFC]">

<div class="min-h-screen">

    {{-- =====================================================
         ADMIN SIDEBAR
    ====================================================== --}}
    <aside
        id="admin-sidebar"
        class="fixed inset-y-0 left-0 z-[70] hidden w-[218px] border-r border-[#223345] bg-[#0F1A28] xl:block"
    >
        <div class="flex h-full flex-col">

            {{-- Brand --}}
            <div class="flex h-[60px] items-center border-b border-[#223345] px-[18px]">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3"
                >
                    <span class="flex h-8 w-8 items-center justify-center rounded-md bg-[#159447] text-white">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-[18px] w-[18px]"
                        >
                            <rect x="4" y="4" width="6" height="6" rx="1"/>
                            <rect x="14" y="4" width="6" height="6" rx="1"/>
                            <rect x="4" y="14" width="6" height="6" rx="1"/>
                            <rect x="14" y="14" width="6" height="6" rx="1"/>
                        </svg>

                    </span>

                    <span class="text-[18px] font-bold tracking-[-0.02em] text-white">
                        KormoShala Admin
                    </span>
                </a>

            </div>


            {{-- Navigation --}}
            <nav class="flex-1 space-y-1 overflow-y-auto px-2 py-4">

                {{-- Dashboard --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex h-11 items-center gap-3 rounded-md px-4 text-[13px] font-semibold transition-colors
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-[#159447] text-white'
                        : 'text-[#CBD5E1] hover:bg-[#162739] hover:text-white' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <path d="M3 11 12 4l9 7"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>

                    Dashboard
                </a>


                {{-- Users --}}
                <a
                    href="{{ route('admin.users.index') }}"
                    class="flex h-11 items-center gap-3 rounded-md px-4 text-[13px] font-semibold transition-colors
                    {{ request()->routeIs('admin.users.*')
                        ? 'bg-[#159447] text-white'
                        : 'text-[#CBD5E1] hover:bg-[#162739] hover:text-white' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M2 21a7 7 0 0 1 14 0"/>
                        <path d="M16 3.5a4 4 0 0 1 0 7.5"/>
                        <path d="M17 14a6 6 0 0 1 5 6"/>
                    </svg>

                    <span class="flex-1">Users</span>

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-3.5 w-3.5 text-[#64748B]"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>


                {{-- Jobs --}}
                <a
                    href="{{ route('admin.jobs.index') }}"
                    class="flex h-11 items-center gap-3 rounded-md px-4 text-[13px] font-semibold transition-colors
                    {{ request()->routeIs('admin.jobs.*')
                        ? 'bg-[#159447] text-white'
                        : 'text-[#CBD5E1] hover:bg-[#162739] hover:text-white' }}"
                >
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

                    <span class="flex-1">Jobs</span>

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-3.5 w-3.5 text-[#64748B]"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>


                {{-- Applications --}}
                <a
                    href="{{ route('admin.applications.index') }}"
                    class="flex h-11 items-center gap-3 rounded-md px-4 text-[13px] font-semibold transition-colors
                    {{ request()->routeIs('admin.applications.*')
                        ? 'bg-[#159447] text-white'
                        : 'text-[#CBD5E1] hover:bg-[#162739] hover:text-white' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <rect x="4" y="4" width="16" height="16" rx="2"/>
                        <path d="M8 9h8M8 13h6M8 17h4"/>
                    </svg>

                    <span class="flex-1">Applications</span>

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-3.5 w-3.5 text-[#64748B]"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>


                {{-- Reviews --}}
                <a
                    href="{{ route('admin.reviews.index') }}"
                    class="flex h-11 items-center gap-3 rounded-md px-4 text-[13px] font-semibold transition-colors
                    {{ request()->routeIs('admin.reviews.*')
                        ? 'bg-[#159447] text-white'
                        : 'text-[#CBD5E1] hover:bg-[#162739] hover:text-white' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2 7.5 14 3 9.6l6.2-.9z"/>
                    </svg>

                    <span class="flex-1">Reviews</span>

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-3.5 w-3.5 text-[#64748B]"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>


                {{-- Worker Verification --}}
                <a
                    href="{{ route('admin.verification.index') }}"
                    class="flex h-11 items-center gap-3 rounded-md px-4 text-[13px] font-semibold transition-colors
                    {{ request()->routeIs('admin.verification.*')
                        ? 'bg-[#159447] text-white'
                        : 'text-[#CBD5E1] hover:bg-[#162739] hover:text-white' }}"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <path d="M12 3 5 6v5c0 5 3 8 7 10 4-2 7-5 7-10V6z"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>

                    Worker Verification
                </a>

            </nav>


            {{-- Bottom Actions --}}
            <div class="border-t border-[#223345]">

                {{-- Logout --}}
                <div class="px-2 py-3">

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="flex h-11 w-full items-center gap-3 rounded-md px-4 text-left text-[13px] font-semibold text-[#CBD5E1] transition-colors hover:bg-[#162739] hover:text-white"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-[18px] w-[18px]"
                            >
                                <path d="M10 17l5-5-5-5"/>
                                <path d="M15 12H3"/>
                                <path d="M14 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5"/>
                            </svg>

                            Logout
                        </button>

                    </form>

                </div>


                {{-- Admin Identity --}}
                <div class="border-t border-[#223345] px-4 py-4">

                    <div class="flex items-center gap-3">

                        <div class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#123E2D] text-sm font-bold text-[#4ADE80]">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                            <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full border-2 border-[#0F1A28] bg-[#22C55E]"></span>

                        </div>


                        <div class="min-w-0 flex-1">

                            <p class="truncate text-[12px] font-semibold text-white">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="mt-0.5 truncate text-[10px] text-[#94A3B8]">
                                {{ auth()->user()->email }}
                            </p>

                            <p class="mt-1 flex items-center gap-1 text-[9px] text-[#4ADE80]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#22C55E]"></span>
                                Online
                            </p>

                        </div>


                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            class="h-3.5 w-3.5 text-[#64748B]"
                        >
                            <path d="m9 18 6-6-6-6"/>
                        </svg>

                    </div>

                </div>

            </div>

        </div>
    </aside>


    {{-- =====================================================
         MOBILE OVERLAY
    ====================================================== --}}
    <div
        id="admin-sidebar-overlay"
        class="fixed inset-0 z-[60] hidden bg-black/60 xl:hidden"
    ></div>


    {{-- =====================================================
         ADMIN TOPBAR
    ====================================================== --}}
    <header class="fixed left-0 right-0 top-0 z-50 h-[60px] border-b border-[#223345] bg-[#101C2A] xl:left-[218px]">

        <div class="flex h-full items-center gap-4 px-4 sm:px-5 xl:px-6">

            {{-- Mobile Menu --}}
            <button
                id="admin-menu-button"
                type="button"
                class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-[#26384A] bg-[#17283A] text-[#CBD5E1] transition-colors hover:border-[#1E7B4A] hover:text-white xl:hidden"
                aria-label="Open admin navigation"
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


            {{-- Utility Button --}}
            <button
                type="button"
                class="hidden h-9 w-9 items-center justify-center rounded-md text-[#CBD5E1] transition-colors hover:bg-[#17283A] hover:text-white sm:inline-flex"
                aria-label="Dashboard utility"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-[18px] w-[18px]"
                >
                    <rect x="5" y="4" width="14" height="16" rx="2"/>
                    <path d="M9 8h6M9 12h6"/>
                </svg>
            </button>


            {{-- Search --}}
            <div class="hidden w-[320px] sm:block">

                <div class="relative">

                    <input
                        type="search"
                        placeholder="Search anything..."
                        class="h-9 w-full rounded-md border border-[#26384A] bg-[#17283A] px-3 pr-10 text-[11px] text-white placeholder:text-[#94A3B8] focus:border-[#1E7B4A] focus:outline-none focus:ring-2 focus:ring-[#22C55E]/10"
                    >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#94A3B8]"
                    >
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>

                </div>

            </div>


            <div class="ml-auto flex items-center gap-2 sm:gap-3">

                {{-- Theme Icon --}}
                <button
                    type="button"
                    class="hidden h-9 w-9 items-center justify-center rounded-md text-[#CBD5E1] transition-colors hover:bg-[#17283A] hover:text-white md:inline-flex"
                    aria-label="Theme appearance"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-[18px] w-[18px]"
                    >
                        <path d="M21 12.8A9 9 0 1 1 11.2 3 7 7 0 0 0 21 12.8Z"/>
                    </svg>
                </button>


                {{-- Notification --}}
                <button
                    type="button"
                    class="relative inline-flex h-9 w-9 items-center justify-center rounded-md text-[#CBD5E1] transition-colors hover:bg-[#17283A] hover:text-white"
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

                    <span class="absolute right-0.5 top-0.5 flex h-4 min-w-4 items-center justify-center rounded-full bg-[#22C55E] px-1 text-[8px] font-bold text-white">
                        0
                    </span>
                </button>


                <div class="hidden h-7 w-px bg-[#223345] sm:block"></div>


                {{-- Admin Name --}}
                <div class="hidden items-center gap-2 sm:flex">

                    <span class="max-w-[120px] truncate text-[11px] font-semibold text-white">
                        {{ auth()->user()->name }}
                    </span>

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-3.5 w-3.5 text-[#94A3B8]"
                    >
                        <path d="m6 9 6 6 6-6"/>
                    </svg>

                </div>


                {{-- Avatar --}}
                <div class="flex h-9 w-9 items-center justify-center rounded-full border border-[#33475B] bg-[#123E2D] text-xs font-bold text-[#4ADE80]">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

            </div>

        </div>

    </header>


    {{-- =====================================================
         MAIN ADMIN CONTENT
    ====================================================== --}}
    <main class="min-h-screen bg-[#13212F] pt-[60px] xl:ml-[218px]">

        <div class="px-4 py-4 sm:px-5 xl:px-6">
            @yield('content')
        </div>

    </main>

</div>


<script>
    const adminMenuButton = document.getElementById('admin-menu-button');
    const adminSidebar = document.getElementById('admin-sidebar');
    const adminSidebarOverlay = document.getElementById('admin-sidebar-overlay');

    function toggleAdminSidebar() {
        if (!adminSidebar || !adminSidebarOverlay) {
            return;
        }

        adminSidebar.classList.toggle('hidden');
        adminSidebar.classList.toggle('block');
        adminSidebarOverlay.classList.toggle('hidden');
    }

    adminMenuButton?.addEventListener('click', toggleAdminSidebar);
    adminSidebarOverlay?.addEventListener('click', toggleAdminSidebar);
</script>

</body>
</html>