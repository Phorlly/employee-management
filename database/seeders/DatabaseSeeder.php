<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(50)->create();
        $role = Role::create(['name' => 'admin']);
        $user = User::create([
            'first_name' => 'LANN',
            'last_name' => 'Phorlly',
            'name' => full('LANN', 'Phorlly'),
            'username' => username('master'),
            'email' => 'master@system.me',
            'gender' => 'male',
            'phone_number' => '097 32 00 826',
            'date_of_birth' => '1997-03-30',
            'password' => bcrypt('Master@123'),
        ]);
        $user->assignRole($role);
    }
}
