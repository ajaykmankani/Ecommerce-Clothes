<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',\App\Http\Livewire\HomeComponent::class)->name('home.index');

Route::get('/shop',\App\Http\Livewire\ShopComponent::class)->name('shop');

Route::get('/product/{slug}',\App\Http\Livewire\DetailsComponent::class)->name('product.details');

Route::get('/cart',\App\Http\Livewire\CartComponent::class)->name('shop.cart');

Route::get('/wishlist',\App\Http\Livewire\WishlistComponent::class)->name('shop.wishlist');

Route::get('/checkout',\App\Http\Livewire\CheckoutComponent::class)->name('shop.checkout');

Route::get('/product-category/{slug}}',\App\Http\Livewire\CategoryComponent::class)->name('product.category');

Route::get('/search',\App\Http\Livewire\SearchComponent::class)->name('product.search');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function (){
    Route::get('/user/dashboard',\App\Http\Livewire\User\UserDashboardComponent::class)->name('user.dashboard');
});

Route::middleware(['auth','auth-admin'])->group(function (){
    Route::get('/admin/dashboard',\App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories',\App\Http\Livewire\Admin\AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add',\App\Http\Livewire\Admin\AdminAddCategoryComponent::class)->name('admin.category.add');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
