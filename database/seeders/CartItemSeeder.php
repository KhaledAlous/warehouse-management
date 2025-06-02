<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CartItem::create([
            'quantity' => 10,
            'product_id' => 2,
            'user_id' => 1,
        ]);
        CartItem::create([
            'quantity' => 20,
            'product_id' => 3,
            'user_id' => 2,
        ]);
        CartItem::create([
            'quantity' => 50,
            'product_id' => 1,
            'user_id' => 3,
        ]);
    }
}