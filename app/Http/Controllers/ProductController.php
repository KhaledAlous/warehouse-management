<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Validator;
class ProductController extends Controller
{
    //
     private $products = [
        ['id' => 1, 'name' => 'elect', 'price' => '10000'],
        ['id' => 2, 'name' => 'software', ' price' => '50000'],
        ['id' => 3, 'name' => 'food', ' price' => '20000'],
     ];
     public function getProducts()
     {
            $products = Product::paginate(2); 
    //     $products =  $this->products;
    //     $products_names = [];
    //     $resp = '';
    //     foreach ($products as $product) {
    //         $products_names[] = $product['name'];
    //         $resp = '<h1>' . $product['name'] . '</h1>';
           
    //     }
    //     //  dd($resp);
    //     //  dd($products_names);
    //     return $resp;
    // }
    // public function productById($id =1) {
    //     $products =  $this->products;
    //     foreach ($products as $product) {
    //         if($product['id']== $id )
    //         {
    //             return $product;
    //         }
    //     }
    //     return 'not found';
     }
    
}