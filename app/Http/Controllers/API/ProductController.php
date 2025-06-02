<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Enums\StatusEnum;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function getProducts(){
    //     $product =  $this->products;
        
    // }
    
    public function getProducts(string $id){
        $product = Product::find($id);
        $product->categories()->attach([1,2]);
        $product->categories()->sync([2,3]);
        // $product->categories()->detach($category_id);
    }
    public function collection(){
       
        $product = Product::where()-> pluck('name','description', 'price');
        $product = Product::all()-> filter('name','description', 'price');
        $product = Product::all()->sortBy('price');
    }
    //  $product = product::where()->with('categories')
    
    public function index()
    {
        //
        // return Product::all();
        // return response()->json($products);
         $products = Product::paginate(5);
        return response()->json($products);
       // $products = Product::with('categories')->paginate(5);
        // return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(ProductRequest $request)
    {
        
        
            $product = Product::create($request->validated());
    
     $product ->addMedia($request->hasFile('file') )->toMediaCollection();
           return response()->json(['success' => true, 'product' => $product]);
        //     if ($request->hasFile('main_image')) {
        //     $product->addMediaFromRequest('main_image')->toMediaCollection('main_image');
        // }
        // if ($request->hasFile('gallery_images')) {
        //     foreach ($request->file('gallery_images') as $file) {
        //         $product->addMedia($file)->toMediaCollection('gallery_images');
        //     }
        // }

        
    // $product = Product::create($request->only(['full_name', 'description', 'price']));

    //     if ($request->hasFile('image') && $request->file('image')->isValid()) {
    //         $product->addMediaFromRequest('image')
    //                ->toMediaCollection('product_images');
    //     }

    //     return response()->json($product); 

     // إنشاء منتج جديد في قاعدة البيانات

        // إرجاع المنتج الجديد مع كود حالة 201 Created
       
    
        //  $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'price' => 'required|numeric',
        //     'category_id' => 'required|exists:categories,id',
        //      'category_id' => 'nullable|exists:categories,id',
        //       'category_ids' => 'nullable|array', // مصفوفة من IDs الفئات
        //    'category_ids.*' => 'exists:categories,id', // كل ID في المصفوفة يجب أن يكون موجودًا في جدول الفئات
        // ]);

        // $product = Product::create($validated);
        // return response()->json($product, 201);
        // $product = Product::create([
        //     'name' => $validated['name'],
        //     'description' => $validated['description'],
        //     'price' => $validated['price'],
        //     'category_id' => $validated['category_id'] ?? null, // للحفاظ على العلاقة القديمة
        // ]);

        // // ربط الفئات باستخدام attach()
        // if (isset($validated['category_ids'])) {
        //     $product->categories()->attach($validated['category_ids']);
        // }

        // // إعادة تحميل المنتج مع الفئات المرتبطة لإرجاعها في الاستجابة
        // $product->load('categories');

        // return response()->json($product, 201);
        //  $validated = $request->validate([
        //     'name' => 'required|array', // الاسم الآن مصفوفة (لكل لغة)
        //     'name.en' => 'required|string|max:255',
        //     'name.ar' => 'required|string|max:255',
        //     'description' => 'nullable|array', // الوصف الآن مصفوفة
        //     'description.en' => 'nullable|string',
        //     'description.ar' => 'nullable|string',
        //     'price' => 'required|numeric|min:0',
        //     'category_id' => 'nullable|exists:categories,id',
        //     'category_ids' => 'nullable|array',
        //     'category_ids.*' => 'exists:categories,id',
        // ]);

        // $product = Product::create([
        //     'name' => $validated['name'], // Spatie Translatable سيتعامل مع هذا
        //     'description' => $validated['description'] ?? null,
        //     'price' => $validated['price'],
        //     'category_id' => $validated['category_id'] ?? null,
        // ]);

        // if (isset($validated['category_ids'])) {
        //     $product->categories()->attach($validated['category_ids']);
        // }

        // $product->load('categories');
        // return response()->json($product, 201);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       // $product = Product::find($id); // البحث عن المنتج بواسطة ID

        $product = Product::with('category')->findorfail($id);
        return response()->json($product);
        //  // تحميل الوسائط مع المنتج
        // $product = Product::with('categories', 'media')->where('slug', $slug)->firstOrFail();
        // return response()->json($product);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        //
        // $product = Product::where('slug', $slug)->firstOrFail();
    
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json(['success' => true, 'product' => $product]);
        //  if ($request->hasFile('main_image')) {
        //     $product->clearMediaCollection('main_image'); 
        //     $product->addMediaFromRequest('main_image')->toMediaCollection('main_image');
        // }
        //  if ($request->hasFile('gallery_images')) {
        //     $product->clearMediaCollection('gallery_images');
        //     foreach ($request->file('gallery_images') as $file) {
        //         $product->addMedia($file)->toMediaCollection('gallery_images');
        //     }
        // }


    
        // $product = Product::findOrFail($id);
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'price' => 'required|decimal',
        //     'category_id' => 'required|exists:categories,id',
        // ]);
        // $product->update($validated);
        // return response()->json($product);
          // تحديث الفئات المرتبطة باستخدام sync()
        // if (isset($validated['category_ids'])) {
        //     $product->categories()->sync($validated['category_ids']);
        // } else {
        //     // إذا لم يتم توفير category_ids، قم بإزالة جميع الفئات المرتبطة
        //     $product->categories()->detach();
        // }

        // // إعادة تحميل المنتج مع الفئات المرتبطة لإرجاعها في الاستجابة
        // $product->load('categories');

        // return response()->json($product);
        //  $product = Product::findOrFail($id);

        // $validated = $request->validate([
        //     'name' => 'required|array',
        //     'name.en' => 'required|string|max:255',
        //     'name.ar' => 'required|string|max:255',
        //     'description' => 'nullable|array',
        //     'description.en' => 'nullable|string',
        //     'description.ar' => 'nullable|string',
        //     'price' => 'required|numeric|min:0',
        //     'category_id' => 'nullable|exists:categories,id',
        //     'category_ids' => 'nullable|array',
        //     'category_ids.*' => 'exists:categories,id',
        // ]);

        // $product->update([
        //     'name' => $validated['name'],
        //     'description' => $validated['description'] ?? null,
        //     'price' => $validated['price'],
        //     'category_id' => $validated['category_id'] ?? null,
        // ]);

        // if (isset($validated['category_ids'])) {
        //     $product->categories()->sync($validated['category_ids']);
        // } else {
        //     $product->categories()->detach();
        // }

        // $product->load('categories');
        // return response()->json($product);
  
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => __('Product deleted successfully!')]);
    }
     public function onlyTrashedProducts()
    {
        $trashedProducts = Product::onlyTrashed()->with('categories')->get();
        return response()->json($trashedProducts);
    }
     public function restore($id)
    {
        
        $product = Product::withTrashed()->find($id);

        if (!$product) {
            return response()->json(['message' => 'المنتج غير موجود.'], 404);
        }

        if (!$product->trashed()) {
            return response()->json(['message' => 'المنتج ليس محذوفًا.'], 400);
        }

        $product->restore();
        $product->load('categories');
        // $product->restore();
        // $product->load('categories'); // تحميل الفئات بعد الاستعادة

        // return response()->json($product);

        return response()->json($product);
    }
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);

        if (!$product) {
            return response()->json(['message' => 'المنتج غير موجود.'], 404);
        }

        $product->forceDelete();

        return response()->json(null, 204);
    }
     public function attachCategory(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id', Rule::unique('category_product')->where(function ($query) use ($product) {
                return $query->where('product_id', $product->id);
            })],
        ]);

        $product->categories()->attach($validated['category_id']);
        $product->load('categories'); // إعادة تحميل الفئات المرتبطة

        return response()->json($product, 200);
    }
     public function detachCategory(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        // تحقق مما إذا كانت العلاقة موجودة قبل الفصل
        if (!$product->categories()->where('category_id', $validated['category_id'])->exists()) {
            return response()->json(['message' => 'المنتج غير مرتبط بهذه الفئة.'], 400);
        }

        $product->categories()->detach($validated['category_id']);
        $product->load('categories'); // إعادة تحميل الفئات المرتبطة

        return response()->json($product, 200);
    }
     public function syncCategories(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $product->categories()->sync($validated['category_ids'] ?? []);
        $product->load('categories'); // إعادة تحميل الفئات المرتبطة

        return response()->json($product, 200);
    }
     public function collectionFunctionsDemo(Request $request)
    {
        $allProducts = Product::all(); // جلب جميع المنتجات

        // 1. Pluck: استخراج عمود واحد أو أزواج قيم
        $productNames = $allProducts->pluck('name');
        $productPrices = $allProducts->pluck('price', 'name'); // اسم المنتج كـ key والسعر كـ value

        // 2. Filter: تصفية المنتجات بناءً على شرط
        $expensiveProducts = $allProducts->filter(function ($product) {
            return $product->price > 500;
        });

        $productsWithDescription = $allProducts->filter(function ($product) {
            return !empty($product->description);
        });

        // 3. Sort: فرز المنتجات
        $productsSortedByNameAsc = $allProducts->sortBy('name'); // فرز تصاعدي حسب الاسم
        $productsSortedByPriceDesc = $allProducts->sortByDesc('price'); // فرز تنازلي حسب السعر

        return response()->json([
            'pluck_names' => $productNames->values()->all(), // .values()->all() لتحويلها إلى مصفوفة فهرسية
            'pluck_prices_by_name' => $productPrices->all(),
            'filtered_expensive_products' => $expensiveProducts->values()->all(),
            'filtered_products_with_description' => $productsWithDescription->values()->all(),
            'sorted_by_name_asc' => $productsSortedByNameAsc->values()->all(),
            'sorted_by_price_desc' => $productsSortedByPriceDesc->values()->all(),
        ]);
    }


}

