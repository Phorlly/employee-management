<x-admin-layout>
    <div class="flex justify-between">
        <div class="py-12">
            <x-link-page href="{{ route('admin.roles.index') }}">
                <x-iconsax-bol-arrow-left-1 class="h-12 w-12" />
            </x-link-page>
        </div>
        <h1 class="font-bold text-2xl py-12 text-gray-800"> {{ __('Role Info') }} </h1>
    </div>

    <div class="container space-x-4">
        <x-splade-form :default="$role" :action="route('admin.roles.update', $role)" method="PUT" class="space-y-4">
            <x-splade-input name="name" label="Name" />
            {{-- <x-splade-select name="permissions[]" label="Assign Permissions" :options="$permissions" multiple relation choices /> --}}
            <x-splade-checkboxes name="permissions" label="Permissions" :options="$permissions" relation inline />
            <x-splade-submit class="mt-2 flex justify-end ml-auto rounded-xl" label="Go" :spinner="true" />
        </x-splade-form>
    </div>
</x-admin-layout>
