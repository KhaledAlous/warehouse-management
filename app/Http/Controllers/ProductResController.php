<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductResController extends Controller
{



    private $products = [
        ['id' => 1, 'name' => 'Electronics', 'price' => '10000'],
        ['id' => 2, 'name' => 'Software', 'price' => '50000'],
        ['id' => 3, 'name' => 'Food', 'price' => '20000']
    ];

    public function index()
    {
        return view('products.index', ['products' => $this->products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        // $newProduct = [
        //     'id' => count($this->products) + 1,
        //     'name' => $request->input('name'),
        //     'price' => $request->input('price')
        // ];
        // $this->products[] = $newProduct;

        return redirect()->route('products.index');

    }

    public function edit($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        foreach ($this->products as &$product) {
            if ($product['id'] == $id) {
                $product['name'] = $request->input('name');
                $product['price'] = $request->input('price');
                break;
            }
        }
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->products = collect($this->products)->reject(function ($product) use ($id) {
            return $product['id'] == $id;
        })->toArray();

        return redirect()->route('products.index');
    }
}