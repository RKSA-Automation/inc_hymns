<x-guest-layout>
    <!-- Session Status -->
    <h2 class="text-center" style="color:#0a2d2e;font-size:30px;">INC Hymns</h2>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <!-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> -->

          <!-- Username -->
          <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forgot Password Link -->
        <!-- <div class="mt-2">
            <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline-none">Forgot Password?</a>
        </div> -->

     <div class="flex items-center justify-center mt-4">
        @if (Route::has('password.request'))
        <a href="{{ route('register') }}" class="sm:hidden ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
        @endif

        <x-primary-button class="ms-3">
            {{ __('Log in') }}
        </x-primary-button>

        <button type="button" style="height:34px;" class="ml-3 py-1 px-3 text-sm text-white bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-800 rounded-md focus:outline-none h-10 w-20" onclick="clearLoginForm()">
            CLEAR
        </button>
    </div>

    </form>
</x-guest-layout>
<script>
    function clearLoginForm() {
        document.getElementById('username').value = ''; // Clear username field
        document.getElementById('password').value = ''; // Clear password field
    }
</script>