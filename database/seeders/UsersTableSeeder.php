<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $clientRole = Role::create(['name' => 'client']);

        $adminUser = User::create([
            'name' =>  'admin',
            'email' =>  'admin@admin.com',
            'password' =>  Hash::make(12345678),
            'remember_token' => Str::random(60)
        ]);

        $adminUser->createToken('some token')->accessToken;

        $adminUser->assignRole($adminRole);
    }
}