// /*
//  <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session; // استيراد Session

// class ProductController extends Controller
// {
//     // دالة مساعدة لتهيئة المنتجات في الجلسة إذا لم تكن موجودة
//     private function getProducts()
//     {
//         if (!Session::has('products')) {
//             // بيانات افتراضية عند بدء التطبيق أو الجلسة لأول مرة
//             Session::put('products', [
//                 1 => ['id' => 1, 'name' => 'لابتوب ديل XPS 15', 'description' => 'لابتوب قوي ومميز للتصميم والبرمجة.', 'price' => 1800],
//                 2 => ['id' => 2, 'name' => 'سامسونج جالاكسي S24 الترا', 'description' => 'أحدث هاتف ذكي من سامسونج بكاميرا احترافية.', 'price' => 1200],
//                 3 => ['id' => 3, 'name' => 'سماعات سوني WH-1000XM5', 'description' => 'سماعات رأس لاسلكية بخاصية إلغاء الضوضاء الفائقة.', 'price' => 350],
//             ]);
//             Session::put('next_product_id', 4); // لتوليد ID فريد للمنتجات الجديدة
//         }
//         return Session::get('products');
//     }

//     // دالة مساعدة لحفظ المنتجات في الجلسة
//     private function saveProducts($products)
//     {
//         Session::put('products', $products);
//     }

    
//      * 
//       Display a listing of the resource.
//      * يعرض قائمة بجميع المنتجات كـ JSON.
//      *
//      * @return \Illuminate\Http\JsonResponse
     

