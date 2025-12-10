<x-layouts.layout>
    <x-slot:title>Campaign Manager</x-slot:title>

    <div class="ml-64 min-h-screen">
        <div class="mx-auto space-y-8">

            <div class="flex justify-between items-end border-b border-gray-200 pb-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Campaign Manager</h1>
                    <p class="text-base text-gray-500 mt-1">Manage your single-step communication campaigns.</p>
                </div>
                <a href="{{ route('campaigns.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-[#B02A30] hover:bg-[#98242A] text-white text-sm font-semibold rounded-lg shadow-md transition-all focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                    <i class="fa-solid fa-square-plus mr-2"></i> Create New Campaign
                </a>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden">
                @if ($campaigns->isEmpty())
                    <div class="text-center py-20 text-gray-500">
                        <div class="mb-4">
                            <i class="fa-solid fa-rocket text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">No Campaigns Found</h3>
                        <p class="text-sm text-gray-500">Launch your first campaign now.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Campaign Name
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Step Name
                                    </th>
                                    <th class="px-6 py-3 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($campaigns as $campaign)
                                    <tr class="group hover:bg-gray-100/50 transition-colors duration-150 cursor-pointer"
                                        data-campaign-id="{{ $campaign->id }}"
                                        data-campaign-name="{{ $campaign->name }}"
                                        data-view-url="{{ route('campaigns.show', $campaign->id) }}"
                                        data-edit-url="{{ route('campaigns.edit', $campaign->id) }}"
                                        data-delete-url="{{ route('campaigns.destroy', $campaign->id) }}"
                                        onclick="showCampaignContextMenu(event, this)"
                                        oncontextmenu="showCampaignContextMenu(event, this)">

                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 group-hover:text-[#B02A30] transition-colors">
                                            <i
                                                class="fa-regular fa-file-lines mr-2 text-gray-400 group-hover:text-[#B02A30] transition-colors"></i>
                                            {{ $campaign->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            @php
                                                $class = match ($campaign->status) {
                                                    'active' => 'bg-green-100 text-green-800 ring-green-600/20',
                                                    'paused' => 'bg-yellow-100 text-yellow-800 ring-yellow-600/20',
                                                    'completed' => 'bg-gray-100 text-gray-600 ring-gray-500/10',
                                                    default => 'bg-blue-100 text-blue-800 ring-blue-700/10',
                                                };
                                            @endphp
                                            <span
                                                class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium ring-1 ring-inset {{ $class }}">
                                                {{ ucfirst($campaign->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $campaign->step_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <i
                                                class="fa-solid fa-ellipsis-vertical text-gray-300 group-hover:text-gray-500 transition-colors"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50">
                        {{ $campaigns->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div id="contextMenuCampaign"
        class="hidden absolute z-50 w-56 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 py-1">

        <a id="contextViewLinkCampaign" href="#"
            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors font-medium">
            <i class="fa-solid fa-eye mr-3 w-4"></i> View Campaign
        </a>
        <a id="contextEditLinkCampaign" href="#"
            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors font-medium">
            <i class="fa-solid fa-pen-to-square mr-3 w-4"></i> Edit Campaign
        </a>

        <div class="border-t border-gray-100 my-1"></div>

        <button id="contextDeleteButtonCampaign"
            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
            <i class="fa-solid fa-trash mr-3 w-4"></i> Delete Campaign
        </button>
    </div>

    <form id="deleteFormCampaign" method="POST" style="display: none;">
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


            const contextMenu = document.getElementById('contextMenuCampaign');
            const contextViewLink = document.getElementById('contextViewLinkCampaign');
            const contextEditLink = document.getElementById('contextEditLinkCampaign');
            const contextDeleteButton = document.getElementById('contextDeleteButtonCampaign');
            const deleteForm = document.getElementById('deleteFormCampaign');

            function hideContextMenu() {
                contextMenu.classList.add('hidden');
            }

            window.showCampaignContextMenu = function(event, row) {
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

                const deleteUrl = row.getAttribute('data-delete-url');
                const editUrl = row.getAttribute('data-edit-url');
                const viewUrl = row.getAttribute('data-view-url');
                const campaignName = row.getAttribute('data-campaign-name');

                contextViewLink.href = viewUrl;
                contextEditLink.href = editUrl;

                contextDeleteButton.onclick = function() {
                    hideContextMenu();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Confirm Deletion',
                            text: `Are you sure you want to delete the campaign "${campaignName}"? This action is irreversible.`,
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
                        if (confirm(`Are you sure you want to delete the campaign "${campaignName}"?`)) {
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
                    window.showCampaignContextMenu(e, row);
                };
            });
        });
    </script>
</x-layouts.layout>
