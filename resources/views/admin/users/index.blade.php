<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-7xl px-6 py-10">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Manage Users
            </h1>

            <p class="mt-2 text-slate-600">
                View and manage all registered users.
            </p>
        </div>


        <a
            href="{{ route('admin.dashboard') }}"
            class="rounded-lg border border-slate-300 px-4 py-2 text-slate-700 hover:bg-white"
        >
            Dashboard
        </a>

    </div>


    @if(session('success'))
        <div class="mt-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif


    @if(session('error'))
        <div class="mt-6 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif


    <div class="mt-8 overflow-x-auto rounded-xl bg-white shadow-sm">

        <table class="w-full text-left">

            <thead class="border-b bg-slate-100">

                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Action</th>
                </tr>

            </thead>


            <tbody>

            @foreach($users as $user)

                <tr class="border-b">

                    <td class="px-6 py-4">
                        {{ $user->name }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>


                    <td class="px-6 py-4 capitalize">
                        {{ $user->role }}
                    </td>


                    <td class="px-6 py-4">

                        @if($user->status === 'active')

                            <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                                Active
                            </span>

                        @else

                            <span class="rounded-full bg-red-100 px-3 py-1 text-sm text-red-700">
                                Blocked
                            </span>

                        @endif

                    </td>


                    <td class="px-6 py-4">

                        <div class="flex gap-2">

                            <a
                                href="{{ route('admin.users.show', $user) }}"
                                class="rounded-lg border px-3 py-2 text-sm hover:bg-slate-50"
                            >
                                View
                            </a>


                            @if($user->role !== 'admin')

                                <form
                                    method="POST"
                                    action="{{ route('admin.users.status', $user) }}"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="rounded-lg bg-slate-900 px-3 py-2 text-sm text-white hover:bg-slate-700"
                                    >
                                        {{ $user->status === 'active' ? 'Block' : 'Unblock' }}
                                    </button>

                                </form>

                            @endif

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>