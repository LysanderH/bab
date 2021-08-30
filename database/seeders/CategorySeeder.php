<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Web Multimédia']);
        Category::create(['name' => 'Design Graphique']);
        Category::create(['name' => 'Animation 3D Vidéo']);
    }
}
