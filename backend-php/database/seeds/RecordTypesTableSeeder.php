<?php

use \App\Services\Forus\Record\Models\RecordType;

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

        RecordType::create([
            'id'        => 2,
            'key'       => 'bsn',
            'name'      => 'BSN',
        ]);
    }
}
