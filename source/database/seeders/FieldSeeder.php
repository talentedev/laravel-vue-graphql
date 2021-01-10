<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = array(
            'Computer and Information Sciences',
            'Data Entry Processing',
            'Networking and Telecommunications',
            'Computer Programming',
            'Computer Systems Analysis',
            'Information Technology Management',
            'Software and Computer Media Applications',
            'Ceramic Sciences',
            'Chemical Engineering',
            'Civil Engineering',
            'Ocean Engineering',
            'Surveying',
            'Mechanical Engineering'
        );

        foreach ($fields as $field) {
            DB::table('fields')->insert([
                'name'   => $field
            ]);
        }
    }
}
