<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-page text-text-primary">

<div class="flex min-h-screen">

    {{-- Brand / Information Panel --}}
    <section class="relative hidden w-[46%] overflow-hidden bg-brand lg:flex lg:flex-col lg:justify-between">

        <div class="relative z-10 p-10 xl:p-14">

            <a href="/" class="text-2xl font-bold text-white">
                KormoShala
            </a>

            <div class="mt-28 max-w-md">

                <p class="text-sm font-semibold uppercase tracking-wider text-white/70">
                    Local Work Marketplace
                </p>

                <h1 class="mt-4 text-4xl font-bold leading-tight text-white xl:text-5xl">
                    Find work.
                    <br>
                    Hire locally.
                </h1>

                <p class="mt-5 text-base leading-7 text-white/80">
                    KormoShala connects hirers with skilled local workers through a simple and reliable marketplace.
                </p>

            </div>

        </div>


        {{-- Decorative Shapes --}}
        <div class="pointer-events-none absolute -bottom-32 -right-24 h-96 w-96 rounded-full border-[60px] border-white/10"></div>

        <div class="pointer-events-none absolute bottom-20 right-28 h-32 w-32 rounded-full bg-white/5"></div>


        <div class="relative z-10 p-10 text-sm text-white/60 xl:p-14">
            Hire skilled people. Discover local opportunities.
        </div>

    </section>


    {{-- Login --}}
    <main class="flex min-h-screen flex-1 items-center justify-center px-4 py-10 sm:px-6">

        <div class="w-full max-w-md">

            {{-- Mobile Logo --}}
            <div class="mb-8 text-center lg:hidden">

                <a href="/" class="text-2xl font-bold text-brand">
                    KormoShala
                </a>

            </div>


            <div class="rounded-xl border border-border bg-white p-6 sm:p-8">

                <div>

                    <h1 class="text-2xl font-bold text-slate-900">
                        Welcome back
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Sign in to continue to your KormoShala account.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="mt-7 space-y-5"
                >
                    @csrf


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="block text-sm font-semibold text-slate-700"
                        >
                            Email Address
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            autofocus
                            autocomplete="email"
                            class="mt-2 h-11 w-full rounded-md border
                            {{ $errors->has('email') ? 'border-danger' : 'border-border' }}
                            bg-white px-3 text-sm text-slate-900
                            placeholder:text-slate-400
                            focus:border-brand focus:ring-0"
                        >

                        @error('email')
                            <p class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div>

                        <label
                            for="password"
                            class="block text-sm font-semibold text-slate-700"
                        >
                            Password
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                            class="mt-2 h-11 w-full rounded-md border
                            {{ $errors->has('password') ? 'border-danger' : 'border-border' }}
                            bg-white px-3 text-sm text-slate-900
                            placeholder:text-slate-400
                            focus:border-brand focus:ring-0"
                        >

                        @error('password')
                            <p class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Remember --}}
                    <div class="flex items-center">

                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 rounded border-border text-brand focus:ring-brand"
                        >

                        <label
                            for="remember"
                            class="ml-2 text-sm text-slate-600"
                        >
                            Remember me
                        </label>

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="inline-flex h-11 w-full items-center justify-center rounded-md bg-brand px-4 text-sm font-semibold text-white hover:bg-brand-dark"
                    >
                        Login
                    </button>

                </form>


                <div class="mt-7 border-t border-border-light pt-6 text-center">

                    <p class="text-sm text-slate-500">
                        Don't have an account?

                        <a
                            href="{{ route('register') }}"
                            class="font-semibold text-brand hover:text-brand-dark"
                        >
                            Create an account
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>