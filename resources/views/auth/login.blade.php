<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('login') }}" class="space-y-4">
            <!-- Email Address -->
            <x-splade-input type="email" name="email" :label="__('Email')" required autofocus />
            <x-splade-input type="password" name="password" :label="__('Password')" required autocomplete="current-password" />
            <x-splade-checkbox id="remember_me" name="remember" :label="__('Remember me')" />

            <div class="flex items-center justify-end">
                @if (Route::has('password.request') && Route::has('register'))
                    <div class="flex flex-col">
                        <Link class="underline mb-1 text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('register') }}">
                        {{ __('No account right?') }}
                        </Link>
                        <Link class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                        </Link>
                    </div>
                @endif

                <x-splade-submit class="ml-3" :label="__('Log in')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
