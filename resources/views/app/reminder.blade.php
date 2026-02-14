<x-layout>
    <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Reminder</h1>

        <div class="space-y-8">
            @forelse ($reminders as $reminder)
                <div class="bg-white p-6 rounded-lg shadow">

                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        {{ $reminder->dayText }}, {{ $reminder->dayNumber }} {{ $reminder->month }}
                        {{ $reminder->year }}
                    </h2>

                    <div class="space-y-3">

                        {{-- 1. SLEEP MESSAGE --}}
                        @if (!empty($reminder->sleep_message))
                            <div
                                class="p-4 rounded-lg {{ strtolower($reminder->sleep_status) === 'good' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $reminder->sleep_message }}
                            </div>
                        @endif

                        {{-- 2. EAT MESSAGE --}}
                        @if (!empty($reminder->eat_message))
                            <div
                                class="p-4 rounded-lg {{ strtolower($reminder->eat_status) === 'good' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $reminder->eat_message }}
                            </div>
                        @endif

                        {{-- 3. SCREEN TIME MESSAGE --}}
                        @if (!empty($reminder->screen_time_message))
                            <div
                                class="p-4 rounded-lg {{ strtolower($reminder->screen_time_status) === 'good' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $reminder->screen_time_message }}
                            </div>
                        @endif

                    </div>
                </div>
                <br>

            @empty
                <div class="text-center text-gray-500 mt-12">
                    No reminders yet. Complete your daily health data in the Dashboard to see reminders here!
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
