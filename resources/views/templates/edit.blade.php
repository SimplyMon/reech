<x-layouts.layout>
    <x-slot:title>Edit Template: {{ $template->name }}</x-slot:title>

    <div class=" ml-64 min-h-screen">
        <div class="mx-auto space-y-6">

            <div class="mb-6">
                <a href="{{ route('templates.index') }}"
                    class="text-gray-500 hover:text-[#B02A30] text-sm flex items-center font-medium">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to Templates
                </a>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight mt-2">Editing Template: {{ $template->name }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">Update the subject, body, and client statuses targeted by this
                    template.</p>
            </div>

            <form method="POST" action="{{ route('templates.update', $template->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-8 space-y-8">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-1">
                            <x-input-label for="name" :value="__('Template Name *')" class="!text-gray-700 text-sm" />
                            <x-text-input id="name"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="name" :value="old('name', $template->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="lg:col-span-2">
                            <x-input-label for="subject" :value="__('Email Subject *')" class="!text-gray-700 text-sm" />
                            <x-text-input id="subject"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="subject" :value="old('subject', $template->subject)" required />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <h3
                            class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-3 pb-2 border-b border-gray-100">
                            <i class="fa-solid fa-users-viewfinder mr-2 text-gray-400"></i> Client Targeting
                        </h3>
                        <x-input-label for="target_status_select" :value="__('Target Client Statuses (Required) *')" class="!text-gray-700 text-sm" />

                        <select id="target_status_select" name="target_status[]" multiple required
                            class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">

                            @foreach ($statuses as $status)
                                @php
                                    // Calculate client count
                                    $count = \App\Models\Client::where('user_id', Auth::id())
                                        ->where('client_status', $status)
                                        ->count();

                                    $oldStatuses = is_array(old('target_status')) ? old('target_status') : [];
                                    $currentStatuses = is_array($template->target_status)
                                        ? $template->target_status
                                        : [];
                                    $selectedArray = empty($oldStatuses) ? $currentStatuses : $oldStatuses;
                                    $isSelected = in_array($status, $selectedArray);
                                @endphp
                                <option value="{{ $status }}" {{ $isSelected ? 'selected' : '' }}>
                                    {{ $status }} ({{ $count }} clients)
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Select one or more statuses. Only clients matching these
                            statuses will receive bulk emails.</p>
                        <x-input-error :messages="$errors->get('target_status')" class="mt-2" />
                    </div>

                    <div>
                        <h3
                            class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-3 pb-2 border-b border-gray-100">
                            <i class="fa-solid fa-envelope mr-2 text-gray-400"></i> Message Content
                        </h3>
                        <x-input-label for="body" :value="__('Message Body *')" class="!text-gray-700 text-sm" />
                        <textarea id="body" name="body" rows="12" required
                            class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">{{ old('body', $template->body) }}</textarea>

                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit"
                            class="px-8 py-2.5 bg-[#B02A30] hover:bg-[#98242A] text-white font-bold text-sm rounded-lg shadow-md transition-all focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                            <i class="fa-solid fa-save mr-2"></i> Save Changes
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
                    plugins: ['remove_button',
                        'dropdown_input'
                    ],
                    maxItems: null,
                    hideSelected: true,
                });
            }
        });
    </script>
</x-layouts.layout>
