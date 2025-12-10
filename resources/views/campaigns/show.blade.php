<x-layouts.layout>
    <x-slot:title>Campaign Details: {{ $campaign->name }}</x-slot:title>

    <div class="ml-64 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="mb-6 flex justify-between items-center">
                <div>
                    <a href="{{ route('campaigns.index') }}"
                        class="text-gray-500 hover:text-[#B02A30] text-sm flex items-center font-medium">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Back to Campaigns List
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900 mt-2">
                        Campaign: {{ $campaign->name }}
                    </h1>
                </div>
                <a href="{{ route('campaigns.edit', $campaign->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold rounded-lg transition-all">
                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Campaign
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6 space-y-6">
                <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Campaign Overview</h3>

                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-base text-gray-900">
                            @php
                                $class = match ($campaign->status) {
                                    'active' => 'bg-green-100 text-green-800 ring-green-600/20',
                                    'paused' => 'bg-yellow-100 text-yellow-800 ring-yellow-600/20',
                                    'completed' => 'bg-gray-100 text-gray-600 ring-gray-500/10',
                                    default => 'bg-blue-100 text-blue-800 ring-blue-700/10',
                                };
                            @endphp
                            <span
                                class="inline-flex items-center rounded-md px-2 py-0.5 text-sm font-medium ring-1 ring-inset {{ $class }}">
                                {{ ucfirst($campaign->status) }}
                            </span>
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Type</dt>
                        <dd class="mt-1 text-base text-gray-900">
                            {{ ucfirst(str_replace('_', ' ', $campaign->type)) }}
                        </dd>
                    </div>

                    <div class="md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-base text-gray-900">
                            {{ $campaign->description ?? 'N/A' }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6 space-y-6">
                <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">First Communication Step</h3>

                <dl class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-4">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Step Name</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $campaign->step_name }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Email Template</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $campaign->template->name ?? 'Template Not Found' }}
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Property Type Filter</dt>
                        <dd class="mt-1 text-base text-gray-900">
                            {{ $campaign->preferred_property_type ?? 'Any (No Filter)' }}
                        </dd>
                    </div>
                </dl>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert 2 (Swal) is not loaded.');
                return;
            }

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
