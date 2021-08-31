<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Lysander Hans',
            'is_admin' => true,
            'group' => '2384',
            'email' => 'lysander.hans@hotmail.com',
            'avatar' => '1_avatar1630407758.jpg',
            'password' => Hash::make('change_this'),
        ]);
    }
}
