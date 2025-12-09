<x-layouts.layout :showSidebar="false">
    <x-slot:title>
        Reset Password
    </x-slot:title>

    <section class="min-h-screen flex items-center justify-center px-6" style="background-color: #ECECEC;">
        <div class="w-full max-w-md bg-[#f3f3f3] p-8 rounded-xl border border-gray-200 shadow-xl">

            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-lock-open text-2xl text-[#B02A30]"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Reset Password</h1>
                <p class="text-gray-500 mt-2 text-sm">
                    Enter your new password below.
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>

                    <input id="email"
                        class="block w-full rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed border-gray-300 focus:border-gray-300 focus:ring-0"
                        type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                        readonly />

                    <p class="mt-2 text-xs text-gray-400 flex items-center">
                        <i class="fa-solid fa-lock mr-1.5"></i>
                        {{ __('You are resetting the password for this email only.') }}
                    </p>

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input id="password"
                        class="block w-full rounded-lg bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-400 focus:ring-[#B02A30] focus:border-[#B02A30] transition"
                        type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                        Password</label>
                    <input id="password_confirmation"
                        class="block w-full rounded-lg bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-400 focus:ring-[#B02A30] focus:border-[#B02A30] transition"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-[#B02A30] text-white font-bold rounded-lg shadow-md hover:bg-[#98242A] transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Reset Failed',
                    text: '{{ $errors->first() }}',
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
