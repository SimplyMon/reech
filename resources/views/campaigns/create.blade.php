<x-layouts.layout>
    <x-slot:title>Setup New Campaign</x-slot:title>

    <div class="py-10 ml-64 min-h-screen bg-gray-50/50 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto space-y-6">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Setup New Campaign (Simple Mode)</h1>

            <form method="POST" action="{{ route('campaigns.store') }}" class="space-y-6">
                @csrf

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6 space-y-6">
                    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Campaign Overview</h3>

                    <div>
                        <x-input-label for="name" :value="__('Campaign Name *')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="type" name="type" required
                                class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm">
                                <option value="email_only"
                                    {{ old('type', 'email_only') == 'email_only' ? 'selected' : '' }}>Email Only
                                </option>
                                <option value="email_sms" {{ old('type') == 'email_sms' ? 'selected' : '' }} disabled>
                                    Email & SMS (Coming Soon)</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Initial Status')" />
                            <select id="status" name="status" required
                                class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm">
                                <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft
                                </option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="paused" {{ old('status') == 'paused' ? 'selected' : '' }}>Paused</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="3"
                            class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6 space-y-6">
                    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">First Communication Step</h3>

                    <div>
                        <x-input-label for="step_name" :value="__('Step Name *')" />
                        <x-text-input id="step_name" name="step_name" placeholder="e.g. Initial Outreach"
                            :value="old('step_name')" required class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('step_name')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="email_template_id" :value="__('Email Template *')" />
                            <select id="email_template_id" name="email_template_id" required
                                class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm">
                                <option value="">Select a template...</option>
                                @foreach ($templates as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ old('email_template_id') == $id ? 'selected' : '' }}>{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('email_template_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="preferred_property_type" :value="__('Filter Property Type (Optional)')" />
                            <select id="preferred_property_type" name="preferred_property_type"
                                class="block mt-1 w-full border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] rounded-md shadow-sm">
                                <option value="">(No specific property type)</option>
                                @foreach ($propertyTypes as $type)
                                    <option value="{{ $type }}"
                                        {{ old('preferred_property_type') == $type ? 'selected' : '' }}>
                                        {{ $type }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('preferred_property_type')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-8 py-3 bg-[#B02A30] hover:bg-[#98242A] text-white font-bold rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                        Save Campaign
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>
