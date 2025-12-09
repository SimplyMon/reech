<x-layouts.layout>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-700">

                    <h1 class="text-2xl font-bold mb-2 text-gray-800">Welcome to your Dashboard</h1>
                    <p class="mb-6 text-gray-600">Manage your real estate data and reports here.</p>

                    <button id="clicks"
                        class="px-6 py-2.5 bg-[#B02A30] text-white font-medium rounded-lg hover:bg-[#98242A] transition transform hover:-translate-y-0.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                        Click Me
                    </button>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('clicks').addEventListener('click', () => {
            Swal.fire({
                title: 'Button Clicked!',
                text: 'Thank you for clicking the button.',
                icon: 'success',
                confirmButtonText: 'Close',
                confirmButtonColor: '#E53E3E', // softer red for alert button
                iconColor: '#E53E3E'
            })
        })
    </script>

</x-layouts.layout>
