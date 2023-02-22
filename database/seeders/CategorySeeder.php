<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Category::create([
            'name' => 'Detektyvai',
            'enabled' => true,
        ]);

        Category::create([
            'name' => 'Trileriai',
            'enabled' => true,
        ]);

        Category::create([
            'name' => 'Romanai',
            'enabled' => true,
        ]);
    }
}