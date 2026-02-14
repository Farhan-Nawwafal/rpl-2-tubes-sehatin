<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heylth App</title>

    {{-- GANTI CDN DENGAN VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fffafa]">

    <div class="flex min-h-screen pl-64">

        <aside class="w-64 h-screen fixed left-0 top-0 bg-white shadow-lg overflow-y-auto flex flex-col justify-between">

            <div>
                <div class="p-6">
                    <h1 class="text-2xl font-bold">
                        <span class="text-[#007DFC]">Heylth</span>
                    </h1>
                </div>

                <nav class="mt-6">
                    <a href="{{ route('dashboard') }}"
                        class="block px-6 py-3 transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#007DFC] text-white' : 'text-gray-700 hover:bg-[#007DFC] hover:text-white' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('input.data.page') }}"
                        class="block px-6 py-3 transition-colors {{ request()->routeIs('input.data.page') ? 'bg-[#007DFC] text-white' : 'text-gray-700 hover:bg-[#007DFC] hover:text-white' }}">
                        Input Data
                    </a>

                    <a href="{{ route('journal') }}"
                        class="block px-6 py-3 transition-colors {{ request()->routeIs('journal') ? 'bg-[#007DFC] text-white' : 'text-gray-700 hover:bg-[#007DFC] hover:text-white' }}">
                        Journal
                    </a>

                    <a href="{{ route('reminder') }}"
                        class="block px-6 py-3 transition-colors {{ request()->routeIs('reminder') ? 'bg-[#007DFC] text-white' : 'text-gray-700 hover:bg-[#007DFC] hover:text-white' }}">
                        Reminder
                    </a>

                    <a href="{{ route('profile') }}"
                        class="block px-6 py-3 transition-colors {{ request()->routeIs('profile') ? 'bg-[#007DFC] text-white' : 'text-gray-700 hover:bg-[#007DFC] hover:text-white' }}">
                        Profile
                    </a>
                </nav>
            </div>

            <div class="p-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-gradient-to-r font-bold mb-10 from-[#ff4b4b] to-[#ff7373] text-white px-10 py-3 rounded-lg shadow hover:opacity-90 transition">
                        Logout
                    </button>
                </form>
            </div>

        </aside>

        <main class="flex-1 p-8 h-screen overflow-y-auto">
            {{ $slot }}
        </main>

    </div>

</body>

</html>
