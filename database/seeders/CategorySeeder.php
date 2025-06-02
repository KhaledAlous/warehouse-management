<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'full_name' => [
             'en' => 'building materials',
             'ar' => 'مواد بناء'
            ]
        ]);
        Category::create([
            'full_name' => [
             'en' => 'detergents',
             'ar' => 'المنظفات'
             ]
        ]);
        Category::create([
            'full_name' => [
             'en' => 'Food',
             'ar' => 'طعام'
            ]
        ]);
    }
}