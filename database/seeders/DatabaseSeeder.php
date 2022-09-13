<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CouponTypeSeeder;
use Database\Seeders\CouponSubtypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CouponTypeSeeder::class);
        $this->call(CouponSubtypeSeeder::class);
    }
}
