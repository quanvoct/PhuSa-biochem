<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Http\Controllers\HomepageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomepageController::class, 'index'])->name('home.index');
Route::get('/about', [HomepageController::class, 'about'])->name('home.about');
Route::get('/shop', [HomepageController::class, 'shop'])->name('home.shop');
Route::get('/posts', [HomepageController::class, 'posts'])->name('home.posts');
Route::get('/post', [HomepageController::class, 'post'])->name('home.post');
Route::get('/product', [HomepageController::class, 'product'])->name('home.product');
Route::get('/contact', [HomepageController::class, 'contact'])->name('home.contact');
Route::get('/cart', [HomepageController::class, 'cart'])->name('home.cart');
Route::get('/checkout', [HomepageController::class, 'checkout'])->name('home.checkout');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
