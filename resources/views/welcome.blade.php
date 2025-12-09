<x-layouts.layout :showSidebar="false">
    <x-slot:title>
        Welcome to REECH - Pacific Playa Realty
    </x-slot:title>

    <div class="flex flex-col items-center justify-center min-h-[80vh] text-center" style="background-color: #ECECEC;">

        <div
            class="inline-flex items-center px-3 py-1 rounded-full border border-[#B02A30]/20 bg-[#B02A30]/5 text-[#B02A30] text-sm font-medium mb-8">
            <span class="flex h-2 w-2 rounded-full bg-[#B02A30] mr-2"></span>
            REECH CRM: Pacific Playa Realty
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
            Customer Relations <br class="hidden md:block" />
            <span class="text-[#B02A30]">Management</span>
        </h1>

        <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-12 leading-relaxed">
            CRM solution to manage leads, track, and grow your business relationships efficiently.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-20">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="px-8 py-4 bg-[#B02A30] text-white font-bold rounded-xl shadow-md hover:bg-[#98242A] transition transform hover:-translate-y-0.5">
                    Access Agent Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto px-8 py-4 bg-[#B02A30] text-white font-bold rounded-xl shadow-md hover:bg-[#98242A] transition transform hover:-translate-y-0.5">
                    Agent Login
                </a>

                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-8 py-4 bg-gray-50 text-gray-700 font-semibold rounded-xl border border-gray-200 shadow-sm hover:bg-gray-50 hover:text-gray-900 transition">
                    New Agent Registration
                </a>
            @endauth
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl text-left">
            @foreach ([['icon' => 'fa-house-chimney', 'title' => 'Market Opportunities', 'text' => 'Access exclusive on and off-market real estate data tailored to key residential areas in Los Angeles.'], ['icon' => 'fa-lightbulb', 'title' => 'Strategic Insights', 'text' => 'Collaborative tools to provide clients with current, creative advice to accomplish their real estate goals.'], ['icon' => 'fa-graduation-cap', 'title' => 'Education & Resources', 'text' => 'Continuous training materials and resources to ensure impeccable service in a competitive market.']] as $card)
                <div
                    class="p-6 rounded-2xl bg-gray-50 border border-gray-200 shadow-sm hover:shadow-md transition group">
                    <div
                        class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#B02A30]/10 transition">
                        <i class="fa-solid {{ $card['icon'] }} text-xl text-gray-500 group-hover:text-[#B02A30]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $card['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $card['text'] }}</p>
                </div>
            @endforeach
        </div>

    </div>
</x-layouts.layout>
