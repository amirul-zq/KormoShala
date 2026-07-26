<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-7xl px-6 py-10">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Manage Jobs
            </h1>

            <p class="mt-2 text-slate-600">
                Monitor all jobs created by hirers.
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
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Hirer</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Area</th>
                    <th class="px-6 py-4">Budget</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Action</th>
                </tr>

            </thead>


            <tbody>

            @foreach($jobs as $job)

                <tr class="border-b">

                    <td class="px-6 py-4 font-medium">
                        {{ $job->title }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $job->hirer->name }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $job->category }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $job->area }}
                    </td>


                    <td class="px-6 py-4">
                        {{ number_format($job->budget, 2) }}
                    </td>


                    <td class="px-6 py-4">

                        <span class="rounded-full bg-slate-100 px-3 py-1 text-sm capitalize">
                            {{ $job->status }}
                        </span>

                    </td>


                    <td class="px-6 py-4">

                        <a
                            href="{{ route('admin.jobs.show', $job) }}"
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