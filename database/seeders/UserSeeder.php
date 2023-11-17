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
                    'email' => 'superuser@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'superuser',
                    'firm_id' => 0
                ],
                [
                    'name' => 'Hasan Firm 1 Admin',
                    'email' => 'firm1admin@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'firm_id' => 1
                ],
                [
                    'name' => 'Hasan Firm 1 User',
                    'email' => 'firm1user@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'firm_id' => 1
                ],
                [
                    'name' => 'Hasan Firm 1 Api',
                    'email' => 'firm1api@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'api',
                    'firm_id' => 1
                ],
                [
                    'name' => 'Hasan Firm 2 Admin',
                    'email' => 'firm2admin@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'firm_id' => 2
                ],
                [
                    'name' => 'Hasan Firm 2 User',
                    'email' => 'firm2user@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'firm_id' => 2
                ],
                [
                    'name' => 'Hasan Firm 2 Api',
                    'email' => 'firm2api@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'api',
                    'firm_id' => 2
                ],
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
        for ($i = 3; $i <= 50; $i++) {
            DB::table('users')->insert(
                [
                    'name' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'password' => Hash::make('password'),
                    'role' => 'api',
                    'firm_id' => $i
                ]
            );
        }
    }
}
