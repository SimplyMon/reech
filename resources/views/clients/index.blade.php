<x-layouts.layout>
    <x-slot:title>My Clients</x-slot:title>

    <div class="ml-0 lg:ml-64 min-h-screen ">

        <div class="w-full max-w-none space-y-6">



            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Client Management</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage your pipeline, track client status, and organize
                        contacts.</p>
                </div>
                <a href="{{ route('clients.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-[#B02A30] hover:bg-[#98242A] text-white text-sm font-semibold rounded-lg shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                    <i class="fa-solid fa-plus mr-2"></i> Add New Client
                </a>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col mt-4">

                <form id="filterForm" method="GET" action="{{ route('clients.index') }}"
                    class="p-4 border-b border-gray-200 flex flex-col sm:flex-row gap-4 justify-between items-center bg-gray-50/50 rounded-t-xl">

                    <div class="relative w-full sm:w-96">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" name="search" id="searchInput"
                            placeholder="Search by name, email, or city..." value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-[#B02A30] focus:ring-[#B02A30] sm:text-sm transition duration-150 ease-in-out">
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto">

                        <select name="status" id="statusSelect"
                            onchange="document.getElementById('filterForm').submit()"
                            class="px-3 py-2 pr-8 bg-white border border-gray-300 rounded-lg
           text-sm font-medium text-gray-700
           focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">

                            <option value="">All</option>
                            <option value="Lead" @if (request('status') == 'Lead') selected @endif>Lead</option>
                            <option value="Prospect" @if (request('status') == 'Prospect') selected @endif>Prospect</option>
                            <option value="Active" @if (request('status') == 'Active') selected @endif>Active</option>
                            <option value="Buyer" @if (request('status') == 'Buyer') selected @endif>Buyer</option>
                            <option value="Seller" @if (request('status') == 'Seller') selected @endif>Seller</option>
                            <option value="Closed" @if (request('status') == 'Closed') selected @endif>Closed</option>
                            <option value="Inactive" @if (request('status') == 'Inactive') selected @endif>Inactive</option>
                        </select>

                        @if (request()->hasAny(['search', 'status']))
                            <a href="{{ route('clients.index') }}"
                                class="px-3 py-2 bg-gray-200 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-300">
                                Reset
                            </a>
                        @endif

                        <button type="button"
                            class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                            <i class="fa-solid fa-download mr-2 text-gray-400"></i> Export
                        </button>
                    </div>
                </form>


                @if ($clients->isEmpty())
                    <div class="text-center py-20 px-6">
                        <div
                            class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                            <i class="fa-solid fa-user-group text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">No Clients Found</h3>
                        <p class="text-gray-500 text-sm max-w-sm mx-auto mb-6">
                            Adjust your filters or add new clients.
                        </p>
                        <a href="{{ route('clients.create') }}"
                            class="text-[#B02A30] text-sm font-semibold hover:underline">
                            Create new client record &rarr;
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left w-12">
                                        <input type="checkbox"
                                            class="rounded border-gray-300 text-[#B02A30] focus:ring-[#B02A30]">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-auto">
                                        Client Details
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-auto">
                                        Contact Info
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-auto">
                                        Budget / Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-40">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($clients as $client)
                                    <tr class="group hover:bg-gray-50 transition-colors duration-150 cursor-pointer"
                                        data-client-id="{{ $client->id }}"
                                        data-client-name="{{ $client->first_name }}"
                                        data-edit-url="{{ route('clients.edit', $client->id) }}"
                                        data-delete-url="{{ route('clients.destroy', $client->id) }}"
                                        data-show-url="{{ route('clients.show', $client->id) }}"
                                        onclick="showContextMenu(event, this)"
                                        oncontextmenu="showContextMenu(event, this)">

                                        <td class="px-4 sm:px-6 lg:px-8 py-4 whitespace-nowrap">
                                            <input type="checkbox" onclick="event.stopPropagation();"
                                                class="rounded border-gray-300 text-[#B02A30] focus:ring-[#B02A30]">
                                        </td>

                                        <td class="px-4 sm:px-6 lg:px-8 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if ($client->profile_picture_path)
                                                        <img class="h-10 w-10 rounded-full object-cover border border-gray-200"
                                                            src="{{ asset('storage/' . $client->profile_picture_path) }}"
                                                            alt="">
                                                    @else
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-500 font-bold text-xs border border-gray-200">
                                                            {{ substr($client->first_name, 0, 1) }}{{ substr($client->last_name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div
                                                        class="text-sm font-semibold text-gray-900 group-hover:text-[#B02A30] transition-colors">
                                                        {{ $client->first_name }} {{ $client->last_name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $client->occupation ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 sm:px-6 lg:px-8 py-4 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                @if ($client->email)
                                                    <div class="text-sm text-gray-900 flex items-center gap-2 mb-1">
                                                        <i class="fa-regular fa-envelope text-gray-400 text-xs w-4"></i>
                                                        {{ $client->email }}
                                                    </div>
                                                @endif
                                                @if ($client->phone_number)
                                                    <div class="text-xs text-gray-500 flex items-center gap-2">
                                                        <i class="fa-solid fa-phone text-gray-400 text-xs w-4"></i>
                                                        {{ $client->phone_number }}
                                                    </div>
                                                @endif
                                                @if ($client->city)
                                                    <div class="text-xs text-gray-500 flex items-center gap-2 mt-1">
                                                        <i
                                                            class="fa-solid fa-location-dot text-gray-400 text-xs w-4"></i>
                                                        {{ $client->city }}, {{ $client->state }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="px-4 sm:px-6 lg:px-8 py-4 whitespace-nowrap">
                                            @if ($client->budget_min || $client->budget_max)
                                                <div class="text-sm font-medium text-gray-900">
                                                    ${{ number_format($client->budget_min, 0, '.', ',') }} -
                                                    ${{ number_format($client->budget_max, 0, '.', ',') }}
                                                </div>
                                            @else
                                                <div class="text-sm text-gray-400 italic">No budget set</div>
                                            @endif
                                            <div
                                                class="text-xs text-gray-500 mt-1 inline-flex items-center px-2 py-0.5 rounded border border-gray-200 bg-gray-50">
                                                {{ $client->preferred_property_type ?? 'Any Type' }}
                                            </div>
                                        </td>

                                        <td class="px-4 sm:px-6 lg:px-8 py-4 whitespace-nowrap">
                                            @php
                                                $statusStyles = [
                                                    'Active' => 'bg-green-50 text-green-700 ring-green-600/20',
                                                    'Lead' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                                                    'Closed' => 'bg-gray-50 text-gray-600 ring-gray-500/10',
                                                    'Inactive' => 'bg-red-50 text-red-700 ring-red-600/10',
                                                    'Prospect' => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20',
                                                    'Buyer' => 'bg-teal-50 text-teal-700 ring-teal-600/20',
                                                    'Seller' => 'bg-purple-50 text-purple-700 ring-purple-600/20',
                                                    'Client' => 'bg-blue-500/10 text-blue-700 ring-blue-500/20',
                                                ];
                                                $style =
                                                    $statusStyles[$client->client_status] ??
                                                    'bg-gray-50 text-gray-600 ring-gray-500/10';
                                            @endphp
                                            <span
                                                class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $style }}">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-current mr-1.5 opacity-60"></span>
                                                {{ $client->client_status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50 flex items-center justify-between">
                        {{ $clients->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="contextMenu" class="hidden absolute z-50 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1"
        onclick="hideContextMenu()">
        <a id="contextViewLink" href="#"
            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
            <i class="fa-solid fa-eye mr-3 w-4"></i> View Client
        </a>
        <a id="contextEditLink" href="#"
            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
            <i class="fa-solid fa-pen-to-square mr-3 w-4"></i> Edit Client
        </a>
        <div class="border-t border-gray-100 my-1"></div>
        <button id="contextDeleteButton"
            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
            <i class="fa-solid fa-trash mr-3 w-4"></i> Delete Client
        </button>
    </div>

    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        const contextMenu = document.getElementById('contextMenu');

        function hideContextMenu() {
            contextMenu.classList.add('hidden');
        }

        function showContextMenu(event, row) {
            const contextViewLink = document.getElementById('contextViewLink');
            const contextEditLink = document.getElementById('contextEditLink');
            const contextDeleteButton = document.getElementById('contextDeleteButton');
            const deleteForm = document.getElementById('deleteForm');

            if (event.target.type === 'checkbox') {
                return;
            }

            if (event.type === 'contextmenu') {
                event.preventDefault();
            } else if (event.button !== 0) {
                return;
            }

            event.stopPropagation();
            hideContextMenu();

            const deleteUrl = row.getAttribute('data-delete-url');
            const editUrl = row.getAttribute('data-edit-url');
            const showUrl = row.getAttribute('data-show-url');
            const clientName = row.getAttribute('data-client-name');

            contextViewLink.href = showUrl;
            contextEditLink.href = editUrl;

            contextDeleteButton.onclick = function() {
                hideContextMenu();
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete client ${clientName}. This action cannot be undone!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#B02A30',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Delete it!',
                    customClass: {
                        popup: 'rounded-xl shadow-2xl',
                        title: 'text-xl font-bold',
                        confirmButton: 'px-6 py-2 text-white font-semibold',
                        cancelButton: 'px-6 py-2 !text-white font-semibold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.action = deleteUrl;
                        deleteForm.submit();
                    }
                });
            };

            let x = event.pageX;
            let y = event.pageY;

            if (x + contextMenu.offsetWidth > window.innerWidth) {
                x = window.innerWidth - contextMenu.offsetWidth - 10;
            }
            if (y + contextMenu.offsetHeight > window.innerHeight) {
                y = window.innerHeight - contextMenu.offsetHeight - 10;
            }

            contextMenu.style.top = y + 'px';
            contextMenu.style.left = x + 'px';
            contextMenu.classList.remove('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
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

            document.addEventListener('click', hideContextMenu);

            document.querySelectorAll('tbody tr').forEach(row => {
                row.oncontextmenu = function(e) {
                    showContextMenu(e, row);
                };
            });

            const searchInput = document.getElementById('searchInput');
            const filterForm = document.getElementById('filterForm');
            let searchTimeout = null;

            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    clearTimeout(searchTimeout);

                    searchTimeout = setTimeout(() => {
                        if (searchInput.value.length > 2 || searchInput.value.length === 0) {
                            filterForm.submit();
                        }
                    }, 500);
                });
            }
        });
    </script>
</x-layouts.layout>
