<div class="min-h-screen bg-gray-100">
    @include('layouts.admin-navigation')

    <div class="flex space-x-4">
        <!-- Sidebar component -->
        @hasanyrole('admin|user')
            <x-sidebar />
        @endhasanyrole

        <!-- Page Content -->
        <main class="flex-1">
            <div class="max-w-6xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
