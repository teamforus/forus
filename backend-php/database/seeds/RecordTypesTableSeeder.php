<?php

use App\Models\RecordType;

class RecordTypesTableSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecordType::create([
            'id'        => 1,
            'key'       => 'email',
            'name'      => 'E-mail',
        ]);
    }
}
