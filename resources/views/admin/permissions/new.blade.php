<x-admin-layout>
    <div class="flex justify-between">
        <div class="py-12">
            <x-link-page href="{{ route('admin.permissions.index') }}">
                <x-iconsax-bol-arrow-left-1 class="h-12 w-12" />
            </x-link-page>
        </div>
        <h1 class="font-bold text-2xl py-12 text-gray-800"> {{ __('Permission Info') }} </h1>
    </div>

    <div class="container space-x-4">
        <x-splade-form :action="route('admin.permissions.store')" class="space-y-4">
            <x-splade-input name="name" label="Name" />
            {{-- <x-splade-select name="roles[]" label="Assign roles" :options="$roles" multiple relation
                choices /> --}}
            <x-splade-checkboxes name="roles" label="Roles" :options="$roles" relation inline />
            <x-splade-submit class="mt-2 flex justify-end ml-auto rounded-xl" label="Go" :spinner="true" />
        </x-splade-form>
    </div>
</x-admin-layout>
