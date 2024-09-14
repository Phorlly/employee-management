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
        <x-splade-form :for="$form" />
        {{-- <x-splade-form method="PUT" :default="$country" :action="route('admin.countries.update', $country)">
            @csrf

            <div class="container space-y-4">
                <x-splade-input name="country_name" label="Country Name" />
                <x-splade-input name="country_code" label="Country Code" />
            </div>

            <div class="mt-12 flex flex-row justify-between">
                <x-link-page href="{{ route('admin.countries.index') }}">
                    <x-iconsax-bol-arrow-left-1 class="h-12 w-12 mt-2" />
                </x-link-page>
                <x-splade-submit class="mt-2 rounded-xl" label="Go" :spinner="true" />
            </div>

        </x-splade-form> --}}
    </div>
</x-admin-layout>
