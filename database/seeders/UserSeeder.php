<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $admin = User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' =>Hash::make('admin'),
             'phone' => '+123456789',
        ]);
      $admin->roles()->attach(1);

        $admin = User::create([
            'first_name' => 'Umidbek',
            'last_name' => 'Salayev',
            'email' => 'umidbek@gmail.com',
            'password' =>Hash::make('password'),
            'phone' => '+123456799',
        ]);
        $admin->roles()->attach(2);

      User::factory()->count(10)->hasAttached(Role::find(2))->create();
    }
}
