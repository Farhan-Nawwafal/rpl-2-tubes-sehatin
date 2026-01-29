<x-layout>
    {{-- Import Alpine.js untuk interaksi Modal & State (Pengganti useState React) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- <div x-data="{
        showModal: false,
        isEditing: false,
        formData: {
            id: null,
            mood: 'happy',
            title: '',
            description: ''
        },
        // Konfigurasi Mood (Sama seperti array di React)
        moodOptions: [
            { value: 'very_happy', label: 'I\'m Very Happy!', emoji: '😄' },
            { value: 'happy', label: 'Happy', emoji: '😊' },
            { value: 'neutral', label: 'Neutral', emoji: '😐' },
            { value: 'sad', label: 'Not So Good..', emoji: '😢' },
            { value: 'angry', label: 'Angry', emoji: '😠' },
        ],
        // Helper untuk reset form
        resetForm() {
            this.formData = { id: null, mood: 'happy', title: '', description: '' };
            this.isEditing = false;
        },
        // Helper untuk membuka modal Edit
        editJournal(journal) {
            this.formData = {
                id: journal.id,
                mood: journal.mood,
                title: journal.title,
                description: journal.description
            };
            this.isEditing = true;
            this.showModal = true;
        },
        // Helper Dynamic Action URL untuk Form
        getFormAction() {
            return this.isEditing ?
                '{{ url('app/journal') }}/' + this.formData.id :
                '{{ route('journal.store') }}';
        }
    }"> --}}

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Journal</h1>

        {{-- Tombol Add --}}
        <button @click="resetForm(); showModal = true"
            class="bg-gradient-to-r font-bold mr-2 from-[#007DFC] to-[#00C4FF] text-white px-5 py-2 rounded-lg shadow hover:opacity-90 transition">
            + Add
        </button>
    </div>

    {{-- FLASH MESSAGES --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- JOURNAL GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($journals as $journal)
            {{-- Logic Mapping Emoji di PHP Blade --}}
            {{-- @php
                $emojis = [
                    'very_happy' => ['😄', 'I\'m Very Happy!'],
                    'happy' => ['😊', 'Happy'],
                    'neutral' => ['😐', 'Neutral'],
                    'sad' => ['😢', 'Not So Good..'],
                    'angry' => ['😠', 'Angry'],
                ];
                // Fallback ke happy jika data mood tidak valid
                $moodData = $emojis[$journal->mood] ?? $emojis['happy'];
            @endphp --}}

            <div class="bg-white p-6 rounded-lg shadow">
                <p class="block text-gray-700 mb-2">
                    {{-- Format Tanggal: Tuesday, 28 January 2026 --}}
                    {{-- {{ \Carbon\Carbon::parse($journal->created_at)->format('l, d F Y') }} --}}
                    Date
                </p>
                {{-- <div class="text-4xl mb-2">{{ $moodData[0] }}</div> --}}
                <div class="text-4xl mb-2">Mood 0</div>
                <div class="text-lg font-semibold text-[#007DFC] mb-2">
                    {{-- {{ $moodData[1] }} --}}
                    Mood 1
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{-- {{ $journal->title }} --}}
                    Judul
                </h3>
                <p class="text-gray-600 mb-4 line-clamp-3">
                    {{-- {{ $journal->description }} --}}
                    Desc
                </p>

                {{-- Tombol Edit: Kirim data JSON ke Alpine --}}
                <button @click="editJournal({{ $journal }})" class="text-[#007DFC] hover:underline">
                    Edit
                </button>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 mt-12">
                No journal entries yet. Click the Add button to create one!
            </div>
        @endforelse
    </div>

    {{-- MODAL OVERLAY --}}
    <div x-show="showModal" x-transition.opacity
        class="fixed inset-0 bg-black/30 backdrop-blur-md flex items-center justify-center p-4 z-50"
        style="display: none;" {{-- Mencegah flicker saat load --}}>
        {{-- MODAL CONTENT --}}
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            @click.away="showModal = false"
            class="bg-white rounded-xl p-6 shadow-mb bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF] w-full max-w-lg">
            <h2 class="text-2xl font-bold mb-4" x-text="isEditing ? 'Edit Journal' : 'Create Note'"></h2>

            {{-- FORM --}}
            {{-- Action URL berubah dinamis tergantung mode Edit/Create --}}
            <form :action="getFormAction()" method="POST" class="space-y-4">
                @csrf

                {{-- Method Spoofing untuk PUT request saat Edit --}}
                <template x-if="isEditing">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                {{-- 1. MOOD SELECTOR --}}
                <div>
                    <label class="block text-gray-700 mb-2">Mood</label>
                    {{-- Input Hidden untuk kirim data mood ke server --}}
                    <input type="hidden" name="mood" x-model="formData.mood">

                    <div class="grid grid-cols-5 gap-2">
                        <template x-for="option in moodOptions" :key="option.value">
                            <button type="button" @click="formData.mood = option.value"
                                class="p-3 rounded-lg border-2 transition-colors flex flex-col items-center justify-center h-24"
                                :class="formData.mood === option.value ?
                                    'border-[#007DFC] bg-blue-50' :
                                    'border-gray-300 hover:border-gray-400'">
                                <div class="text-2xl transition-transform duration-300"
                                    :class="{
                                        'scale-125 animate-bounce': formData.mood === option.value && option
                                            .value === 'very_happy',
                                        'scale-125 animate-pulse': formData.mood === option.value && option
                                            .value === 'happy',
                                        'scale-110 opacity-90': formData.mood === option.value && option
                                            .value === 'neutral',
                                        'scale-125 animate-wiggle': formData.mood === option.value && option
                                            .value === 'sad', // wiggle butuh custom css
                                        'scale-125 animate-ping': formData.mood === option.value && option
                                            .value === 'angry', // ganti shake ke ping bawaan tailwind atau custom
                                        'scale-100': formData.mood !== option.value
                                    }"
                                    x-text="option.emoji">
                                </div>
                                {{-- Label Emoji (Kecil) --}}
                                <div class="text-[10px] mt-1 text-center leading-tight" x-text="option.label"></div>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- 2. TITLE INPUT --}}
                <div>
                    <label class="block text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" x-model="formData.title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]"
                        placeholder="Enter a title..." required>
                </div>

                {{-- 3. DESCRIPTION INPUT --}}
                <div>
                    <label class="block text-gray-700 mb-2">Description</label>
                    <textarea name="description" x-model="formData.description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]"
                        placeholder="Describe your mood..."></textarea>
                </div>

                {{-- BUTTONS --}}
                <div class="flex gap-4 mt-6">
                    <button type="button" @click="showModal = false"
                        class="flex-1 bg-gray-300 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-400 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r font-bold from-[#007DFC] to-[#00C4FF] text-white px-4 py-3 rounded-lg shadow hover:opacity-90 transition-colors disabled:opacity-50"
                        :disabled="!formData.title">
                        <span x-text="isEditing ? 'Save Changes' : 'Create Note'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    </div>
</x-layout>
