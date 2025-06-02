<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductResController;

Route::get('/', function () {
    return view('welcome');
});
    
// Route::prefix('products')->group(function () {
//     Route::get('/get_all', [ProductController::class, 'getProducts']);
//     Route::get('/ById/{id?}', [ProductController::class, 'productById']);
    
// });
Route::prefix('/products')->group(function () {
    Route::get('/', [ProductResController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductResController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductResController::class, 'store'])->name('products.store');
    Route::get('/edit/{id}', [ProductResController::class, 'edit'])->name('products.edit');
    Route::put('/update/{id}', [ProductResController::class, 'update'])->name('products.update');
    Route::delete('/delete/{id}', [ProductResController::class, 'destroy'])->name('products.destroy');
});
// Route::apiResource('products', ProductController::class);


Route::prefix('categories')->group(function(){
    Route::get('/showCategory',[CategoryController::class,'showCategories']);
    Route::get('/ById/{id?}', [CategoryController::class, 'getCategory']);
    
});
//Route::post('/store', [ProductResController::class, 'store'])->name('products.store');
// Route::get('/lang/{locale}', function ($locale) {
//     if (! in_array($locale, ['en', 'ar'])) {
//         abort(400); // لغة غير مدعومة
//     }
//     App::setLocale($locale);
//     session()->put('locale', $locale); // حفظ اللغة في الجلسة

//     return redirect()->back();
// })->name('change_locale');


// Route::get('/', function () {
//     return redirect()->route('web_products.index'); // إعادة توجيه الصفحة الرئيسية إلى قائمة المنتجات
// });

// // تجميع مسارات الويب للمنتجات
// Route::prefix('products')->name('web_products.')->group(function () {
//     Route::resource('/', WebProductController::class)
//         ->parameters(['' => 'product'])
//         ->except(['show']); // يمكن إبقاء show إذا أردت صفحة تفاصيل منفصلة
//     Route::get('/trashed', [WebProductController::class, 'trashed'])->name('trashed');
//     Route::post('/{product}/restore', [WebProductController::class, 'restore'])->name('restore');
//     Route::delete('/{product}/force-delete', [WebProductController::class, 'forceDelete'])->name('force_delete');
// });

// // تجميع مسارات الويب للفئات
// Route::prefix('categories')->name('web_categories.')->group(function () {
//     Route::resource('/', WebCategoryController::class)
//         ->parameters(['' => 'category']);
// });