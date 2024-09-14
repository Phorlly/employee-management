<x-admin-layout>
    <div class="flex justify-between">
        <div class="py-12">
            <x-link-page href="{{ route('admin.countries.index') }}">
                <x-iconsax-bol-arrow-left-1 class="h-12 w-12" />
            </x-link-page>
        </div>
        <h1 class="font-bold text-2xl py-12 text-gray-800"> {{ __('Country Info') }} </h1>
    </div>

    <div class="container space-x-4">
        <x-splade-form :action="route('admin.countries.store')">
            @csrf

            <div class="container space-y-4">
                <x-splade-input name="country_name" label="Country Name" />
                <x-splade-input name="country_code" label="Country Code" />
                <x-splade-submit class="mt-4 flex justify-end ml-auto rounded-xl" label="Go" :spinner="true" />
            </div>
        </x-splade-form>
    </div>
</x-admin-layout>
