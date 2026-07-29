<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-page text-text-primary">

<div class="flex min-h-screen">

    {{-- Brand Panel --}}
    <section class="relative hidden w-[40%] overflow-hidden bg-brand lg:flex lg:flex-col lg:justify-between">

        <div class="relative z-10 p-10 xl:p-14">

            <a href="/" class="text-2xl font-bold text-white">
                KormoShala
            </a>

            <div class="mt-24 max-w-md">

                <p class="text-sm font-semibold uppercase tracking-wider text-white/70">
                    Join KormoShala
                </p>

                <h1 class="mt-4 text-4xl font-bold leading-tight text-white xl:text-5xl">
                    Hire locally.
                    <br>
                    Find local work.
                </h1>

                <p class="mt-5 text-base leading-7 text-white/80">
                    Create an account as a Hirer or Worker and start using the local marketplace.
                </p>

            </div>

        </div>


        <div class="pointer-events-none absolute -bottom-32 -right-24 h-96 w-96 rounded-full border-[60px] border-white/10"></div>

        <div class="pointer-events-none absolute bottom-20 right-24 h-32 w-32 rounded-full bg-white/5"></div>


        <div class="relative z-10 p-10 text-sm text-white/60 xl:p-14">
            Simple local hiring for everyday work.
        </div>

    </section>


    {{-- Registration --}}
    <main class="flex flex-1 items-center justify-center px-4 py-10 sm:px-6">

        <div class="w-full max-w-2xl">

            <div class="mb-8 text-center lg:hidden">

                <a href="/" class="text-2xl font-bold text-brand">
                    KormoShala
                </a>

            </div>


            <div class="rounded-xl border border-border bg-white p-6 sm:p-8">

                <div>

                    <h1 class="text-2xl font-bold text-slate-900">
                        Create your account
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Join KormoShala as a Hirer or Worker.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('register') }}"
                    class="mt-7 space-y-5"
                >
                    @csrf


                    <div class="grid gap-5 sm:grid-cols-2">

                        {{-- Name --}}
                        <div>

                            <label
                                for="name"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Full Name
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="Your full name"
                                required
                                autocomplete="name"
                                class="mt-2 h-11 w-full rounded-md border
                                {{ $errors->has('name') ? 'border-danger' : 'border-border' }}
                                bg-white px-3 text-sm text-slate-900
                                placeholder:text-slate-400
                                focus:border-brand focus:ring-0"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-danger">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


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

                    </div>


                    <div class="grid gap-5 sm:grid-cols-2">

                        {{-- WhatsApp --}}
                        <div>

                            <label
                                for="whatsapp_number"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                WhatsApp Number
                            </label>

                            <input
                                id="whatsapp_number"
                                name="whatsapp_number"
                                type="text"
                                value="{{ old('whatsapp_number') }}"
                                placeholder="+880..."
                                required
                                class="mt-2 h-11 w-full rounded-md border
                                {{ $errors->has('whatsapp_number') ? 'border-danger' : 'border-border' }}
                                bg-white px-3 text-sm text-slate-900
                                placeholder:text-slate-400
                                focus:border-brand focus:ring-0"
                            >

                            @error('whatsapp_number')
                                <p class="mt-2 text-sm text-danger">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Role --}}
                        <div>

                            <label
                                for="role"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Register As
                            </label>

                            <select
                                id="role"
                                name="role"
                                required
                                class="mt-2 h-11 w-full rounded-md border
                                {{ $errors->has('role') ? 'border-danger' : 'border-border' }}
                                bg-white px-3 text-sm text-slate-900
                                focus:border-brand focus:ring-0"
                            >
                                <option value="">
                                    Select role
                                </option>

                                <option value="hirer" @selected(old('role') === 'hirer')>
                                    Hirer
                                </option>

                                <option value="worker" @selected(old('role') === 'worker')>
                                    Worker
                                </option>
                            </select>

                            @error('role')
                                <p class="mt-2 text-sm text-danger">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Address --}}
                    <div>

                        <label
                            for="address"
                            class="block text-sm font-semibold text-slate-700"
                        >
                            Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            placeholder="Enter your address"
                            required
                            class="mt-2 w-full resize-none rounded-md border
                            {{ $errors->has('address') ? 'border-danger' : 'border-border' }}
                            bg-white px-3 py-3 text-sm leading-6 text-slate-900
                            placeholder:text-slate-400
                            focus:border-brand focus:ring-0"
                        >{{ old('address') }}</textarea>

                        @error('address')
                            <p class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div class="grid gap-5 sm:grid-cols-2">

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
                                placeholder="Create password"
                                required
                                autocomplete="new-password"
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


                        {{-- Confirm Password --}}
                        <div>

                            <label
                                for="password_confirmation"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Confirm Password
                            </label>

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="Confirm password"
                                required
                                autocomplete="new-password"
                                class="mt-2 h-11 w-full rounded-md border border-border bg-white px-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand focus:ring-0"
                            >

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="inline-flex h-11 w-full items-center justify-center rounded-md bg-brand px-4 text-sm font-semibold text-white hover:bg-brand-dark"
                    >
                        Create Account
                    </button>

                </form>


                <div class="mt-7 border-t border-border-light pt-6 text-center">

                    <p class="text-sm text-slate-500">
                        Already have an account?

                        <a
                            href="{{ route('login') }}"
                            class="font-semibold text-brand hover:text-brand-dark"
                        >
                            Login
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>