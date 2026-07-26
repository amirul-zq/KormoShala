<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Verification - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-7xl px-6 py-10">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Worker Verification
            </h1>

            <p class="mt-2 text-slate-600">
                Review and manage worker verification status.
            </p>
        </div>


        <a
            href="{{ route('admin.dashboard') }}"
            class="rounded-lg border border-slate-300 px-4 py-2 hover:bg-white"
        >
            Dashboard
        </a>

    </div>


    @if(session('success'))

        <div class="mt-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>

    @endif


    <div class="mt-8 overflow-x-auto rounded-xl bg-white shadow-sm">

        <table class="w-full text-left">

            <thead class="border-b bg-slate-100">

                <tr>
                    <th class="px-6 py-4">Worker</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Area</th>
                    <th class="px-6 py-4">Expected Rate</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Action</th>
                </tr>

            </thead>


            <tbody>

            @foreach($profiles as $profile)

                <tr class="border-b">

                    <td class="px-6 py-4">
                        {{ $profile->user->name }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $profile->category }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $profile->area }}
                    </td>


                    <td class="px-6 py-4">
                        {{ number_format($profile->expected_rate, 2) }}
                    </td>


                    <td class="px-6 py-4">

                        <span class="rounded-full bg-slate-100 px-3 py-1 text-sm capitalize">
                            {{ $profile->verification_status }}
                        </span>

                    </td>


                    <td class="px-6 py-4">

                        <form
                            method="POST"
                            action="{{ route('admin.verification.update', $profile) }}"
                            class="flex gap-2"
                        >

                            @csrf
                            @method('PATCH')


                            <button
                                name="verification_status"
                                value="verified"
                                class="rounded-lg bg-green-600 px-3 py-2 text-sm text-white"
                            >
                                Verify
                            </button>


                            <button
                                name="verification_status"
                                value="rejected"
                                class="rounded-lg bg-red-600 px-3 py-2 text-sm text-white"
                            >
                                Reject
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>