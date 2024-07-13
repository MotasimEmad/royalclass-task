<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"></x-auth-session-status>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')"></x-input-label>
            <x-text-input id="email" class="block mt-1 w-full py-2 bg-gray-50 border border-gray-100" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"></x-text-input>
            <x-input-error :messages="$errors->get('email')" class="mt-2"></x-input-error>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')"></x-input-label>

            <x-text-input id="password" class="block mt-1 w-full py-2 bg-gray-50 border border-gray-100"
                            type="password"
                            name="password"
                          required autocomplete="current-password"></x-text-input>

            <x-input-error :messages="$errors->get('password')" class="mt-2"></x-input-error>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">تذكرني</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                تسجيل دخول
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
