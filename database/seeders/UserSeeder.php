<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Hasan',
                    'email' => 'karacahasanppm@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'superuser',
                    'firm_id' => 0
                ],
                [
                    'name' => 'Hasan Firm 1 Admin',
                    'email' => 'karacahasanppm2@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'firm_id' => 1
                ],
                [
                    'name' => 'Hasan Firm 1 User',
                    'email' => 'karacahasanppm3@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'firm_id' => 1
                ],
                [
                    'name' => 'Hasan Firm 2 Admin',
                    'email' => 'karacahasanppm4@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'firm_id' => 2
                ],
                [
                    'name' => 'Hasan Firm 2 User',
                    'email' => 'karacahasanppm5@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'firm_id' => 2
                ]
            ]
        );

        for ($i = 3; $i <= 50; $i++) {
            DB::table('users')->insert(
                [
                    'name' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'firm_id' => $i
                ]
            );
        }
        for ($i = 3; $i <= 50; $i++) {
            DB::table('users')->insert(
                [
                    'name' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'firm_id' => $i
                ]
            );
        }
    }
}
