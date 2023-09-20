<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Passwords
            </h2>
            <a href="{{ route('passwords.create') }}" class="rounded-md bg-slate-950 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-700">+ Add password</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div role="list" class="divide-y divide-gray-100 grid grid-cols-3 gap-8">
                @foreach($passwords as $password)
                    <div class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="h-12 w-12 flex items-center justify-center text-4xl rounded-full bg-slate-950 text-white uppercase">{{ $password->getInitial() }}</div>
                            <div class="min-w-0 flex-auto">
                                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $password->site }}</p>
                                <p class="text-sm font-semibold leading-6 text-gray-900">{{ $password->login }}</p>
                                <p class="text-sm font-semibold leading-6 text-gray-900">{{ $password->password }}</p>

                                <a href="{{ route('passwords.edit', ['password' => $password->id]) }}" class="block w-full rounded-md bg-slate-950 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-700 mt-4">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
