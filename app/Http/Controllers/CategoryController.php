<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 
    private $categories = [
        ['id' => 1, 'name' => 'Material'],
        ['id' => 2, 'name' => 'Electicity'],
        ['id' => 3, 'name' => 'foods']
    ];

    public function showCategories()
    {
        $categories = $this->categories;
        $response = '';
        foreach ($categories as $category) {
            $response .= '<h1>' . $category['name'] . '</h1>';
        }
        return $response;
    }

    public function getCategory($id)
    {
        foreach ($this->categories as $category) {
            if ($category['id'] == $id) {
                return response()->json($category);
            }
        }
        return response()->json(['error' => 'Category not found'], 404);
    }

}