<x-admin-layout>
    <div class="flex justify-between">
        <div class="py-12">
            <x-link-page href="{{ route('admin.users.index') }}">
                <x-iconsax-bol-arrow-left-1 class="h-12 w-12" />
            </x-link-page>
        </div>
        <h1 class="font-bold text-2xl py-12 text-gray-800"> {{ __('User Info') }} </h1>
    </div>

    <div class="container space-x-4">
        <x-splade-form method="PUT" class="space-y-2 grid grid-cols-1 md:grid-cols-2 gap-4" :default="$user"
            :action="route('admin.users.update', $user)">
            @csrf

            <x-splade-input name="first_name" label="First Name" />
            <x-splade-input name="last_name" label="Last Name" />
            <x-splade-input name="username" label="Username" />
            <x-splade-input type="email" name="email" label="Email Address" />
            <x-splade-input name="date_of_birth" label="Date of Birth" date />
            <x-splade-group name="gender" label="Gender" inline>
                <x-splade-radio name="gender" label="Female" value="female" />
                <x-splade-radio name="gender" label="Male" value="male" />
                <x-splade-radio name="gender" label="Other" value="other" />
            </x-splade-group>
            <x-splade-checkboxes name="roles" label="Roles" :options="$roles" relation inline />
            {{-- <x-splade-radios name="roles" label="Roles" :options="$roles" relation inline /> --}}
            <x-splade-checkboxes name="permissions" label="Permissions" :options="$permissions" relation inline />

            <div></div>
            <x-splade-submit label="Go" class="flex justify-end ml-auto rounded-xl" :spinner="true" />

        </x-splade-form>
    </div>
</x-admin-layout>
