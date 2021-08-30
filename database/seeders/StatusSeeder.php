<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'Commandé']);
        Status::create(['name' => 'Payé']);
        Status::create(['name' => 'Disponible pour l’enlèvement']);
        Status::create(['name' => 'Retiré']);
        Status::create(['name' => 'Annulé']);
    }
}
