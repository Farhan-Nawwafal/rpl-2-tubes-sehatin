<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Sehatin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#fffafa]">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <h1 class="text-4xl font-bold text-center mb-8">
                Welcome to <span class="text-[#007DFC]">Sehatin</span>!
            </h1>

            <form action="{{ route('register.create') }}" method="POST" class="space-y-4">
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

                <div>
                    <label for="username" class="block text-gray-700 mb-2">Username:</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC] @error('username') border-red-500 @enderror"
                        required />

                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-gray-700 mb-2">
                        Email:
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC] @error('email') border-red-500 @enderror"
                        required />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="age" class="block text-gray-700 mb-2">
                        Age:
                    </label>
                    <input type="number" name="age" id="age" value="{{ old('age') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC] @error('age') border-red-500 @enderror"
                        required />
                </div>

                <div>
                    <label for="sex" class="block text-gray-700 mb-2">
                        Sex:
                    </label>
                    <select name="sex" id="sex"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC] bg-white"
                        required>
                        <option value="" disabled {{ old('sex') ? '' : 'selected' }}>Select your Sex:</option>
                        <option value="L" {{ old('sex') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="W" {{ old('sex') == 'W' ? 'selected' : '' }}>Wanita</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 mb-2">
                        Password:
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC] @error('password') border-red-500 @enderror"
                        required />
                </div>

                <button type="submit"
                    class="w-full bg-[#007DFC] text-white py-2 rounded-lg hover:bg-[#0066cc] transition-colors">
                    Register
                </button>
            </form>

            <p class="text-center mt-6 text-gray-600">
                Have an account?
                <a href="{{ route('login') }}" class="text-[#007DFC] hover:underline">
                    Login
                </a>
            </p>
        </div>
    </div>
</body>

</html>
