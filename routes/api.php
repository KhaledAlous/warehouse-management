<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductResController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductAPIController;
use APP\Models\Product;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::prefix('products')->group(function (){
    Route::get('/get_all', [ProductAPIController::class, 'getProducts']);
    Route::get('/ById/{id?}', [ProductAPIController::class, 'productById']);
    
});
Route::prefix('product')->group(function (){
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/create', [ProductController::class, 'create']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/delete/{id}', [ProductController::class, 'delete']);
});
Route::apiResource('products', ProductController::class);
Route::get('products/trashed', [ProductController::class, 'onlyTrashedProducts']);
Route::post('products/{product}/restore', [ProductController::class, 'restore']);
Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete']);
Route::prefix('category')->group(function (){
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/create', [CategoryController::class, 'create']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::get('/edit/{id}', [CategoryController::class, 'edit']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
    
});