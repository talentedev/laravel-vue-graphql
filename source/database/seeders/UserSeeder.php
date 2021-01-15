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
        // Super admin
        User::create([
            'email' => 'super@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'Super',
            'prenom' => "Admin",
            'role' => 'super admin'
        ]);

        // School Admin
        User::create([
            'email' => 'school1@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'School1',
            'prenom' => "Admin",
            'role' => 'school admin',
            'school_id' => 1
        ]);
        User::create([
            'email' => 'school2@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'School2',
            'prenom' => "Admin",
            'role' => 'school admin',
            'school_id' => 2
        ]);
        User::create([
            'email' => 'school3@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'School3',
            'prenom' => "Admin",
            'role' => 'school admin',
            'school_id' => 3
        ]);
        User::create([
            'email' => 'school4@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'School4',
            'prenom' => "Admin",
            'role' => 'school admin',
            'school_id' => 4
        ]);
        User::create([
            'email' => 'school5@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'School5',
            'prenom' => "Admin",
            'role' => 'school admin',
            'school_id' => 5
        ]);

        // Stduents
        User::create([
            'email' => 'student@scoleia.com',
            'password' => bcrypt('secret'),
            'gender' => 1,
            'nom' => 'Student',
            'prenom' => "User",
            'role' => 'student'
        ]);
    }
}
