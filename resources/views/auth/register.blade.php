<x-layouts.layout :showSidebar="false">
    <x-slot:title>
        Register Agent
    </x-slot:title>

    <section class="min-h-screen flex items-center justify-center px-6" style="background-color: #ECECEC;">
        <div class="w-full max-w-md bg-[#f3f3f3] p-8 rounded-xl border border-gray-200 shadow-xl">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Create Account</h1>
                <p class="text-gray-500 mt-2">Join Pacific Playa Realty</p>
            </div>

            <form id="registerForm" method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email"
                        class="block w-full rounded-lg bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-400 focus:ring-[#B02A30] focus:border-[#B02A30] transition"
                        type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>

                    <div class="relative">
                        <input id="password"
                            class="block w-full rounded-lg bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-400 focus:ring-[#B02A30] focus:border-[#B02A30] transition pr-10"
                            type="password" name="password" required autocomplete="new-password" />

                        <span id="togglePassword"
                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-400">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>

                    <p class="text-xs text-gray-500 mt-1">
                        Password must be at least 8 characters and include uppercase, lowercase, numbers, and special
                        characters.
                    </p>
                    <div id="password-strength" class="mt-2 text-sm font-medium"></div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>



                <div class="mt-5">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirm Password
                    </label>

                    <div class="relative">
                        <input id="password_confirmation"
                            class="block w-full rounded-lg bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-400 focus:ring-[#B02A30] focus:border-[#B02A30] transition pr-10"
                            type="password" name="password_confirmation" required autocomplete="new-password" />

                        <span id="togglePasswordConfirm"
                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-400">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                <div class="mt-8">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-[#B02A30] text-white font-bold rounded-lg shadow-md hover:bg-[#98242A] transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B02A30]">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="mt-6 text-center border-t border-gray-100 pt-6">
                    <p class="text-sm text-gray-500">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-[#B02A30] hover:text-[#98242A] transition ml-1">
                            Log in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirmation');
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const passwordStrength = document.getElementById('password-strength');

            togglePassword.addEventListener('click', () => {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                togglePassword.innerHTML = type === 'password' ? '<i class="fa fa-eye"></i>' :
                    '<i class="fa fa-eye-slash"></i>';
            });

            togglePasswordConfirm.addEventListener('click', () => {
                const type = passwordConfirmInput.type === 'password' ? 'text' : 'password';
                passwordConfirmInput.type = type;
                togglePasswordConfirm.innerHTML = type === 'password' ? '<i class="fa fa-eye"></i>' :
                    '<i class="fa fa-eye-slash"></i>';
            });

            passwordInput.addEventListener('input', () => {
                const val = passwordInput.value;
                let strength = '';
                let color = '';

                const hasLetters = /[a-zA-Z]/.test(val);
                const hasUpper = /[A-Z]/.test(val);
                const hasLower = /[a-z]/.test(val);
                const hasNumbers = /[0-9]/.test(val);
                const hasSpecial = /[\W_]/.test(val);

                if (val.length === 0) {
                    strength = '';
                } else if (val.length < 8) {
                    strength = 'Weak';
                    color = 'text-red-500';
                } else if (hasLetters && hasNumbers && hasSpecial && hasUpper && hasLower) {
                    strength = 'Strong';
                    color = 'text-green-500';
                } else {
                    strength = 'Medium';
                    color = 'text-yellow-500';
                }

                passwordStrength.textContent = strength;
                passwordStrength.className = `mt-2 text-sm font-medium ${color}`;
            });

            form.addEventListener('submit', function(e) {
                const val = passwordInput.value;
                const confirmVal = passwordConfirmInput.value;

                const hasLetters = /[a-zA-Z]/.test(val);
                const hasUpper = /[A-Z]/.test(val);
                const hasLower = /[a-z]/.test(val);
                const hasNumbers = /[0-9]/.test(val);
                const hasSpecial = /[\W_]/.test(val);

                if (val.length < 8 || !hasLetters || !hasNumbers || !hasSpecial || !hasUpper || !hasLower) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Weak Password',
                        html: 'Password must be at least 8 characters and include uppercase, lowercase, numbers, and special characters.',
                        confirmButtonColor: '#B02A30'
                    });
                } else if (val !== confirmVal) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Passwords Do Not Match',
                        html: 'Please make sure the password and confirmation match.',
                        confirmButtonColor: '#B02A30'
                    });
                }
            });
        });
    </script>
</x-layouts.layout>
