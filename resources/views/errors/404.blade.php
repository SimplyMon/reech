<x-layouts.layout :showSidebar="false">
    <x-slot:title>
        404 Not Found
    </x-slot:title>

    <section class="min-h-screen flex flex-col items-center justify-center px-6 text-center relative overflow-hidden"
        style="background-color: #ECECEC;">

        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none select-none">
            <i class="fa-regular fa-compass text-[30rem] text-gray-900"></i>
        </div>

        <div class="relative z-10">
            <h1
                class="text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#B02A30] to-red-600 mb-2 drop-shadow-sm">
                404
            </h1>

            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 tracking-tight">
                Page Not Found
            </h2>

            <p class="text-lg text-gray-600 mb-10 max-w-lg mx-auto leading-relaxed">
                We're sorry, the page you requested could not be found. It may have been moved, renamed, or no longer
                exists.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ url('/dashboard') }}"
                    class="px-8 py-3 bg-[#B02A30] text-white font-bold rounded-xl shadow-lg shadow-[#B02A30]/20 hover:bg-[#98242A] transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                    <i class="fa-solid fa-house mr-2"></i> Return Home
                </a>

                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-8 py-3 bg-white text-gray-700 font-semibold rounded-xl border border-gray-200 shadow-sm hover:bg-gray-50 hover:text-gray-900 hover:border-gray-300 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                        <i class="fa-solid fa-gauge mr-2"></i> Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </section>
</x-layouts.layout>
