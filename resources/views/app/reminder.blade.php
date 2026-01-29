<x-layout>
    {{--
        DUMMY DATA (STATIC)
        Ini simulasi data seolah-olah dikirim dari Backend.
        Nanti kalau Backend sudah siap, hapus blok @php ini dan pakai controller.
    --}}
    @php

    @endphp

    <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Reminder</h1>

        <div class="space-y-8">
            {{-- Loop data dummy di atas --}}
            @forelse ($reminders as $reminder)
                <div class="bg-white p-6 rounded-lg shadow">

                    {{-- Header Tanggal --}}
                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        {{ $reminder->dayText }}, {{ $reminder->dayNumber }} {{ $reminder->month }}
                        {{ $reminder->year }}
                    </h2>

                    <div class="space-y-3">

                        {{-- 1. SLEEP MESSAGE --}}
                        @if (!empty($reminder->sleepMessage))
                            <div
                                class="p-4 rounded-lg {{ strtolower($reminder->sleepStatus) === 'good' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $reminder->sleepMessage }}
                            </div>
                        @endif

                        {{-- 2. EAT MESSAGE --}}
                        @if (!empty($reminder->eatMessage))
                            <div
                                class="p-4 rounded-lg {{ strtolower($reminder->eatStatus) === 'good' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $reminder->eatMessage }}
                            </div>
                        @endif

                        {{-- 3. SCREEN TIME MESSAGE --}}
                        @if (!empty($reminder->screenTimeMessage))
                            <div
                                class="p-4 rounded-lg {{ strtolower($reminder->screenTimeStatus) === 'good' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $reminder->screenTimeMessage }}
                            </div>
                        @endif

                    </div>
                </div>

            @empty
                {{-- Tampilan kalau array dummy di atas kamu kosongin ($reminders = []) --}}
                <div class="text-center text-gray-500 mt-12">
                    No reminders yet. Complete your daily health data in the Dashboard to see reminders here!
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
