<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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

        $user = User::create([
            'name' => 'Hasan',
            'email' => 'superuser@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['SuperUser']);

        $user = User::create([
            'name' => 'Hasan firm 1 admin',
            'email' => 'firm1admin@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['Admin']);

        $user = User::create([
            'name' => 'Hasan firm1 user',
            'email' => 'firm1user@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['User']);

        $user = User::create([
            'name' => 'Hasan firm1 viewer',
            'email' => 'firm1viewer@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['Viewer']);

        $user = User::create([
            'name' => 'Hasan firm1 api',
            'email' => 'firm1api@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['Api']);

        $user = User::create([
            'name' => 'Hasan firm 2 admin',
            'email' => 'firm2admin@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['Admin']);

        $user = User::create([
            'name' => 'Hasan firm2 user',
            'email' => 'firm2user@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['User']);

        $user = User::create([
            'name' => 'Hasan firm2 viewer',
            'email' => 'firm2viewer@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['Viewer']);

        $user = User::create([
            'name' => 'Hasan firm2 api',
            'email' => 'firm2api@gmail.com',
            'password' => Hash::make('password'),
            'firm_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->assignRole(['Api']);

        for ($i = 3; $i <= 50; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'firm_id' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $user->assignRole(['Admin']);
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'firm_id' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $user->assignRole(['User']);
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'firm_id' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $user->assignRole(['Viewer']);
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'firm_id' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $user->assignRole(['Api']);
        }
    }
}
