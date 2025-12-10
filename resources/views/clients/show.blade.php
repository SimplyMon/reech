<x-layouts.layout>
    <x-slot:title>Client Details: {{ $client->first_name }} {{ $client->last_name }}</x-slot:title>

    <div class="ml-0 lg:ml-64">

        <div class="w-full max-w-none">

            <div class="mb-6 flex justify-between items-center">
                <div>
                    <a href="{{ route('clients.index') }}"
                        class="text-gray-500 hover:text-[#B02A30] text-sm flex items-center">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Back to Clients
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900 mt-2">Client Details: {{ $client->first_name }}
                        {{ $client->last_name }}</h1>
                    <p class="text-sm text-gray-500 mt-1">ID: #{{ $client->id }} | Last Updated:
                        {{ $client->updated_at->format('M d, Y') }}</p>
                </div>

                <a href="{{ route('clients.edit', $client->id) }}"
                    class="bg-[#B02A30] hover:bg-[#98242A] text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Client
                </a>
            </div>

            <div class="space-y-6">

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Client
                        Overview</h3>
                    <div class="flex flex-col sm:flex-row items-start gap-8">

                        <div class="shrink-0">
                            <div
                                class="h-24 w-24 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border-2 border-gray-200">
                                @if ($client->profile_picture_path)
                                    <img src="{{ asset('storage/' . $client->profile_picture_path) }}"
                                        class="h-full w-full object-cover" alt="Client Profile Picture" />
                                @else
                                    <i class="fa-solid fa-user text-4xl text-gray-400"></i>
                                @endif
                            </div>
                        </div>

                        <div class="flex-1 grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Current Status</p>
                                @php
                                    $statusStyles = [
                                        'Active' => 'bg-green-50 text-green-700 ring-green-600/20',
                                        'Lead' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                                        'Closed' => 'bg-gray-50 text-gray-600 ring-gray-500/10',
                                        'Inactive' => 'bg-red-50 text-red-700 ring-red-600/10',
                                        'Prospect' => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20',
                                        'Buyer' => 'bg-teal-50 text-teal-700 ring-teal-600/20',
                                        'Seller' => 'bg-purple-50 text-purple-700 ring-purple-600/20',
                                    ];
                                    $style =
                                        $statusStyles[$client->client_status] ??
                                        'bg-gray-50 text-gray-600 ring-gray-500/10';
                                @endphp
                                <span
                                    class="mt-1 inline-flex items-center rounded-md px-3 py-1 text-sm font-medium ring-1 ring-inset {{ $style }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current mr-2 opacity-60"></span>
                                    {{ $client->client_status ?? 'N/A' }}
                                </span>
                            </div>

                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Last Updated</p>
                                <p class="text-sm text-gray-900 mt-1">{{ $client->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Personal
                        Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">First Name</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->first_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Middle Name</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->middle_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Last Name</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->last_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Date of Birth</p>
                            <p class="text-sm text-gray-900 mt-1">
                                {{ $client->date_of_birth ? \Carbon\Carbon::parse($client->date_of_birth)->format('M d, Y') : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Gender</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->gender ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Marital Status</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->marital_status ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Address &
                        Contact</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Email</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Phone Number</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->phone_number ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Occupation</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->occupation ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Neighborhood</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->neighborhood ?? 'N/A' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs font-semibold text-gray-500 uppercase">Location (City, State Zip)</p>
                            <p class="text-sm text-gray-900 mt-1">
                                {{ trim($client->city . ($client->city && $client->state ? ', ' : '') . $client->state . ($client->state && $client->zipcode ? ' ' : '') . $client->zipcode, ', ') ?: 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Real Estate
                        Preferences</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Budget Range</p>
                            <p class="text-sm text-gray-900 mt-1">
                                {{ $client->budget_min ? '$' . number_format($client->budget_min) : 'Min Not Set' }}
                                -
                                {{ $client->budget_max ? '$' . number_format($client->budget_max) : 'Max Not Set' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Preferred Property Type</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->preferred_property_type ?? 'Any' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Preferred Location</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $client->preferred_location ?? 'Any' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 pb-2">Additional Notes</h3>
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">
                        {{ $client->notes ?? 'No notes available for this client.' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>
