<x-admin-layout>
    <div class="flex justify-between">
        <div class="py-12">
            <x-link-page href="{{ route('admin.employees.index') }}">
                <x-iconsax-bol-arrow-left-1 class="h-12 w-12" />
            </x-link-page>
        </div>
        <h1 class="font-bold text-2xl py-12 text-gray-800"> {{ __('Employee Info') }} </h1>
    </div>

    <div class="container space-x-4">
        <x-splade-form :for="$form" />
    </div>
</x-admin-layout>
