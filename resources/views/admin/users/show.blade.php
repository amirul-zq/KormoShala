<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - KormoShala</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="mx-auto max-w-4xl px-6 py-10">

    <div class="flex items-center justify-between">

        <h1 class="text-3xl font-bold text-slate-900">
            User Details
        </h1>

        <a
            href="{{ route('admin.users.index') }}"
            class="rounded-lg border border-slate-300 px-4 py-2 hover:bg-white"
        >
            Back
        </a>

    </div>


    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm">

        <div class="space-y-4">

            <div>
                <p class="text-sm text-slate-500">
                    Name
                </p>

                <p class="font-semibold">
                    {{ $user->name }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Email
                </p>

                <p class="font-semibold">
                    {{ $user->email }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    WhatsApp Number
                </p>

                <p class="font-semibold">
                    {{ $user->whatsapp_number }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Address
                </p>

                <p class="font-semibold">
                    {{ $user->address }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Role
                </p>

                <p class="font-semibold capitalize">
                    {{ $user->role }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Status
                </p>

                <p class="font-semibold capitalize">
                    {{ $user->status }}
                </p>
            </div>


            <div>
                <p class="text-sm text-slate-500">
                    Registered At
                </p>

                <p class="font-semibold">
                    {{ $user->created_at->format('d M Y') }}
                </p>
            </div>

        </div>

    </div>

</div>

</body>
</html>