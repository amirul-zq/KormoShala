<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-7xl px-6 py-10">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Manage Applications
            </h1>

            <p class="mt-2 text-slate-600">
                Monitor worker applications and price offers.
            </p>
        </div>


        <a
            href="{{ route('admin.dashboard') }}"
            class="rounded-lg border border-slate-300 px-4 py-2 hover:bg-white"
        >
            Dashboard
        </a>

    </div>


    <div class="mt-8 overflow-x-auto rounded-xl bg-white shadow-sm">

        <table class="w-full text-left">

            <thead class="border-b bg-slate-100">

                <tr>
                    <th class="px-6 py-4">Job</th>
                    <th class="px-6 py-4">Worker</th>
                    <th class="px-6 py-4">Offered Price</th>
                    <th class="px-6 py-4">Message</th>
                    <th class="px-6 py-4">Action</th>
                </tr>

            </thead>


            <tbody>

            @foreach($applications as $application)

                <tr class="border-b">

                    <td class="px-6 py-4">
                        {{ $application->job->title }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $application->worker->name }}
                    </td>


                    <td class="px-6 py-4">
                        {{ number_format($application->offered_price, 2) }}
                    </td>


                    <td class="px-6 py-4">
                        {{ Str::limit($application->message, 50) }}
                    </td>


                    <td class="px-6 py-4">

                        <a
                            href="{{ route('admin.applications.show', $application) }}"
                            class="rounded-lg border px-3 py-2 text-sm hover:bg-slate-50"
                        >
                            View
                        </a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>