<?php

use App\Http\Controllers\PageDefaultController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Route::get('/', [PageDefaultController::class, 'index']);
Route::resource('/admin/products', ProductController::class)->middleware('auth');
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('/admin/products', ProductController::class);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
});


Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});
Route::resource('products', ProductController::class);
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class, [
        'as' => 'admin'  // Les routes seront nommées admin.users.index, admin.users.create, etc.
    ]);
});
use App\Http\Controllers\ShopController;

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');




// Middleware 'admin' à créer ensuite (voir étape 2)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


Route::get('/', [ShopController::class, 'index'])->name('home');
use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::post('/panier/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::get('/search', [SearchController::class, 'index'])->name('search');

use App\Http\Middleware\AdminMiddleware;

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
});
use App\Http\Controllers\PaymentController;

Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->middleware('auth');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

use App\Http\Controllers\OrderController;

Route::middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    })->name('profile.edit');
});
Route::middleware(['auth'])->group(function () {
    Route::put('/user/password', [UserPasswordController::class, 'update'])->name('user-password.update');
});
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/checkout/thankyou', [CheckoutController::class, 'thankyou'])->name('orders.thankyou');
use App\Http\Controllers\NotificationController;


Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
