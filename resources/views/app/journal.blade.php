<x-layout>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div x-data="{
        showModal: false,
        isEditing: false,
        formData: {
            id: null,
            mood: 'happy',
            title: '',
            description: ''
        },
        moodOptions: [
            { value: 'very_happy', label: 'I\'m Very Happy!', emoji: '😄' },
            { value: 'happy', label: 'Happy', emoji: '😊' },
            { value: 'neutral', label: 'Neutral', emoji: '😐' },
            { value: 'sad', label: 'Not So Good..', emoji: '😢' },
            { value: 'angry', label: 'Angry', emoji: '😠' },
        ],
        {{-- Helper Function for Get Emoji --}}
        getMoodEmoji(emojiValue) {
            let found = this.moodOptions.find(opt => opt.value === emojiValue);

            return found ? found.emoji : '😊';
        },

        {{-- Helper URL Form --}}
        getFormAction() {
            let baseUrl = '{{ url('app/journal') }}';
            return this.isEditing ? baseUrl + '/' + this.formData.id : '{{ route('journal.create') }}';
        },
        resetForm() {
            this.formData = { id: null, mood: 'happy', title: '', description: '' };
            this.isEditing = false;
        }
    }">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Journal</h1>

            <button @click="resetForm(); showModal = true"
                class="bg-gradient-to-r font-bold mr-2 from-[#007DFC] to-[#00C4FF] text-white px-5 py-2 rounded-lg shadow hover:opacity-90 transition">
                + Add
            </button>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" id="reminderMessage">
                {{ session('success') }}
            </div>

            <script>
                let reminderMessage = document.getElementById('reminderMessage');
                setTimeout(() => {
                    reminderMessage.style.display = 'none';
                }, 3500);
            </script>
        @endif

        {{-- Contents Journal --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($journals as $journal)
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                    <p class="text-gray-500 mb-2">{{ date('l', strtotime($journal->date)) }},
                        {{ date('d', strtotime($journal->date)) }} {{ date('F', strtotime($journal->date)) }}
                        {{ date('Y', strtotime($journal->date)) }} </p>
                    <div class="text-4xl mb-2" x-text="getMoodEmoji('{{ $journal->mood }}')"></div>
                    <h3 class="text-xl font-bold text-gray-800"> {{ $journal->title }} </h3>
                    <p class="text-gray-600">{{ $journal->description }}</p>
                    <button
                        @click="
                            isEditing = true;
                            showModal = true;
                            formData = {
                                id: '{{ $journal->id }}',
                                mood: '{{ $journal->mood }}',
                                title: '{{ addslashes($journal->title) }}',
                                description: '{{ addslashes($journal->description) }}'
                            }
                        "
                        class="text-[#007DFC] font-semibold hover:underline text-right block mt-4">
                        Edit
                    </button>
                </div>
            @empty
                <div class="text-gray-500 mt-12">
                    No Journal yet. Please add your Journal first!
                </div>
            @endforelse
        </div>

        {{-- Journal Modal --}}
        <div x-show="showModal" x-transition.opacity
            class="fixed inset-0 bg-black/30 backdrop-blur-md flex items-center justify-center p-4 z-50"
            style="display: none;">

            <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                @click.away="showModal = false"
                class="bg-white rounded-xl p-6 shadow-xl bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF] w-full max-w-lg">
                <h2 class="text-2xl font-bold mb-4" x-text="isEditing ? 'Edit Journal' : 'Create Note'"></h2>

                <form :action="getFormAction()" method="POST" class="space-y-4">
                    @csrf

                    <template x-if="isEditing">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    {{-- 1. MOOD SELECTOR --}}
                    <div>
                        <label class="block text-gray-700 mb-2">Mood</label>
                        <input type="hidden" name="mood" x-model="formData.mood">

                        <div class="grid grid-cols-5 gap-2">
                            <template x-for="option in moodOptions" :key="option.value">
                                <button type="button" @click="formData.mood = option.value"
                                    class="p-2 rounded-lg border-2 transition-colors flex flex-col items-center justify-center h-20"
                                    :class="formData.mood === option.value ? 'border-[#007DFC] bg-blue-50' :
                                        'border-gray-300 hover:border-gray-400'">

                                    <div class="text-2xl transition-transform duration-300"
                                        :class="{
                                            'scale-125 animate-bounce': formData.mood === option.value && option
                                                .value === 'very_happy',
                                            'scale-125': formData.mood === option.value
                                        }"
                                        x-text="option.emoji">
                                    </div>
                                    <div class="text-[9px] mt-1 text-center font-semibold" x-text="option.label"></div>
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- 2. TITLE --}}
                    <div>
                        <label class="block text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" x-model="formData.title"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]"
                            placeholder="Enter a title..." required>
                    </div>

                    {{-- 3. DESCRIPTION --}}
                    <div>
                        <label class="block text-gray-700 mb-2">Description</label>
                        <textarea name="description" x-model="formData.description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]"
                            placeholder="Describe your mood..."></textarea>
                    </div>

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
