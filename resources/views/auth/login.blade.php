<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Heylth</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fffafa]">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">

            {{-- Header --}}
            <h1 class="text-4xl font-bold text-center mb-8">
                Welcome Back to <span class="text-[#007DFC]">Heylth</span>!
            </h1>

            {{-- Form Login --}}
            <form action="{{ route('login.validate') }}" method="POST" class="space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-gray-700 mb-2">
                        Username
                    </label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]"
                        required autofocus />
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-gray-700 mb-2">
                        Password
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]"
                        required />
                </div>

                {{-- Button Login --}}
                <button type="submit"
                    class="w-full bg-[#007DFC] text-white py-2 rounded-lg hover:bg-[#0066cc] transition-colors">
                    Login
                </button>
            </form>

            {{-- Footer Link ke Register --}}
            <p class="text-center mt-6 text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#007DFC] hover:underline">
                    Register
                </a>
            </p>
        </div>
    </div>
</body>

</html>
