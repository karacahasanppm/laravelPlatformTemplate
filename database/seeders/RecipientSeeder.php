<?php

namespace Database\Seeders;

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
                        'recipient_type' => 'email',
                        'recipient' => fake()->unique()->safeEmail(),
                        'allow_status' => rand(0,1),
                        'consent_date' => fake()->dateTime(),
                        'firm_id' => $i
                    ]
                );
                DB::table('recipients')->insert(
                    [
                        'recipient_type' => 'sms',
                        'recipient' => fake()->unique()->phoneNumber(),
                        'allow_status' => rand(0,1),
                        'consent_date' => fake()->dateTime(),
                        'firm_id' => $i
                    ]
                );
            }
        }
    }
}
