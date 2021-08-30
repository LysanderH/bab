<?php

namespace Database\Seeders;

use App\Models\Bac;
use Illuminate\Database\Seeder;

class BacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bac::create([
            'name' => 'Bac 1'
        ]);

        Bac::create([
            'name' => 'Bac 2'
        ]);

        Bac::create([
            'name' => 'Bac 3'
        ]);
    }
}
