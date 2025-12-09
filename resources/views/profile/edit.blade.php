<x-layouts.layout>
    <x-slot:title>
        Account Settings
    </x-slot:title>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="p-8 bg-white shadow-lg sm:rounded-xl border border-gray-200">

                <header class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Account Settings') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ __('View your account details and update your password.') }}
                    </p>
                </header>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" type="email"
                            class="mt-1 block w-full bg-gray-100 text-gray-500 cursor-not-allowed border-gray-300 focus:border-gray-300 focus:ring-0"
                            :value="$user->email" readonly />
                        <p class="mt-2 text-xs text-gray-400 flex items-center">
                            <i class="fa-solid fa-lock mr-1.5"></i>
                            {{ __('Email cannot be changed. Contact admin for assistance.') }}
                        </p>
                    </div>

                    <div class="border-t border-gray-100 my-6"></div>

                    <div>
                        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                        <x-text-input id="update_password_current_password" name="current_password" type="password"
                            class="mt-1 block w-full focus:ring-[#B02A30] focus:border-[#B02A30]"
                            autocomplete="current-password" placeholder="Current Password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="update_password_password" :value="__('New Password')" />
                        <x-text-input id="update_password_password" name="password" type="password"
                            class="mt-1 block w-full focus:ring-[#B02A30] focus:border-[#B02A30]"
                            autocomplete="new-password" placeholder="New Password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                            type="password" class="mt-1 block w-full focus:ring-[#B02A30] focus:border-[#B02A30]"
                            autocomplete="new-password" placeholder="Confirm Password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-[#B02A30] border border-transparent rounded-lg font-bold text-white shadow-md hover:bg-[#98242A] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#B02A30] focus:ring-offset-2 transition transform hover:-translate-y-0.5">
                            {{ __('Save Changes') }}
                        </button>

                        @if (session('status') === 'password-updated')
                            <p class="text-sm text-green-600 font-medium flex items-center">
                                <i class="fa-solid fa-check-circle mr-1"></i> {{ __('Password Updated.') }}
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if (session('status') === 'password-updated')
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Password updated successfully!'
                });
            @endif

            @if ($errors->updatePassword->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',

                    text: '{{ $errors->updatePassword->first() }}',

                    width: '350px',
                    padding: '1.5rem',
                    confirmButtonColor: '#B02A30',
                    confirmButtonText: 'Try Again',
                    customClass: {
                        popup: 'rounded-xl shadow-xl',
                        title: 'text-lg font-bold text-gray-900',
                        htmlContainer: 'text-sm text-gray-600'
                    }
                });
            @endif
        });
    </script>
</x-layouts.layout>
