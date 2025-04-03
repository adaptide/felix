<?php

use App\Livewire;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::get('/orders', function () {
        return view('orders.index');
    })->name('orders');
});

Route::get('/products', Livewire\ProductList::class)->name('products');
Route::get('/cart', Livewire\ShoppingCart::class)->name('cart');
Route::get('/checkout', Livewire\Checkout::class)->middleware(['auth'])->name('checkout');
Route::get('/order/confirmation/{order}', Livewire\OrderConfirmation::class)->middleware(['auth'])->name('order.confirmation');

require __DIR__ . '/auth.php';
