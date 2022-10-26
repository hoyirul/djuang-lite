<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'SUPER ADMIN',
                'email' => 'superadmin@djuang.id',
                'password' => 'password',
                'role_id' => 1
            ],
            [
                'name' => 'ADMIN',
                'email' => 'admin@djuang.id',
                'password' => 'password',
                'role_id' => 2
            ],
            [
                'name' => 'DRIVER',
                'email' => 'driver@djuang.id',
                'password' => 'password',
                'role_id' => 3
            ],
            [
                'name' => 'CUSTOMER',
                'email' => 'customer@djuang.id',
                'password' => 'password',
                'role_id' => 4
            ],
        ];

        foreach($data as $row){
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'role_id' => $row['role_id'],
            ]);
        }
    }
}
