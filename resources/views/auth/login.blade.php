<x-layouts.layout :showSidebar="false">
    <x-slot:title>
        Log In
    </x-slot:title>

    <section class="min-h-screen flex items-center justify-center px-6" style="background-color: #ECECEC;">
        <div class="w-full max-w-md bg-[#f3f3f3] p-8 rounded-xl border border-gray-200 shadow-xl">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Welcome Back</h1>
                <p class="text-gray-500 mt-2">Please sign in to your account</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email"
                        class="block w-full rounded-lg bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-400 focus:ring-[#B02A30] focus:border-[#B02A30] transition"
                        type="email" name="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>

                    <div class="relative">
                        <input id="password"
                            class="block w-full rounded-lg bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-400 focus:ring-[#B02A30] focus:border-[#B02A30] transition pr-10"
                            type="password" name="password" required autocomplete="current-password" />

                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-[#B02A30] shadow-sm focus:ring-[#B02A30]"
                            name="remember">
                        <span
                            class="ms-2 text-sm text-gray-600 hover:text-gray-900 transition">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-500 hover:text-[#B02A30] transition"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <div class="mt-8">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-[#B02A30] text-white font-bold rounded-lg shadow-md hover:bg-[#98242A] transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                        {{ __('Log in') }}
                    </button>
                </div>

                <div class="mt-6 text-center border-t border-gray-100 pt-6">
                    <p class="text-sm text-gray-500">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="font-semibold text-[#B02A30] hover:text-[#98242A] transition ml-1">
                            Register
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });

            @if (session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('status') }}',
                    padding: '1.5rem',
                    confirmButtonColor: '#B02A30',
                    confirmButtonText: 'Great!',
                    customClass: {
                        popup: 'rounded-xl shadow-xl',
                        title: 'text-lg font-bold text-gray-900',
                        htmlContainer: 'text-sm text-gray-600'
                    }
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'The email or password you entered is incorrect.',
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
