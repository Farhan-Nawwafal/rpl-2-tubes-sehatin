<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heylth - Ayo Hidup Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f3f3f3]">

    @php
        $features = [
            [
                'title' => 'Eat and Sleep Tracker',
                'description' => 'Pantau pola tidur dan makan Anda setiap hari dengan mudah',
            ],
            [
                'title' => 'Daily Diary',
                'description' => 'Tulis catatan mood harian Anda dan track perubahan emosi',
            ],
            [
                'title' => 'Screen-time Recommendation',
                'description' => 'Dapatkan rekomendasi waktu layar yang sehat untuk mata Anda',
            ],
            [
                'title' => 'Personalized Suggestion',
                'description' => 'Terima saran kesehatan yang dipersonalisasi untuk gaya hidup Anda',
            ],
            [
                'title' => 'Visual Data',
                'description' => 'Lihat statistik kesehatan Anda dalam visualisasi yang menarik',
            ],
        ];
    @endphp

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="text-2xl font-bold">
                    <span class="text-[#007DFC]">Heylth</span>
                </div>

                <div class="hidden md:flex space-x-8">
                    <a href="#hero" class="text-gray-700 hover:text-[#007DFC] transition-colors">
                        Home
                    </a>
                    <a href="#about" class="text-gray-700 hover:text-[#007DFC] transition-colors">
                        About
                    </a>
                    <a href="#features" class="text-gray-700 hover:text-[#007DFC] transition-colors">
                        Features
                    </a>
                </div>

                {{-- Auth Buttons --}}
                <div class="flex gap-3">
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 bg-white border-2 border-[#007DFC] text-[#007DFC] rounded-lg hover:bg-[#007DFC] hover:text-white transition-colors font-semibold">
                        Register
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 bg-[#007DFC] text-white rounded-lg hover:bg-[#0066cc] transition-colors font-semibold">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section id="hero" class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-16 md:pt-0">
        <div class="max-w-7xl mx-auto w-full">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                {{-- Text Content --}}
                <div class="order-2 md:order-1">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6">
                        Ayo hidup sehat!
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Pantau pola hidupmu dengan Heylth, aplikasi yang membantu kamu menjaga kesehatan,
                        mencatat aktivitas harian, dan memberikan rekomendasi gaya hidup yang lebih baik.
                    </p>
                    <a href="{{ route('register') }}"
                        class="inline-block px-8 py-4 bg-[#007DFC] text-white rounded-lg hover:bg-[#0066cc] transition-colors font-semibold text-lg">
                        Daftar Sekarang
                    </a>
                </div>

                {{-- Image Content --}}
                <div class="flex justify-center order-1 md:order-2">
                    {{-- Pastikan gambar sudah ada di public/img/heylth-icon.png --}}
                    {{-- Jika belum ada gambar, bisa pakai placeholder sementara --}}
                    <img src="{{ asset('assets/heylth-icon.png') }}" alt="Heylth Hero"
                        class="max-w-xs md:max-w-md w-full object-contain"
                        onerror="this.src='https://placehold.co/400x400?text=Heylth+Icon'">
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT SECTION --}}
    <section id="about" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-8">
                Tentang <span class="text-[#007DFC]">Heylth</span>
            </h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                Heylth adalah aplikasi untuk memantau pola hidup anda mulai dari jam tidur, berapa kali makan dalam
                sehari, screen time dan mengirimkan saran kepada kalian berdasarkan pola hidup anda. Dengan fitur
                tracking yang lengkap dan rekomendasi yang dipersonalisasi, Heylth membantu Anda mencapai gaya hidup
                yang lebih sehat dan seimbang.
            </p>
        </div>
    </section>

    {{-- FEATURES SECTION --}}
    <section id="features" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-bold text-gray-800 text-center mb-16">
                Fitur <span class="text-[#007DFC]">Heylth</span>
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($features as $index => $feature)
                    <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-[#007DFC] rounded-full flex items-center justify-center mb-6">
                            <span class="text-white font-bold">{{ $index + 1 }}</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">
                            {{ $feature['title'] }}
                        </h3>
                        <p class="text-gray-600">
                            {{ $feature['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-800 text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold mb-2">
                        <span class="text-[#007DFC]">Heylth</span>
                    </h3>
                    <p class="text-gray-400">
                        Aplikasi untuk gaya hidup yang lebih sehat
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>
                            <a href="#hero" class="hover:text-[#007DFC] transition-colors">Home</a>
                        </li>
                        <li>
                            <a href="#about" class="hover:text-[#007DFC] transition-colors">About</a>
                        </li>
                        <li>
                            <a href="#features" class="hover:text-[#007DFC] transition-colors">Features</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@heylth.com</li>
                        <li>Phone: +62 812-3456-7890</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8">
                <p class="text-center text-gray-400">
                    &copy; 2024 Heylth. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
