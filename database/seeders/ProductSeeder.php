<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $MaterialCategory = Category::where('full_name->en', 'building materials')->first();
         $detergentsCategory = Category::where('full_name->en', 'detergents')->first();
         $FoodCategory = Category::where('full_name->en', 'Food')->first();
        
       $block =  Product::create([
            'full_name' => [
                'en' => 'block',
                'ar' => 'بلوكة'
             ],
            
            'description' => [
              'en' => 'building building building',
              'ar' => 'بناء بناء بناء ' 
            ],
            'price' =>5000 ,
            'category_id' => $MaterialCategory->id ?? null
        ]);
        $block->categories()->attach($MaterialCategory->id);
       $soap = Product::create([
            'full_name' => [
                'en' => 'soap',
                'ar' => 'صابون'
             ],
            'description' => [
                'en' =>'bacteria bacteria bacteria',
                'ar' => 'بكتيريا بكتيريا بكتيريا'
             ],
            'price' =>3000 ,
            'category_id' => $detergentsCategory->id ?? null
            
        ]);
        $soap->categories()->attach($detergentsCategory->id);
       $pasta = Product::create([
            'full_name' => [
                'en' => 'pasta',
                'ar' => 'معكرونة'
            ],
            'description' => [
                'en' => 'fast fast fast',
                'ar' => 'سريعة سريعة سريعة'
            ],
            'price' =>9000 ,
            'category_id' =>  $FoodCategory->id ?? null
        ]);
        $pasta->categories()->attach($FoodCategory->id);

        
    }
}