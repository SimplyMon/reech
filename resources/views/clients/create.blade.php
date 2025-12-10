<x-layouts.layout>
    <x-slot:title>Add Client</x-slot:title>

    <div class="ml-0 lg:ml-64">
        {{-- max-w-none --}}
        <div class="w-full">

            <div class="mb-6">
                <a href="{{ route('clients.index') }}"
                    class="text-gray-500 hover:text-[#B02A30] text-sm flex items-center font-medium">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Back to Clients
                </a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Add New Client</h1>
            </div>

            <form method="POST" action="{{ route('clients.store') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Client Photo
                    </h3>
                    <div class="flex items-center gap-6">
                        <div class="shrink-0">
                            <div
                                class="h-20 w-20 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border-2 border-gray-200">
                                <img id="client-preview" class="h-full w-full object-cover hidden" />
                                <i id="client-icon" class="fa-solid fa-user text-3xl text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" name="profile_picture" onchange="previewClientImage(event)"
                                    class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-red-50 file:text-[#B02A30]
                                    hover:file:bg-red-100 cursor-pointer" />
                            </label>
                            <p class="mt-1 text-xs text-gray-500">PNG, JPG up to 2MB</p>
                            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Personal
                        Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="first_name" :value="__('First Name *')" class="!text-gray-700" />
                            <x-text-input id="first_name"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="first_name" :value="old('first_name')" required />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="middle_name" :value="__('Middle Name')" class="!text-gray-700" />
                            <x-text-input id="middle_name"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="middle_name" :value="old('middle_name')" />
                        </div>
                        <div>
                            <x-input-label for="last_name" :value="__('Last Name *')" class="!text-gray-700" />
                            <x-text-input id="last_name"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="last_name" :value="old('last_name')" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="!text-gray-700" />
                            <x-text-input id="email"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="email" name="email" :value="old('email')" />
                        </div>
                        <div>
                            <x-input-label for="phone_number" :value="__('Phone Number')" class="!text-gray-700" />
                            <x-text-input id="phone_number"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="phone_number" :value="old('phone_number')" />
                        </div>
                        <div>
                            <x-input-label for="occupation" :value="__('Occupation')" class="!text-gray-700" />
                            <x-text-input id="occupation"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="occupation" :value="old('occupation')" />
                        </div>
                        <div>
                            <x-input-label for="date_of_birth" :value="__('Date of Birth')" class="!text-gray-700" />
                            <x-text-input id="date_of_birth"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="date" name="date_of_birth" :value="old('date_of_birth')" />
                        </div>
                        <div>
                            <x-input-label for="gender" :value="__('Gender')" class="!text-gray-700" />
                            <select id="gender" name="gender"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">
                                <option value="">Select...</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="marital_status" :value="__('Marital Status')" class="!text-gray-700" />
                            <select id="marital_status" name="marital_status"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">
                                <option value="">Select...</option>
                                <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single
                                </option>
                                <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>
                                    Married</option>
                                <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>
                                    Divorced</option>
                                <option value="Widowed" {{ old('marital_status') == 'Widowed' ? 'selected' : '' }}>
                                    Widowed</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Address &
                        Location</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="neighborhood" :value="__('Neighborhood')" class="!text-gray-700" />
                            <x-text-input id="neighborhood"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="neighborhood" :value="old('neighborhood')" />
                        </div>
                        <div>
                            <x-input-label for="city" :value="__('City')" class="!text-gray-700" />
                            <x-text-input id="city"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="city" :value="old('city')" />
                        </div>
                        <div>
                            <x-input-label for="state" :value="__('State')" class="!text-gray-700" />
                            <x-text-input id="state"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="state" :value="old('state')" />
                        </div>
                        <div>
                            <x-input-label for="zipcode" :value="__('Zipcode')" class="!text-gray-700" />
                            <x-text-input id="zipcode"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="zipcode" :value="old('zipcode')" />
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Real Estate
                        Preferences</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <x-input-label for="budget_min" :value="__('Budget Range From')" class="!text-gray-700" />
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="budget_min" id="budget_min"
                                    value="{{ old('budget_min') }}"
                                    class="block w-full text-sm rounded-lg border-gray-300 pl-7 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                    placeholder="0.00">
                            </div>
                        </div>
                        <div>
                            <x-input-label for="budget_max" :value="__('Budget Range To')" class="!text-gray-700" />
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="budget_max" id="budget_max"
                                    value="{{ old('budget_max') }}"
                                    class="block w-full text-sm rounded-lg border-gray-300 pl-7 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                    placeholder="0.00">
                            </div>
                        </div>
                        <div>
                            <x-input-label for="preferred_property_type" :value="__('Preferred Property Type')" class="!text-gray-700" />
                            <select id="preferred_property_type" name="preferred_property_type"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">
                                <option value="">Select...</option>
                                <option value="Single Family"
                                    {{ old('preferred_property_type') == 'Single Family' ? 'selected' : '' }}>Single
                                    Family</option>
                                <option value="Condo"
                                    {{ old('preferred_property_type') == 'Condo' ? 'selected' : '' }}>
                                    Condo</option>
                                <option value="Townhouse"
                                    {{ old('preferred_property_type') == 'Townhouse' ? 'selected' : '' }}>Townhouse
                                </option>
                                <option value="Multi-Family"
                                    {{ old('preferred_property_type') == 'Multi-Family' ? 'selected' : '' }}>
                                    Multi-Family</option>
                                <option value="Land"
                                    {{ old('preferred_property_type') == 'Land' ? 'selected' : '' }}>
                                    Land</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="preferred_location" :value="__('Preferred Location')" class="!text-gray-700" />
                            <x-text-input id="preferred_location"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="text" name="preferred_location" :value="old('preferred_location')"
                                placeholder="e.g. Downtown, Suburbs" />
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b pb-2">Contact
                        Preferences & Status</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div>
                            <x-input-label for="preferred_contact_method" :value="__('Preferred Contact Method')" class="!text-gray-700" />
                            <select id="preferred_contact_method" name="preferred_contact_method"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">
                                <option value="Phone"
                                    {{ old('preferred_contact_method') == 'Phone' ? 'selected' : '' }}>Phone</option>
                                <option value="Email"
                                    {{ old('preferred_contact_method') == 'Email' ? 'selected' : '' }}>Email</option>
                                <option value="Text"
                                    {{ old('preferred_contact_method') == 'Text' ? 'selected' : '' }}>Text Message
                                </option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="contact_time_preference_from" :value="__('Time From')"
                                class="!text-gray-700" />
                            <x-text-input id="contact_time_preference_from"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="time" name="contact_time_preference_from" :value="old('contact_time_preference_from')" />
                        </div>
                        <div>
                            <x-input-label for="contact_time_preference_to" :value="__('Time To')"
                                class="!text-gray-700" />
                            <x-text-input id="contact_time_preference_to"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                type="time" name="contact_time_preference_to" :value="old('contact_time_preference_to')" />
                        </div>
                        <div>
                            <x-input-label for="contact_day_preference" :value="__('Day Preference')" class="!text-gray-700" />
                            <select id="contact_day_preference" name="contact_day_preference"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">
                                <option value="Anytime"
                                    {{ old('contact_day_preference') == 'Anytime' ? 'selected' : '' }}>Anytime</option>
                                <option value="Weekdays"
                                    {{ old('contact_day_preference') == 'Weekdays' ? 'selected' : '' }}>Weekdays
                                </option>
                                <option value="Weekends"
                                    {{ old('contact_day_preference') == 'Weekends' ? 'selected' : '' }}>Weekends
                                </option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="client_status" :value="__('Client Status *')" class="!text-gray-700" />
                            <select id="client_status" name="client_status"
                                class="block mt-1 w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">
                                <option value="Lead" {{ old('client_status') == 'Lead' ? 'selected' : '' }}>Lead
                                </option>
                                <option value="Prospect" {{ old('client_status') == 'Prospect' ? 'selected' : '' }}>
                                    Prospect</option>
                                <option value="Buyer" {{ old('client_status') == 'Buyer' ? 'selected' : '' }}>Buyer
                                </option>
                                <option value="Seller" {{ old('client_status') == 'Seller' ? 'selected' : '' }}>Seller
                                </option>
                                <option value="Client" {{ old('client_status') == 'Client' ? 'selected' : '' }}>Client
                                </option>
                                <option value="Closed" {{ old('client_status') == 'Closed' ? 'selected' : '' }}>Closed
                                </option>
                                <option value="Inactive" {{ old('client_status') == 'Inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-[#B02A30] hover:bg-[#98242A] text-white font-bold py-3 px-8 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                        Save Client
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewClientImage(event) {
            const input = event.target;
            const preview = document.getElementById('client-preview');
            const icon = document.getElementById('client-icon');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    icon.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });

            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            @endif

            @if (session('info'))
                Toast.fire({
                    icon: 'info',
                    title: '{{ session('info') }}'
                });
            @endif

            @if ($errors->any())
                let errorHtml = '<ul>';
                @foreach ($errors->all() as $error)
                    errorHtml +=
                        `<li><i class="fa-solid fa-triangle-exclamation mr-1 text-red-500"></i>{{ $error }}</li>`;
                @endforeach
                errorHtml += '</ul>';

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Failed',
                    html: errorHtml,
                    showConfirmButton: true,
                    confirmButtonText: 'Fix Input',
                    confirmButtonColor: '#B02A30',
                    customClass: {
                        popup: 'rounded-xl shadow-2xl',
                        title: 'text-lg font-bold',
                        htmlContainer: 'text-sm text-left'
                    }
                });
            @endif
        });
    </script>
</x-layouts.layout>
