<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
class ProductAPIController extends APIController
{
    //
     public function getProducts(Request $request)
    {
        $search = $request->search; // $request->input('search');
        $active = $request->active;
        $order = $request->order??'asc'; // $request->input('order', 'asc');
        $locale = $request->header('locale')??'en';
        $by_new_users = $request->input('by_new_users', 0);
        $limit = $request->input('limit', 10);
        //$page = $request->input('page', 0);

        $products = new Product;
        if($search != null)
        {   
            $products = $products->where('name', 'like', '%'.$search.'%');
        }
        if($active != null)
        {
            $products = $products->where('active', $active);
        }

        if($by_new_users)
        {
            $date = '2025-04-01';
            $products = $products->whereHas('user', function($query) use($date){
                $query->whereDate('email_verified_at', '>', $date);
            });
        }
        
        $products_count = (clone $products)->count();
        $products = $products/*->skip(($page-1) * $limit)->take($limit)*/->orderBy('price', $order)->with('user')->paginate($limit);

        // $data = [
        //     'products' => $products,
        //     'count' => $products_count
        // ];

        return $this->sendResponse($products, $locale=='en'?'products retrieved successfully':'تم عرض كل المنتجات');
    }

    public function productById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|unique:products,id',
        ],
        [
            // 'product_id.required' => 'not found',
            // 'product_id.exists' => 'not exists',
            'product_id.*' => 'error',
        ]);

        if ($validator->fails()) {    
            return $this->sendError($validator->messages()->first()); 
        }
        
        
        $product = Product::find($request->product_id);
        // $product = Product::where('id', $id)->first();

        return $this->sendResponse($product, 'product retrieved successfully');
    }

    public function createProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|min:5|max:200',
            'price' => 'required|numeric|min:100',
            'description' => 'nullable',
            'active' => 'in:0,1'
        ]);

        if ($validator->fails()) {    
            return $this->sendError($validator->messages()->first()); 
        }

        $input = $request->all();

        $product = Product::create($input);

        return $this->sendResponse($product, 'product created successfully', 201);
    }

    public function updateProduct(Request $request, $id)
    {
        $input = $request->all();

        $product = Product::where('id', $id)->update($input);

        return $this->sendResponse(null, 'product updated successfully');
    }

    public function deleteProduct(Request $request, $id)
    {
        // $id = $request->id;

        Product::where('id', $id)->delete(); //Product::destory($id);

        return $this->sendResponse(null, 'product deleted successfully');
    }

}