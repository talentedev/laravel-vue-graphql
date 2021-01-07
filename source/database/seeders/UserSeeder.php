<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'super@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'Super',
            'prenom' => "Admin"
        ]);

        User::create([
            'email' => 'admin@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'School',
            'prenom' => "Admin"
        ]);

        User::create([
            'email' => 'student@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'Student',
            'prenom' => "User"
        ]);
    }
}
