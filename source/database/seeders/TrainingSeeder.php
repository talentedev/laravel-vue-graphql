<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Training::create([
            'label' => 'Computer and Information License 1',
            'description' => 'this is computer&information course.',
            'school_id' => 1,
            'field_id' => 1,
        ]);

        Training::create([
            'label' => 'Data Entry Processing License 1',
            'description' => 'this is Data Entry Processing course.',
            'school_id' => 1,
            'field_id' => 2,
        ]);

        Training::create([
            'label' => 'Networking and Telecommunications License 1',
            'description' => 'this is Networking and Telecommunications course.',
            'school_id' => 1,
            'field_id' => 3,
        ]);

        Training::create([
            'label' => 'Computer Programming License 1',
            'description' => 'this is Computer Programming course.',
            'school_id' => 2,
            'field_id' => 4,
        ]);

        Training::create([
            'label' => 'Computer Systems Analysis License 1',
            'description' => 'this is Computer Systems Analysis course.',
            'school_id' => 2,
            'field_id' => 5,
        ]);

        Training::create([
            'label' => 'Information Technology Management License 1',
            'description' => 'this is Information Technology Management course.',
            'school_id' => 3,
            'field_id' => 6,
        ]);

        Training::create([
            'label' => 'Software and Computer Media Applications 1',
            'description' => 'this is Software and Computer Media Applications course.',
            'school_id' => 4,
            'field_id' => 7,
        ]);

        Training::create([
            'label' => 'Ceramic Sciences License 1',
            'description' => 'this is Ceramic Sciences course.',
            'school_id' => 5,
            'field_id' => 8,
        ]);

        Training::create([
            'label' => 'Chemical Engineering License 1',
            'description' => 'this is Chemical Engineering course.',
            'school_id' => 5,
            'field_id' => 9,
        ]);

        Training::create([
            'label' => 'Civil Engineering License 1',
            'description' => 'this is Civil Engineering course.',
            'school_id' => 5,
            'field_id' => 10,
        ]);
    }
}