//    */
//    /*  public function index()
//     {
//         $products = array_values($this->getProducts()); // array_values لإعادة تعيين الفهارس إذا تم حذف منتجات
//         return response()->json($products);
//     }

//     /**
//      * Store a newly created resource in storage.
//      * يخزن منتجًا جديدًا ويعيد بياناته كـ JSON.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\JsonResponse
//      */
   
//      public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'description' => 'nullable|string',
//             'price' => 'required|numeric|min:0',
//         ]);

//         $products = $this->getProducts();
//         $nextId = Session::get('next_product_id');

//         $newProduct = [
//             'id' => $nextId,
//             'name' => $validated['name'],
//             'description' => $validated['description'],
//             'price' => $validated['price'],
//         ];

//         $products[$nextId] = $newProduct;

//         $this->saveProducts($products);
//         Session::put('next_product_id', $nextId + 1);

//         // إرجاع المنتج الجديد مع كود حالة 201 Created
//         return response()->json($newProduct, 201);
//     }

//     /**
//      * Display the specified resource.
//      * يعرض تفاصيل منتج معين كـ JSON.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function show($id)
//     {
//         $products = $this->getProducts();
//         $product = $products[$id] ?? null;

//         if (!$product) {
//             // إرجاع رسالة خطأ 404 كـ JSON
//             return response()->json(['message' => 'المنتج غير موجود.'], 404);
//         }

//         return response()->json($product);
//     }

//     /**
//      * Update the specified resource in storage.
//      * يحدث بيانات منتج موجود ويعيد البيانات المحدثة كـ JSON.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function update(Request $request, $id)
//     {
//         $products = $this->getProducts();

//         if (!isset($products[$id])) {
//             return response()->json(['message' => 'المنتج غير موجود.'], 404);
//         }

//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'description' => 'nullable|string',
//             'price' => 'required|numeric|min:0',
//         ]);

//         $products[$id] = [
//             'id' => (int)$id,
//             'name' => $validated['name'],
//             'description' => $validatedData['description'],
//             'price' => $validatedData['price'],
//         ];

//         $this->saveProducts($products);

//         return response()->json($products[$id]); // إرجاع المنتج المحدث
//     }

//     /**
//      * Remove the specified resource from storage.
//      * يحذف منتجًا معينًا ويعيد رسالة نجاح.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function destroy($id)
//     {
//         $products = $this->getProducts();

//         if (!isset($products[$id])) {
//             return response()->json(['message' => 'المنتج غير موجود.'], 404);
//         }

//         unset($products[$id]);

//         $this->saveProducts($products);

//         // إرجاع استجابة فارغة مع كود 204 No Content للنجاح في الحذف
//         return response()->json(null, 204);
//     }

//     // دوال create و edit لم تعد مطلوبة في API Controller
//     // يمكن حذفها أو تركها فارغة، ولكن يفضل حذفها
//     public function create() { /* */ }
//     public function edit($id) { /* */ }
// } 

// */