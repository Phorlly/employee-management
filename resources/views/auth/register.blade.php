<x-guest-layout>
    <x-auth-card>
        <x-splade-form action="{{ route('register') }}" class="space-y-4">
            <x-splade-input type="text" name="username" :label="__('Username')" required autofocus />
            <x-splade-input type="text" name="first_name" :label="__('First Name')" required />
            <x-splade-input type="text" name="last_name" :label="__('Last Name')" required />
            <x-splade-input type="email" name="email" :label="__('Email')" required />
            <x-splade-input type="password" name="password" :label="__('Password')" required autocomplete="new-password" />
            <x-splade-input type="password" name="password_confirmation" :label="__('Confirm Password')" required />

            <div class="flex items-center justify-end">
                <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
                </Link>

                <x-splade-submit class="ml-4" :label="__('Register')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
