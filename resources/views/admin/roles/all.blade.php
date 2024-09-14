<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="font-bold text-2xl py-12 text-gray-800"> {{ __('Roles List') }} </h1>
        <div class="py-12">
            <x-link-page href="{{ route('admin.roles.create') }}" class="text-blue-500 hover:text-blue-800 px-8">
                <x-fas-circle-plus class="w-7 h-7" />
            </x-link-page>
        </div>
    </div>

    <x-splade-table :for="$tables" striped search-debounce="500" as="$table" pagination-scroll="head">
        <x-splade-cell actions>
            <x-link-page href="{{ route('admin.roles.edit', $table) }}" class="text-yellow-400 hover:text-yellow-600">
                <x-iconsax-lin-edit class="w-6 h-6" />
            </x-link-page>

            <x-link-page href="{{ route('admin.roles.destroy', $table) }}" method="DELETE" confirm="Are you sure?"
                confirm-text="Remove: {{ $table->name }}" confirm-button="Yes" cancel-button="No"
                class="text-red-400 hover:text-red-600">
                <x-fas-trash-can class="w-6 h-6 mx-4" />
            </x-link-page>

        </x-splade-cell>
    </x-splade-table>
</x-admin-layout>
