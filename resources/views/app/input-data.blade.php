<x-layout>
    <div class="max-w-3xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Input Data</h1>

        {{-- SUCCESS / ERROR MESSAGES --}}
        @if (session('success'))
            <div class="px-4 py-3 rounded mb-6 border bg-green-100 border-green-400 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="px-4 py-3 rounded mb-6 border bg-red-100 border-red-400 text-red-700">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-8">
            <div class="mb-6">
                <label class="text-xl font-semibold mb-4 flex items-center gap-2">
                    Select Date
                </label>
                <input type="date" id="globalDate" value="{{ date('Y-m-d') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]" />
            </div>

            {{-- Sleep Tracker Form --}}
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="date" class="hidden-date-input" value="{{ date('Y-m-d') }}">

                <div class="bg-white rounded-xl shadow-md p-8 bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]">
                    <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
                        <span class="p-2 bg-[#E6F0FF] rounded-full text-[#007DFC] shadow-sm">
                            {{-- Icon Moon SVG --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </span>
                        What Time Did You Sleep?
                    </h2>

                    <div class="space-y-4">
                        {{-- Sleep Start --}}
                        <div>
                            <label class="block text-gray-700 mb-2">Sleep Start</label>
                            <select name="sleep_start"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC] bg-[#FFFAFA] w-full md:w-auto">

                                @for ($i = 0; $i < 24; $i++)
                                    @php $hour = 23 - $i; @endphp
                                    <option value="{{ $hour }}">{{ sprintf('%02d', $hour) }}:00</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Sleep End --}}
                        <div>
                            <label class="block text-gray-700 mb-2">Sleep End</label>
                            <select name="sleep_end"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC] bg-[#FFFAFA] w-full md:w-auto">

                                @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}">{{ sprintf('%02d', $i) }}:00</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-8 bg-gradient-to-r font-bold from-[#007DFC] to-[#00C4FF] text-white px-8 py-3 rounded-lg shadow hover:opacity-90 transition">
                        Save
                    </button>
                </div>
            </form>

            {{-- Meals Tracker Form --}}
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="date" class="hidden-date-input" value="{{ date('Y-m-d') }}">

                <div class="bg-white rounded-xl shadow-md p-8 bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]">
                    <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
                        <span class="p-2 bg-[#E6F0FF] rounded-full text-[#007DFC] shadow-sm">
                            {{-- Icon Cutlery SVG --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>
                        Which Meals Did You Have?
                    </h2>

                    <div class="flex flex-wrap gap-3">
                        {{-- Breakfast --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="meal_type" value="Breakfast" class="peer hidden" required>
                            <span
                                class="inline-block px-6 py-2 rounded-lg bg-[#FFFAFA] text-gray-700 hover:bg-gray-200 peer-checked:bg-[#007DFC] peer-checked:text-white transition-colors">
                                Breakfast
                            </span>
                        </label>

                        {{-- Lunch --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="meal_type" value="Lunch" class="peer hidden">
                            <span
                                class="inline-block px-6 py-2 rounded-lg bg-[#FFFAFA] text-gray-700 hover:bg-gray-200 peer-checked:bg-[#007DFC] peer-checked:text-white transition-colors">
                                Lunch
                            </span>
                        </label>

                        {{-- Dinner --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="meal_type" value="Dinner" class="peer hidden">
                            <span
                                class="inline-block px-6 py-2 rounded-lg bg-[#FFFAFA] text-gray-700 hover:bg-gray-200 peer-checked:bg-[#007DFC] peer-checked:text-white transition-colors">
                                Dinner
                            </span>
                        </label>
                    </div>

                    <button type="submit"
                        class="mt-8 bg-gradient-to-r font-bold from-[#007DFC] to-[#00C4FF] text-white px-8 py-3 rounded-lg shadow hover:opacity-90 transition">
                        Save
                    </button>
                </div>
            </form>

            {{-- Screen Time Form --}}
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="date" class="hidden-date-input" value="{{ date('Y-m-d') }}">

                <div class="bg-white rounded-xl shadow-md p-8 bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]">
                    <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
                        <span class="p-2 bg-[#E6F0FF] rounded-full text-[#007DFC] shadow-sm">
                            {{-- Icon Clock SVG --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        How Many Hours Did You Spend on Screen?
                    </h2>

                    <div class="flex items-center gap-3">
                        <input type="number" name="duration" min="0" step="0.5"
                            class="w-32 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC] bg-[#FFFAFA]"
                            required />
                        <span class="text-gray-700">Hours</span>
                    </div>

                    <button type="submit"
                        class="mt-8 bg-gradient-to-r font-bold from-[#007DFC] to-[#00C4FF] text-white px-8 py-3 rounded-lg shadow hover:opacity-90 transition">
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- Script untuk sinkronisasi Tanggal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const globalDate = document.getElementById('globalDate');
            const hiddenInputs = document.querySelectorAll('.hidden-date-input');

            // Saat halaman load, isi hidden inputs dengan nilai awal
            hiddenInputs.forEach(input => input.value = globalDate.value);

            // Saat user ganti tanggal, update semua hidden input di form bawahnya
            globalDate.addEventListener('change', function() {
                hiddenInputs.forEach(input => input.value = this.value);
            });
        });
    </script>
</x-layout>
