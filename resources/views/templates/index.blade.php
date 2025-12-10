<x-layouts.layout>
    <x-slot:title>Email Templates</x-slot:title>

    <div class=" ml-64 min-h-screen ">
        <div class="mx-auto space-y-6">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Email Templates</h1>
                    <p class="text-sm text-gray-500 mt-1">Standardized communication messages for client engagement.</p>
                </div>
                <a href="{{ route('templates.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-[#B02A30] hover:bg-[#98242A] text-white text-sm font-semibold rounded-lg shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                    <i class="fa-solid fa-plus mr-2"></i> Create Template
                </a>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col">

                <div
                    class="p-4 border-b border-gray-200 flex flex-col sm:flex-row gap-4 justify-between items-center bg-gray-50/50 rounded-t-xl">

                    <form method="GET" action="{{ url()->current() }}" id="search-form"
                        class="relative w-full sm:w-96">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" placeholder="Search by name or subject..." name="search"
                            id="search-input" value="{{ request('search') }}"
                            class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-[#B02A30] focus:ring-[#B02A30] sm:text-sm transition duration-150 ease-in-out">

                        <button type="button" id="search-reset-button"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center {{ request('search') ? 'text-gray-500' : 'hidden' }} hover:text-[#B02A30] cursor-pointer">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </form>

                    <div class="flex items-center gap-2 w-full sm:w-auto">
                    </div>
                </div>

                <div class="p-0">
                    @if ($templates->isEmpty())
                        <div class="text-center py-20 text-gray-500">
                            <div
                                class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                                <i class="fa-solid fa-envelope-open-text text-2xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">No Templates Created</h3>
                            <p class="text-gray-500 text-sm max-w-sm mx-auto mb-6">
                                Templates allow you to quickly send standardized messages to clients. Click below to
                                create your first one.
                            </p>
                            <a href="{{ route('templates.create') }}"
                                class="text-[#B02A30] text-sm font-semibold hover:underline">
                                Create Template &rarr;
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Template Name
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Subject
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            For Clients
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Last Updated
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($templates as $template)
                                        <tr class="group hover:bg-gray-100/50 transition-colors duration-150 cursor-pointer"
                                            data-template-id="{{ $template->id }}"
                                            data-template-name="{{ $template->name }}"
                                            data-view-url="{{ route('templates.show', $template->id) }}"
                                            data-edit-url="{{ route('templates.edit', $template->id) }}"
                                            data-delete-url="{{ route('templates.destroy', $template->id) }}"
                                            onclick="showContextMenu(event, this)">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div
                                                    class="text-sm font-semibold text-gray-900 group-hover:text-[#B02A30] transition-colors">
                                                    <i
                                                        class="fa-regular fa-file-lines mr-2 text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                                                    {{ $template->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-600">{{ $template->subject }}</div>
                                            </td>

                                            <td class="px-6 py-4">
                                                @foreach ($template->target_status as $status)
                                                    @php
                                                        $statusStyles = [
                                                            'Lead' => 'bg-blue-100 text-blue-800 ring-blue-700/10',
                                                            'Prospect' =>
                                                                'bg-yellow-100 text-yellow-800 ring-yellow-600/20',
                                                            'Buyer' => 'bg-teal-100 text-teal-800 ring-teal-600/20',
                                                            'Seller' =>
                                                                'bg-purple-100 text-purple-800 ring-purple-600/20',
                                                            'Client' =>
                                                                'bg-indigo-100 text-indigo-800 ring-indigo-600/20',
                                                            'Closed' => 'bg-gray-100 text-gray-600 ring-gray-500/10',
                                                            'Inactive' => 'bg-red-100 text-red-800 ring-red-600/20',
                                                        ];
                                                        $class =
                                                            $statusStyles[$status] ??
                                                            'bg-gray-100 text-gray-800 ring-gray-500/10';
                                                    @endphp
                                                    <span
                                                        class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium ring-1 ring-inset {{ $class }} mr-1 mb-1">
                                                        {{ $status }}
                                                    </span>
                                                @endforeach
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $template->updated_at->format('M d, Y') }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50 flex items-center justify-between">
                            {{ $templates->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="contextMenuTemplate"
        class="hidden absolute z-50 w-56 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 py-1">
        <button id="contextSendButtonTemplate"
            class="flex items-center w-full px-4 py-2 text-sm text-green-700 hover:bg-green-50 transition-colors font-medium">
            <i class="fa-solid fa-paper-plane mr-3 w-4"></i> Bulk Send to Clients
        </button>
        <div class="border-t border-gray-100 my-1"></div>
        <a id="contextViewLinkTemplate" href="#"
            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
            <i class="fa-solid fa-eye mr-3 w-4"></i> Preview Template
        </a>
        <a id="contextEditLinkTemplate" href="#"
            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
            <i class="fa-solid fa-pen-to-square mr-3 w-4"></i> Edit Template
        </a>
        <div class="border-t border-gray-100 my-1"></div>
        <button id="contextDeleteButtonTemplate"
            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
            <i class="fa-solid fa-trash mr-3 w-4"></i> Delete Template
        </button>
    </div>

    <form id="sendFormTemplate" method="POST" style="display: none;">
        @csrf
    </form>

    <form id="deleteFormTemplate" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = typeof Swal !== 'undefined' && Swal.mixin ? Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            }) : {
                fire: ({
                    icon,
                    title
                }) => console.log(`Toast: ${icon} - ${title}`)
            };


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


            const contextMenu = document.getElementById('contextMenuTemplate');
            const contextSendButton = document.getElementById('contextSendButtonTemplate');
            const contextViewLink = document.getElementById('contextViewLinkTemplate');
            const contextEditLink = document.getElementById('contextEditLinkTemplate');
            const contextDeleteButton = document.getElementById('contextDeleteButtonTemplate');
            const deleteForm = document.getElementById('deleteFormTemplate');
            const sendForm = document.getElementById('sendFormTemplate');

            function hideContextMenu() {
                contextMenu.classList.add('hidden');
            }

            const searchInput = document.getElementById('search-input');
            const resetButton = document.getElementById('search-reset-button');
            const searchForm = document.getElementById('search-form');

            searchInput.addEventListener('input', function() {
                if (this.value) {
                    resetButton.classList.remove('hidden');
                } else {
                    resetButton.classList.add('hidden');
                }
            });

            resetButton.addEventListener('click', function() {
                searchInput.value = ''; // Clear the input
                resetButton.classList.add('hidden');
                searchForm
                    .submit();
            });

            window.showContextMenu = function(event, row) {
                if (event.target.closest('tr') !== row) {
                    return;
                }

                if (event.type === 'contextmenu') {
                    event.preventDefault();
                } else if (event.button !== 0) {
                    return;
                }

                event.stopPropagation();
                hideContextMenu();

                const templateId = row.getAttribute('data-template-id');
                const deleteUrl = row.getAttribute('data-delete-url');
                const editUrl = row.getAttribute('data-edit-url');
                const viewUrl = row.getAttribute('data-view-url');
                const templateName = row.getAttribute('data-template-name');

                const sendUrl = `/templates/${templateId}/send`;

                contextViewLink.href = viewUrl;
                contextEditLink.href = editUrl;

                contextSendButton.onclick = function() {
                    hideContextMenu();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Confirm Bulk Send',
                            text: `You are about to send the template "${templateName}" to ALL clients (with emails) matching its statuses. Continue?`,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#10b981',
                            cancelButtonColor: '#4b5563',
                            confirmButtonText: 'Yes, Send Emails!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                sendForm.action = sendUrl;
                                sendForm.submit();
                            }
                        });
                    } else {
                        console.log(`Sending template ${templateName}...`);
                        sendForm.action = sendUrl;
                        sendForm.submit();
                    }
                };

                contextDeleteButton.onclick = function() {
                    hideContextMenu();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Confirm Delete',
                            text: `Are you sure you want to delete the template "${templateName}"?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#B02A30',
                            cancelButtonColor: '#4b5563',
                            confirmButtonText: 'Yes, Delete it!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                deleteForm.action = deleteUrl;
                                deleteForm.submit();
                            }
                        });
                    } else {
                        if (confirm(`Are you sure you want to delete the template "${templateName}"?`)) {
                            deleteForm.action = deleteUrl;
                            deleteForm.submit();
                        }
                    }
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

            document.addEventListener('click', hideContextMenu);

            document.querySelectorAll('tbody tr').forEach(row => {
                row.oncontextmenu = function(e) {
                    window.showContextMenu(e, row);
                };
            });
        });
    </script>
</x-layouts.layout>
