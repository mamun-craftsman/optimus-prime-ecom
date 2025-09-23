<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariationController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubcategoryController as ControllersSubcategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/user/login', 'showLogin')->name('login');
    Route::post('/user/login', 'login')->name('login.submit');
    Route::post('/user/logout', 'logout')->name('logout');
    Route::get('/signup', 'showSignup')->name('signup');
    Route::post('/signup', 'signup')->name('signup.submit');
});

Route::controller(CategoryController::class)->middleware(['auth', 'status:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/categories/all', 'index')->name('categories.index');
    Route::get('/categories/fetch', 'fetch')->name('categories.fetch');
    Route::post('/categories/store', 'store')->name('categories.store');
    Route::put('/categories/{category}', 'update')->name('categories.update');
    Route::delete('/categories/{category}', 'destroy')->name('categories.destroy');
});

Route::controller(SubcategoryController::class)->middleware(['auth', 'status:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/subcategories/all', 'index')->name('subcategories.index');
    Route::get('/subcategories/fetch', 'fetch')->name('subcategories.fetch');
    Route::post('/subcategories/store', 'store')->name('subcategories.store');
    Route::put('/subcategories/{subcategory}', 'update')->name('subcategories.update');
    Route::delete('/subcategories/{subcategory}', 'destroy')->name('subcategories.destroy');
    
    Route::get('/categories/fetch-options', 'fetchCategories')->name('categories.fetch-options');
});

Route::controller(ProductController::class)->middleware(['auth', 'status:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products/all', 'index')->name('products.index');
    Route::get('/products/fetch', 'fetch')->name('products.fetch');
    Route::get('/products/create', 'create')->name('products.create');
    Route::post('/products/store', 'store')->name('products.store');
    Route::get('/products/{product}/edit', 'edit')->name('products.edit');
    Route::put('/products/{product}', 'update')->name('products.update');
    Route::delete('/products/{product}', 'destroy')->name('products.destroy');
    
    Route::get('/categories/{categoryId}/subcategories', 'fetchSubcategories')->name('categories.subcategories');
    Route::post('/products/generate-variations', 'generateVariations')->name('products.generate-variations');
    Route::get('/products/attributes', 'getAttributes')->name('products.attributes');
    Route::get('/products/attributes/{attribute}/values', 'getAttributeValues')->name('products.attribute-values');

});


Route::controller(ProductVariationController::class)->middleware(['auth', 'status:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/attributes/all', 'attributeIndex')->name('attributes.index');
    Route::get('/attributes/fetch', 'attributeFetch')->name('attributes.fetch');
    Route::post('/attributes/store', 'attributeStore')->name('attributes.store');
    Route::put('/attributes/{attribute}', 'attributeUpdate')->name('attributes.update');
    Route::delete('/attributes/{attribute}', 'attributeDestroy')->name('attributes.destroy');
    Route::put('/products/{product}/variations/bulk-update', 'bulkUpdateVariations')->name('variations.bulk-update');
    Route::put('/products/{product}/variations/{variation}', 'variationUpdate')->name('variations.update');
    Route::delete('/products/{product}/variations/{variation}', 'variationDestroy')->name('variations.destroy');
});


Route::controller(ControllersCategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::get('/category/{category:slug}', 'show')->name('category.show');
});

// Subcategory Controller Routes
Route::controller(ControllersSubcategoryController::class)->group(function () {
    Route::get('/subcategory/{subcategory:slug}', 'show')->name('subcategory.show');
    Route::get('/category/{category:slug}/subcategories', 'index')->name('subcategories.index');
});

// Product Controller Routes
Route::controller(ControllersProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/search', 'search')->name('products.search');
    Route::get('/product/{product:slug}', 'show')->name('products.show');
    Route::get('/search-products', 'search')->name('products.search');

});

// Cart Controller Routes
Route::controller(CartController::class)
     ->middleware('auth', 'status:customer')
     ->prefix('cart')
     ->name('cart.')
     ->group(function () {
         Route::get('/', 'index')->name('index');
         Route::post('/add', 'add')->name('add');
         Route::patch('/update/{id}', 'update')->name('update');
         Route::delete('/remove/{id}', 'remove')->name('remove');
         Route::post('/clear', 'clear')->name('clear');
         Route::get('/count', 'count')->name('count');
     });


Route::middleware('auth')->group(function () {
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('process');
        Route::get('/success', [CheckoutController::class, 'success'])->name('success');
        Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
    });
});

Route::any('/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');




Route::middleware('auth', 'status:customer')->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'updateProfile'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
        Route::post('/photo', [ProfileController::class, 'updatePhoto'])->name('photo');
        Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [ProfileController::class, 'orderDetails'])->name('order.details');
    });
});

Route::middleware('auth', 'status:customer')->group(function () {
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});




require __DIR__.'/auth.php';
