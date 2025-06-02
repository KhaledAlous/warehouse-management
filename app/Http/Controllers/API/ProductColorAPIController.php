<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\StatusEnum;
use App\Models\ProductColor;

class ProductColorAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $colors = ProductColor::with('media')->get(); 
        return response()->json($colors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    //      $color = ProductColor::create([
    //         'name' => $request->validated('name'),
    //         'hex_code' => $request->validated('hex_code'),
    //         'status' => $request->validated('status') ?? StatusEnum::ACTIVE,
    //     ]);

    //     if ($request->hasFile('swatch_image')) {
    //         $color->addMediaFromRequest('swatch_image')->toMediaCollection('swatch_image');
    //     }

    //     $color->load('media'); 
    //     return response()->json($color, 201);
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}