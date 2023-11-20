<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            for ($e = 1; $e <= 50; $e++) {
                DB::table('recipients')->insert(
                    [
                        'recipient_type' => 'Email',
                        'recipient' => fake()->unique()->safeEmail(),
                        'allow_status' => rand(0,1),
                        'consent_date' => fake()->dateTime(),
                        'firm_id' => $i,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]
                );
                DB::table('recipients')->insert(
                    [
                        'recipient_type' => 'Sms',
                        'recipient' => fake()->unique()->phoneNumber(),
                        'allow_status' => rand(0,1),
                        'consent_date' => fake()->dateTime(),
                        'firm_id' => $i,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]
                );
            }
        }
    }
}
