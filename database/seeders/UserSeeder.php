<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $guruRole = Role::where('name', 'guru')->first();
        $orangTuaRole = Role::where('name', 'orang_tua')->first();

        // Admin
        // Admin
        User::firstOrCreate(['email' => 'admin@bimbel.com'], [
            'username' => 'admin',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Administrator',
            'no_telepon' => '081234567890',
            'role_id' => $adminRole->id,
            'is_active' => true
        ]);

        // Guru 1
        User::firstOrCreate(['email' => 'guru1@bimbel.com'], [
            'username' => 'guru1',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Ahmad Syahputra',
            'no_telepon' => '081234567891',
            'role_id' => $guruRole->id,
            'is_active' => true
        ]);

        // Guru 2
        User::firstOrCreate(['email' => 'guru2@bimbel.com'], [
            'username' => 'guru2',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Siti Nurhaliza',
            'no_telepon' => '081234567892',
            'role_id' => $guruRole->id,
            'is_active' => true
        ]);

        // Orang Tua 1
        User::firstOrCreate(['email' => 'orangtua1@gmail.com'], [
            'username' => 'orangtua1',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Budi Santoso',
            'no_telepon' => '081234567893',
            'role_id' => $orangTuaRole->id,
            'is_active' => true
        ]);

        // Orang Tua 2
        User::firstOrCreate(['email' => 'orangtua2@gmail.com'], [
            'username' => 'orangtua2',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Dewi Kusuma',
            'no_telepon' => '081234567894',
            'role_id' => $orangTuaRole->id,
            'is_active' => true
        ]);
    }
}