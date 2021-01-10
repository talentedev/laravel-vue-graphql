<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\NationSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\FieldSeeder;
use Database\Seeders\SchoolSeeder;
use Database\Seeders\TrainingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            NationSeeder::class,
            FieldSeeder::class,
            SchoolSeeder::class,
            TrainingSeeder::class
        ]);
    }
}
