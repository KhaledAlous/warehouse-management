<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::whereHas('products', function($q){
            $q->where('price','5000');
        })->get();
        $categoriess = Category::with('products')->get();
        return response()->json($categories);
        // $categories = Category::withWhereHas('products')->get();
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
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
         $category = Category::create($validated);
        return response()->json($category, 201);
        //   $validated = $request->validate([
        //     'name' => 'required|string|max:255|unique:categories,name',
        // ]);

        // $category = Category::create($validated);

        // return response()->json($category, 201);
        // $validated = $request->validate([
        //     'name' => 'required|array',
        //     'name.en' => 'required|string|max:255',
        //     'name.ar' => 'required|string|max:255',
        // ]);

        // // تحقق من التكرار لكل لغة
        // foreach ($validated['name'] as $locale => $name) {
        //     if (Category::where("name->{$locale}", $name)->exists()) {
        //         return response()->json(['message' => __("The :attribute has already been taken.", ['attribute' => __('name')])], 422);
        //     }
        // }

        // $category = Category::create([
        //     'name' => $validated['name'],
        // ]);

        // return response()->json($category, 201);

   
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::findorFail($id);
        return response()->json($category);
        //  $category = Category::with('products')->findOrFail($id);
        // return response()->json($category);
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
    public function update(Request $request, string $id)
    {
        //
        $category = Category::find($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($validated);
        return response()->json($category);
        //  $category = Category::findOrFail($id);

        // $validated = $request->validate([
        //     'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
        // ]);

        // $category->update($validated);

        // return response()->json($category);
        //  $validatedData = $request->validate([
        //     'name' => 'required|array',
        //     'name.en' => 'required|string|max:255',
        //     'name.ar' => 'required|string|max:255',
        // ]);

        // // تحقق من التكرار لكل لغة باستثناء الفئة الحالية
        // foreach ($validatedData['name'] as $locale => $name) {
        //     if (Category::where("name->{$locale}", $name)->where('id', '!=', $category->id)->exists()) {
        //         return response()->json(['message' => __("The :attribute has already been taken.", ['attribute' => __('name')])], 422);
        //     }
        // }

        // $category->update([
        //     'name' => $validatedData['name'],
        // ]);

        // return response()->json($category);
   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => __('Category deleted successfully!')]);
        // $category = Category::findOrFail($id);
        // $category->delete();

        // return response()->json(null, 204);
    }
    public function indexWithProducts(){
        return Category::with('products')->get();
    }
}