<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IUT | Password manager</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<body class="antialiased h-screen w-screen bg-slate-100 flex items-center justify-center">
<ul role="list" class="divide-y divide-gray-100">
    @foreach($passwords as $password)

    <li class="flex justify-between gap-x-6 py-5">
        <div class="flex min-w-0 gap-x-4">
            <div class="h-12 w-12 flex items-center justify-center text-4xl rounded-full bg-slate-950 text-white uppercase">{{ $password['initial'] }}</div>
            <div class="min-w-0 flex-auto">
                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $password['url'] }}</p>
                <p class="text-sm font-semibold leading-6 text-gray-900">{{ $password['email'] }}</p>
            </div>
        </div>
    </li>
    @endforeach
</ul>

</body>
</html>
