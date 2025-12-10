<x-layouts.layout>
    <x-slot:title>Edit Campaign: {{ $campaign->name }}</x-slot:title>

    <div class=" ml-64 min-h-screen bg-gray-50/50 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-8">

            <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                <div>
                    <a href="{{ route('campaigns.show', $campaign->id) }}"
                        class="text-sm text-gray-500 hover:text-[#B02A30] transition-colors flex items-center">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Campaign View
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900 mt-2">
                        Editing: {{ $campaign->name }}
                    </h1>
                </div>
            </div>

            <form id="editCampaignForm" method="POST" action="{{ route('campaigns.update', $campaign->id) }}"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6 space-y-6">
                    <h3 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Campaign Details
                    </h3>

                    <div>
                        <x-input-label for="name" :value="__('Campaign Name *')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $campaign->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="type" name="type" required
                                class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm text-sm">
                                <option value="email_only"
                                    {{ old('type', $campaign->type) == 'email_only' ? 'selected' : '' }}>Email Only
                                </option>
                                <option value="email_sms"
                                    {{ old('type', $campaign->type) == 'email_sms' ? 'selected' : '' }} disabled>Email &
                                    SMS (Coming Soon)</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status *')" />
                            <select id="status" name="status" required
                                class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm text-sm">
                                @foreach (['draft', 'active', 'paused', 'completed'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status', $campaign->status) == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="3"
                            class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm text-sm">{{ old('description', $campaign->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6 space-y-6">
                    <h3 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Communication
                        Step (Single Action)</h3>

                    <div>
                        <x-input-label for="step_name" :value="__('Step Name *')" />
                        <x-text-input id="step_name" name="step_name" placeholder="e.g. Initial Outreach"
                            :value="old('step_name', $campaign->step_name)" required class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('step_name')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="email_template_id" :value="__('Email Template *')" />
                            <select id="email_template_id" name="email_template_id" required
                                class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm text-sm">
                                <option value="">Select a template...</option>
                                @foreach ($templates as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ old('email_template_id', $campaign->email_template_id) == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('email_template_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="preferred_property_type" :value="__('Filter Property Type (Optional)')" />
                            <select id="preferred_property_type" name="preferred_property_type"
                                class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm text-sm">
                                <option value="">(No specific property type)</option>
                                @foreach ($propertyTypes as $type)
                                    <option value="{{ $type }}"
                                        {{ old('preferred_property_type', $campaign->preferred_property_type) == $type ? 'selected' : '' }}>
                                        {{ $type }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('preferred_property_type')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="button" id="confirmSaveButton"
                        class="px-8 py-3 bg-[#B02A30] hover:bg-[#98242A] text-white font-bold rounded-lg shadow-xl transition transform hover:-translate-y-1 focus:ring-4 focus:ring-offset-2 focus:ring-[#B02A30]">
                        <i class="fa-solid fa-save mr-2"></i> Save Campaign Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert 2 (Swal) is not loaded.');
                return;
            }

            const form = document.getElementById('editCampaignForm');
            const saveButton = document.getElementById('confirmSaveButton');

            saveButton.addEventListener('click', function(e) {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                Swal.fire({
                    title: 'Confirm Changes',
                    text: "Are you sure you want to save the changes to this campaign?.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Save it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#B02A30',
                    cancelButtonColor: '#4b5563',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });


            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });

            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            @endif
            @if (session('error'))
                Toast.fire({
                    icon: 'error',
                    title: '{{ session('error') }}'
                });
            @endif
        });
    </script>
</x-layouts.layout>
