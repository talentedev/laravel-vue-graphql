<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'name' => 'Amadou Hampaté Bâ University',
            'description' => 'this is Amadou Hampaté Bâ University.',
            'active' => true
        ]);

        School::create([
            'name' => 'Dakar Bourguiba University',
            'description' => 'this is Dakar Bourguiba University.',
            'active' => true
        ]);

        School::create([
            'name' => 'Euromed Université',
            'description' => 'this is Euromed Université.',
            'active' => true
        ]);

        School::create([
            'name' => 'Suffolk University Dakar Campus',
            'description' => 'this is Suffolk University Dakar Campus.',
            'active' => true
        ]);

        School::create([
            'name' => "L'Université de l'Entreprise",
            'description' => "this is L'Université de l'Entreprise.",
            'active' => true
        ]);
    }
}
