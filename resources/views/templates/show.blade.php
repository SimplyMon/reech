<x-layouts.layout>
    <x-slot:title>View Template: {{ $template->name }}</x-slot:title>

    <div class="py-10 ml-64 min-h-screen bg-gray-50/50 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto space-y-6">

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <a href="{{ route('templates.index') }}"
                        class="text-gray-500 hover:text-[#B02A30] text-sm flex items-center font-medium transition">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Templates List
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight mt-1">Viewing: {{ $template->name }}</h1>
                </div>

                <a href="{{ route('templates.edit', $template->id) }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-[#B02A30] text-white text-sm font-semibold rounded-lg shadow-sm hover:bg-[#98242A] transition-all focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Template
                </a>
            </div>

            <div class="bg-white shadow-xl sm:rounded-xl border border-gray-200 overflow-hidden">

                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Subject: <span
                            class="font-normal">{{ $template->subject }}</span></h2>
                    <div class="text-xs text-gray-500 space-y-0.5">
                        <p><i class="fa-solid fa-user-tag mr-1 w-3"></i> Created by: {{ $template->user->email }}</p>
                        <p><i class="fa-regular fa-clock mr-1 w-3"></i> Last Updated:
                            {{ $template->updated_at->format('M d, Y \a\t H:i') }}</p>
                    </div>
                </div>

                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-3">Targeted Client Statuses
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($template->target_status as $status)
                            @php
                                $statusStyles = [
                                    'Lead' => 'bg-blue-100 text-blue-800 ring-blue-700/10',
                                    'Prospect' => 'bg-yellow-100 text-yellow-800 ring-yellow-600/20',
                                    'Buyer' => 'bg-teal-100 text-teal-800 ring-teal-600/20',
                                    'Seller' => 'bg-purple-100 text-purple-800 ring-purple-600/20',
                                    'Client' => 'bg-indigo-100 text-indigo-800 ring-indigo-600/20',
                                    'Closed' => 'bg-gray-100 text-gray-600 ring-gray-500/10',
                                    'Inactive' => 'bg-red-100 text-red-800 ring-red-600/20',
                                ];
                                $class = $statusStyles[$status] ?? 'bg-gray-100 text-gray-800 ring-gray-500/10';
                            @endphp
                            <span
                                class="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-md ring-1 ring-inset {{ $class }}">
                                {{ $status }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-3">Message Body Preview</h3>
                    <div
                        class="bg-gray-50 p-6 rounded-lg border border-gray-200 shadow-inner text-gray-800 leading-relaxed text-sm">

                        <pre class="whitespace-pre-wrap font-sans">{{ $template->body }}</pre>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>
