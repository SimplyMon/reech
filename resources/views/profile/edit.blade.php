<x-layouts.layout>
    <x-slot:title>
        My Profile
    </x-slot:title>

    <div class="ml-64 min-h-screen">
        <div class="mx-auto space-y-6">

            <div class="bg-white rounded-xl border shadow-sm p-6 flex flex-col md:flex-row items-center gap-6">
                <div class="relative w-24 h-24 group cursor-pointer flex-shrink-0">

                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                        form="main-profile-form" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                        onchange="previewImage(event)">

                    <div class="w-full h-full rounded-full overflow-hidden border-4 border-gray-50 shadow-sm relative">
                        @if (isset($user->detail->profile_picture_path))
                            <img id="preview" src="{{ asset('storage/' . $user->detail->profile_picture_path) }}"
                                class="w-full h-full object-cover">
                        @else
                            <div id="initials"
                                class="w-full h-full bg-[#B02A30]/10 text-[#B02A30] flex items-center justify-center text-3xl font-bold">
                                {{ substr($user->detail->first_name ?? 'U', 0, 1) }}{{ substr($user->detail->last_name ?? 'N', 0, 1) }}
                            </div>
                            <img id="preview" class="w-full h-full object-cover hidden" src="#">
                        @endif

                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fa-solid fa-camera text-white text-lg"></i>
                        </div>
                    </div>

                    <div
                        class="absolute bottom-0 right-0 bg-white rounded-full p-1.5 shadow-md border border-gray-100 text-gray-500">
                        <i class="fa-solid fa-pencil text-xs"></i>
                    </div>
                </div>

                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->detail->first_name ?? 'User' }}
                        {{ $user->detail->last_name ?? '' }}</h1>
                    <p class="text-sm text-gray-500 font-medium mt-1">
                        {{ $user->detail->agency_name ?? 'No Agency Assigned' }}</p>
                    <div class="mt-3 flex items-center justify-center md:justify-start gap-4">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active Agent
                        </span>
                        <button type="button" onclick="document.getElementById('profile_picture').click()"
                            class="text-xs text-[#B02A30] hover:underline font-semibold">
                            Change Profile Photo
                        </button>
                    </div>
                </div>
            </div>

            <form id="main-profile-form" method="post" action="{{ route('profile.update') }}"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-gray-900">Personal Information</h2>
                        <span class="text-xs text-gray-500">* Required fields</span>
                    </div>

                    <div class="p-8 space-y-10">
                        <div>
                            <h3
                                class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6 pb-2 border-b border-gray-100">
                                <i class="fa-regular fa-id-card mr-2 text-gray-400"></i> Identity
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="first_name" :value="__('First Name')" class="!text-gray-700" />
                                    <x-text-input id="first_name" name="first_name" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('first_name', $user->detail->first_name ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="middle_name" :value="__('Middle Name')" class="!text-gray-700" />
                                    <x-text-input id="middle_name" name="middle_name" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('middle_name', $user->detail->middle_name ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="last_name" :value="__('Last Name')" class="!text-gray-700" />
                                    <x-text-input id="last_name" name="last_name" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('last_name', $user->detail->last_name ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="gender" :value="__('Gender')" class="!text-gray-700" />
                                    <select id="gender" name="gender"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30] shadow-sm">
                                        <option value="">Select Gender</option>
                                        <option value="Male"
                                            {{ old('gender', $user->detail->gender ?? '') == 'Male' ? 'selected' : '' }}>
                                            Male</option>
                                        <option value="Female"
                                            {{ old('gender', $user->detail->gender ?? '') == 'Female' ? 'selected' : '' }}>
                                            Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6 pb-2 border-b border-gray-100">
                                <i class="fa-solid fa-map-location-dot mr-2 text-gray-400"></i> Contact & Address
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="phone_number" :value="__('Phone Number')" class="!text-gray-700" />
                                    <x-text-input id="phone_number" name="phone_number" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('phone_number', $user->detail->phone_number ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="city" :value="__('City')" class="!text-gray-700" />
                                    <x-text-input id="city" name="city" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('city', $user->detail->city ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="state" :value="__('State')" class="!text-gray-700" />
                                    <x-text-input id="state" name="state" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('state', $user->detail->state ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="zipcode" :value="__('Zip Code')" class="!text-gray-700" />
                                    <x-text-input id="zipcode" name="zipcode" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('zipcode', $user->detail->zipcode ?? '')" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6 pb-2 border-b border-gray-100">
                                <i class="fa-solid fa-briefcase mr-2 text-gray-400"></i> Agency Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="md:col-span-2 lg:col-span-1">
                                    <x-input-label for="agency_name" :value="__('Agency Name')" class="!text-gray-700" />
                                    <x-text-input id="agency_name" name="agency_name" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('agency_name', $user->detail->agency_name ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="license_number" :value="__('License Number')" class="!text-gray-700" />
                                    <x-text-input id="license_number" name="license_number" type="text"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old('license_number', $user->detail->license_number ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="license_expiration_date" :value="__('License Expiration')"
                                        class="!text-gray-700" />
                                    <x-text-input id="license_expiration_date" name="license_expiration_date"
                                        type="date"
                                        class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                        :value="old(
                                            'license_expiration_date',
                                            $user->detail->license_expiration_date ?? '',
                                        )" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6 pb-2 border-b border-gray-100">
                                <i class="fa-solid fa-signature mr-2 text-gray-400"></i> Digital Signature
                            </h3>
                            <div
                                class="flex items-start space-x-6 p-4 bg-gray-50 rounded-lg border border-gray-200 border-dashed">
                                @if (isset($user->detail->signature_path))
                                    <div class="flex-shrink-0 p-2 bg-white border border-gray-200 rounded-lg">
                                        <img src="{{ asset('storage/' . $user->detail->signature_path) }}"
                                            alt="Signature" class="h-16 object-contain">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <label class="block w-full">
                                        <span class="sr-only">Choose signature file</span>
                                        <input type="file" name="signature" accept="image/png"
                                            class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-lg file:border-0
                                            file:text-xs file:font-semibold
                                            file:bg-gray-800 file:text-white
                                            hover:file:bg-black
                                            cursor-pointer transition" />
                                    </label>
                                    <p class="mt-2 text-xs text-gray-500">Please upload a clear PNG file of your
                                        signature. Max size 2MB.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('signature')" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-4">
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                class="text-sm text-green-600 font-medium">
                                <i class="fa-solid fa-check-circle mr-1"></i> Saved successfully
                            </p>
                        @endif
                        <button type="submit"
                            class="px-8 py-2.5 bg-[#B02A30] text-white text-sm font-bold rounded-lg shadow-md hover:bg-[#98242A] focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30] transition-all transform active:scale-95">
                            Save Profile Changes
                        </button>
                    </div>
                </div>
            </form>

            <div id="security" class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mt-8">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-900">Security & Credentials</h2>
                </div>
                <div class="p-8">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <div class="lg:col-span-1">
                                <x-input-label for="email" :value="__('Email Address')" class="!text-gray-700" />
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-envelope text-gray-400 text-sm"></i>
                                    </div>
                                    <x-text-input id="email" type="email"
                                        class="pl-10 block w-full bg-gray-50 text-gray-500 border-gray-200 focus:ring-0 cursor-not-allowed rounded-lg text-sm"
                                        :value="$user->email" readonly />
                                </div>
                            </div>

                            <div class="hidden lg:block lg:col-span-2"></div>

                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" class="!text-gray-700" />
                                <x-text-input id="current_password" name="current_password" type="password"
                                    class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                    autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" class="!text-gray-700" />
                                <x-text-input id="password" name="password" type="password"
                                    class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                                    class="!text-gray-700" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                    class="mt-1 block w-full text-sm rounded-lg border-gray-300 focus:border-[#B02A30] focus:ring-[#B02A30]"
                                    autocomplete="new-password" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                    class="text-sm text-green-600 font-medium">
                                    <i class="fa-solid fa-check-circle mr-1"></i> Password Updated
                                </p>
                            @endif
                            <button type="submit"
                                class="px-8 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-lg shadow-md hover:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const initials = document.getElementById('initials');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (initials) initials.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layouts.layout>
