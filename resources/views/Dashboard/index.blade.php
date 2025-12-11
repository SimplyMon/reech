<x-layouts.layout>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="py-10 ml-64">
        <div class="max-w-7xl mx-auto px-6 space-y-10">

            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 tracking-tight">
                        Hello There, {{ $user->detail->first_name ?? 'Agent' }}! 👋
                    </h1>
                    <p class="text-base text-gray-500 mt-2">
                        Here’s your updated real estate pipeline overview.
                    </p>
                </div>

                <a href="{{ route('clients.create') }}"
                    class="inline-flex items-center px-5 py-3 bg-[#B02A30] text-white text-sm font-semibold
                           rounded-xl shadow-md hover:bg-[#972329] transition-all duration-200">
                    <i class="fa-solid fa-user-plus mr-2"></i>
                    Add Client
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @php
                    $kpis = [
                        ['icon' => 'users', 'label' => 'Total Clients', 'value' => $totalClients, 'color' => 'teal'],
                        ['icon' => 'street-view', 'label' => 'New Leads', 'value' => $totalLeads, 'color' => 'blue'],
                        [
                            'icon' => 'house-user',
                            'label' => 'Active Opportunities',
                            'value' => $activeBuyersOrSellers,
                            'color' => 'green',
                        ],
                        [
                            'icon' => 'rocket',
                            'label' => 'Active Campaigns',
                            'value' => $activeCampaigns,
                            'color' => 'red',
                        ],
                    ];

                    $colorMap = [
                        'teal' => 'text-teal-600 bg-teal-50',
                        'blue' => 'text-blue-600 bg-blue-50',
                        'green' => 'text-green-600 bg-green-50',
                        'red' => 'text-red-600 bg-red-50',
                    ];
                @endphp

                @foreach ($kpis as $k)
                    <div
                        class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-all p-6">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 rounded-full {{ $colorMap[$k['color']] }} text-2xl">
                                <i class="fa-solid fa-{{ $k['icon'] }}"></i>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 font-medium">{{ $k['label'] }}</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $k['value'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Client Status Breakdown
                        </h3>
                    </div>

                    <div class="px-6 py-6">
                        <div class="space-y-5">

                            @php
                                $statusOrder = ['Lead', 'Prospect', 'Buyer', 'Seller', 'Client', 'Closed', 'Inactive'];
                                $statusColors = [
                                    'Lead' => '#3b82f6',
                                    'Prospect' => '#f59e0b',
                                    'Buyer' => '#14b8a6',
                                    'Seller' => '#a855f7',
                                    'Client' => '#6366f1',
                                    'Closed' => '#6b7280',
                                    'Inactive' => '#ef4444',
                                ];
                                $totalCount = $totalClients ?: 1;
                            @endphp

                            @foreach ($statusOrder as $status)
                                @if (isset($pipelineMap[$status]))
                                    @php
                                        $count = $pipelineMap[$status];
                                        $percentage = round(($count / $totalCount) * 100);
                                    @endphp

                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm font-medium">
                                            <span class="text-gray-700">{{ $status }}</span>
                                            <span class="text-gray-900">{{ $count }}
                                                ({{ $percentage }}%)
                                            </span>
                                        </div>

                                        <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-3 rounded-full"
                                                style="width: {{ $percentage }}%; background-color: {{ $statusColors[$status] }};">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>



                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-3">Quick Access</h3>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="flex items-center space-x-2">
                                <i class="fa-solid fa-list-check text-[#B02A30]"></i>
                                <span class="text-sm font-semibold text-gray-700">Total Campaigns</span>
                            </div>
                            <span class="text-[#B02A30] font-bold">{{ $totalCampaigns }}</span>
                        </div>

                        <a href="{{ route('templates.index') }}"
                            class="flex items-center p-3 rounded-xl border border-gray-200 bg-white shadow-sm hover:bg-gray-50 transition-all text-sm font-medium text-gray-700">
                            <i class="fa-solid fa-envelope mr-2 text-gray-600"></i>
                            Manage Email Templates
                        </a>

                        <a href="{{ route('campaigns.index') }}"
                            class="flex items-center p-3 rounded-xl border border-gray-200 bg-white shadow-sm hover:bg-gray-50 transition-all text-sm font-medium text-gray-700">
                            <i class="fa-solid fa-rocket mr-2 text-gray-600"></i>
                            View Campaign Sequences
                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center p-3 rounded-xl border border-gray-200 bg-white shadow-sm hover:bg-gray-50 transition-all text-sm font-medium text-gray-700">
                            <i class="fa-solid fa-user-gear mr-2 text-gray-600"></i>
                            Update Profile
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts.layout>
