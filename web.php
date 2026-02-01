<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;

// Global Security & Experience Middlewares
// 'security.headers': Applied to all web routes to add premium safety headers.
Route::middleware(['security.headers'])->group(function () {

// Public Routes

Route::get('/', function () {
    // Need to fetch featured products for Home Page
    $featuredProducts = \App\Models\Product::take(6)->get();
    return view('welcome', compact('featuredProducts'));
})->name('home');

Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/shop/{id}', [ProductController::class, 'show'])->name('shop.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Prevent Spam (Security): 
// We use 'throttle:5,1' which means "allow only 5 attempts per 1 minute".
// This prevents bots from flooding your inbox with automated messages.
Route::post('/contact/send', [ContactController::class, 'sendMessage'])
    ->middleware('throttle:5,1')
    ->name('contact.send');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::patch('/update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');


// Customer Routes
// 'auth': Ensures only logged-in users can enter.
// 'verified': Ensures the user has clicked the verification link in their email.
// 'role:2': Specific check for Customer role.
Route::middleware(['auth', 'verified', 'role:2'])->group(function () {
    Route::get('/dashboard', [OrderController::class, 'index'])->name('dashboard');
    Route::get('/my-messages', [ContactController::class, 'myMessages'])->name('my.messages');
    Route::post('/checkout', [OrderController::class, 'store'])
        ->middleware('cart.not_empty')
        ->name('checkout');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');
});
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    });
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
    Route::post('/messages/{id}/reply', [AdminController::class, 'replyMessage'])->name('messages.reply');
    
    // Products CRUD
    Route::resource('products', ProductController::class);
    
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show'); // Vulnerable Show ID
    Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
});

/*
// Original Secure Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    // ...
});
*/

// Profile (Breeze Default)
Route::middleware('auth')->group(function () {
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

}); // End of Security Headers Group

require __DIR__.'/auth.php';
