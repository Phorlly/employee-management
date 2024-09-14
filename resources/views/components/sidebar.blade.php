<aside
    class="flex flex-col rounded-md w-16 lg:w-56 min-h-screen px-5 lg:px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-col justify-between flex-1">
        <nav class="-mx-3 space-y-6">
            <x-navigate :href="route('admin.index')" :active="isActive('dashboard')">
                <x-iconsax-bol-element-2 class="w-5 h-5" />
                <span class="hidden lg:inline-block mx-2 text-sm font-medium">Dashboard</span>
            </x-navigate>

            <div class="space-y-3">
                <label class="hidden lg:inline-block px-3 text-xs text-gray-500 uppercase dark:text-gray-400">User
                    Management</label>
                <x-navigate :href="route('admin.users.index')" :active="isActive('users')">
                    <x-fas-users class="w-5 h-5" />
                    <span class="hidden lg:inline-block mx-2 text-sm font-medium">Users</span>
                </x-navigate>
                <x-navigate :href="route('admin.roles.index')" :active="isActive('roles')">
                    <x-fas-key class="w-5 h-5" />
                    <span class="hidden lg:inline-block mx-2 text-sm font-medium">Roles</span>
                </x-navigate>
                <x-navigate :href="route('admin.permissions.index')" :active="isActive('permissions')">
                    <x-fas-fingerprint class="w-5 h-5" />
                    <span class="hidden lg:inline-block mx-2 text-sm font-medium">Permisions</span>
                </x-navigate>
            </div>

            <div class="space-y-3">
                <label class="hidden lg:inline-block px-3 text-xs text-gray-500 uppercase dark:text-gray-400">Employee
                    Management</label>
                <x-navigate :href="route('admin.employees.index')" :active="isActive('employees')">
                    <x-fas-user-friends class="w-5 h-5" />
                    <span class="hidden lg:inline-block mx-2 text-sm font-medium">Employees</span>
                </x-navigate>
            </div>

            <div class="space-y-3 ">
                <label class="hidden lg:inline-block px-3 text-xs text-gray-500 uppercase dark:text-gray-400">System
                    Management</label>

                <x-navigate :href="route('admin.countries.index')" :active="isActive('countries')">
                    <x-fas-flag class="w-5 h-5" />
                    <span class="hidden lg:inline-block mx-2 text-sm font-medium">Countries</span>
                </x-navigate>

                <x-navigate :href="route('admin.states.index')" :active="isActive('states')">
                    <x-fas-dungeon class="w-5 h-5" />
                    <span class="hidden lg:inline-block mx-2 text-sm font-medium">States</span>
                </x-navigate>

                <x-navigate :href="route('admin.cities.index')" :active="isActive('cities')">
                    <x-fas-city class="w-5 h-5" />
                    <span class="hidden lg:inline-block mx-2 text-sm font-medium">Cities</span>
                </x-navigate>

                <x-navigate :href="route('admin.departments.index')" :active="isActive('departments')">
                    <x-fas-graduation-cap class="w-5 h-5" />
                    <span class="hidden lg:inline-block mx-2 text-sm font-medium">Departments</span>
                </x-navigate>

            </div>
        </nav>
    </div>
</aside>
