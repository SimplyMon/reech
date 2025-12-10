<x-layouts.layout>
    <x-slot:title>Create Email Template</x-slot:title>

    <div class="py-10 ml-64">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('templates.index') }}"
                    class="text-gray-500 hover:text-[#B02A30] text-sm flex items-center font-medium">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Back to Templates
                </a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Create New Template</h1>
            </div>

            <form method="POST" action="{{ route('templates.store') }}" class="space-y-6">
                @csrf

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6 space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" :value="__('Template Name *')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="subject" :value="__('Email Subject *')" />
                            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject"
                                :value="old('subject')" required />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="target_status_select" :value="__('Target Client Statuses (Required) *')" />

                        <select id="target_status_select" name="target_status[]" multiple required
                            class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm">

                            @foreach ($statuses as $status)
                                @php
                                    $count = \App\Models\Client::where('user_id', Auth::id())
                                        ->where('client_status', $status)
                                        ->count();
                                    $oldStatuses = is_array(old('target_status')) ? old('target_status') : [];
                                    $isSelected = in_array($status, $oldStatuses);
                                @endphp
                                <option value="{{ $status }}" {{ $isSelected ? 'selected' : '' }}>
                                    {{ $status }} ({{ $count }})
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Select one or more statuses. Selected statuses will appear
                            as tags below.</p>
                        <x-input-error :messages="$errors->get('target_status')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="body" :value="__('Message Body *')" />
                        <textarea id="body" name="body" rows="10" required
                            class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm">{{ old('body') }}</textarea>
                        {{-- <p class="text-xs text-gray-500 mt-1">
                            Use <code>@{{ $client - > first_name }}</code> for placeholders.
                        </p> --}}

                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="px-8 py-2.5 bg-[#B02A30] hover:bg-[#98242A] text-white font-bold text-sm rounded-lg shadow-md transition-all">
                            <i class="fa-solid fa-save mr-2"></i> Save Template
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof TomSelect !== 'undefined') {
                new TomSelect("#target_status_select", {
                    plugins: ['remove_button'],
                    maxItems: null,
                    hideSelected: true,
                });
            }
        });

        function previewClientImage(event) {
            const input = event.target;
            const preview = document.getElementById('client-preview');
            const icon = document.getElementById('client-icon');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    icon.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layouts.layout>
