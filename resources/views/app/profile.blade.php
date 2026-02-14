<x-layout>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <div x-data="{
        showChangePassword: false
    }" class="max-w-2xl">

        <template x-if="showChangePassword">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Change Password</h1>

                <div class="bg-white p-6 rounded-lg shadow bg-gradient-to-b from-[#E1F1FE] via-[#FFFFF] to-[#FFFF]">

                    <form action="#" method="POST" class="space-y-4">

                        <div>
                            <label class="block text-gray-700 mb-2">Old Password</label>
                            <input type="password" name="old_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]" />
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">New Password</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]" />
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#007DFC]" />
                        </div>

                        <div class="flex gap-4 mt-6">
                            <button type="button" @click="showChangePassword = false"
                                class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                            <button type="button"
                                class="flex-1 bg-gradient-to-r font-bold from-[#007DFC] to-[#00C4FF] text-white px-5 py-2 rounded-lg shadow hover:opacity-90 transition">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        {{-- PROFILE INFO CARD --}}
        <template x-if="!showChangePassword">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Profile</h1>

                <div class="flex justify-center items-center">
                    <div class="max-w-3xl w-full bg-white rounded-2xl shadow-lg overflow-hidden">

                        <div class="w-full h-48 bg-gradient-to-b from-[#E1F1FE] via-[#FAFCFF] to-[#FFFF]"></div>

                        <div class="flex flex-col items-center mb-8 -mt-12">
                            <div
                                class="w-24 h-24 bg-gradient-to-tr from-[#007DFC] to-[#B3FFEA] rounded-full flex items-center justify-center text-white text-3xl font-bold border-4 border-white shadow-md">
                                {{ strtoupper(substr($username, 0, 1)) }}
                            </div>

                            <p
                                class="mt-3 text-gray-700 font-bold mb-1 text-xl bg-gradient-to-r from-[#002B56] to-[#004E9D] bg-clip-text">
                                {{ $username }}
                            </p>
                            <p class="text-gray-500 text-sm">{{ $email }}</p>
                        </div>

                        <div class="flex flex-col text-gray-700 space-y-4 items-start pl-10 pr-10">
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Umur</label>
                                <div class="font-medium">
                                    {{ $age ?? 'Not set' }} Tahun
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Jenis Kelamin</label>
                                <div class="font-medium">
                                    @if ($sex == 'L')
                                        Laki-Laki
                                    @elseif($sex == 'W')
                                        Wanita
                                    @else
                                        Not set
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="border-t border-gray-200 my-4 mx-6" />

                        <div class="flex justify-end gap-4 mt-6 mb-10 mr-8">
                            <button @click="showChangePassword = true"
                                class="bg-gradient-to-r font-bold from-[#007DFC] to-[#00C4FF] text-white px-5 py-2 rounded-lg shadow hover:opacity-90 transition">
                                Change Password
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </template>

    </div>
</x-layout>
