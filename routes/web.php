<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/data', [HomeController::class, 'getProducts'])->name('home.products');

// cart

Route::post('/cart/{id}', [CartController::class, 'add'])->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

Route::get('/cart/increment/{id}', [CartController::class, 'increment'])->name('cart.increment');

Route::get('/cart/decrement/{id}', [CartController::class, 'decrement'])->name('cart.decrement');

Route::get('/cart/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');

Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// categories

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/categories/create/', [CategoryController::class, 'create'])->name('categories.create');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');

Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');







// products

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/filterByCategory', [ProductController::class, 'filterByCategory'])->name('products.filterByCategory');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');

Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


//  Clients

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

Route::get('/clients/{id}', [CLientController::class, 'show'])->name('clients.show');

Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');

Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');

Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');



// Commands

Route::get('/commands', [CommandController::class, 'index'])->name('commands.index');

Route::get('/commands/create', [CommandController::class, 'create'])->name('commands.create');

Route::get('/commands/filterByStatus', [CommandController::class, 'filterByStatus'])->name('commands.filterByStatus');

Route::get('commands/{id}', [CommandController::class, 'show'])->name('commands.show');

Route::post('/commands', [CommandController::class, 'store'])->name('commands.store');

Route::get('/commands/edit/{id}', [CommandController::class, 'edit'])->name('commands.edit');

Route::put('/commands/{id}', [CommandController::class, 'update'])->name('commands.update');

Route::delete('/commands/{id}', [CommandController::class, 'destroy'])->name('commands.destroy');

Route::get('/commands/status/{id}', [CommandController::class, 'status'])->name('commands.status');
});

require __DIR__.'/auth.php';
