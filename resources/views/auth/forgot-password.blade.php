<x-layouts.layout :showSidebar="false">
    <x-slot:title>
        Forgot Password
    </x-slot:title>

    <section class="min-h-screen flex items-center justify-center px-6" style="background-color: #ECECEC;">
        <div class="w-full max-w-md bg-[#f3f3f3] p-8 rounded-xl border border-gray-200 shadow-xl">

            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-key text-2xl text-[#B02A30]"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Forgot Password?</h1>
                <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                    {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input id="email"
                        class="block w-full rounded-lg bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-400 focus:ring-[#B02A30] focus:border-[#B02A30] transition"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-[#B02A30] text-white font-bold rounded-lg shadow-md hover:bg-[#98242A] transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                <div class="mt-6 text-center border-t border-gray-100 pt-6">
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold text-gray-500 hover:text-[#B02A30] transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Back to Login
                    </a>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Check your email',
                    text: '{{ session('status') }}',
                    width: '350px',
                    padding: '1.5rem',
                    confirmButtonColor: '#B02A30',
                    confirmButtonText: 'OK',
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
