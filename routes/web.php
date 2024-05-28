<?php

use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DebtController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderDetailController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VariableController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeolocationController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ShopController;

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

Auth::routes(['register' => true, 'verify' => true]);

Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin'], function () {

        Route::get('/', function () {
            return redirect('admin/dashboard');
        });

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('{key?}', [ProductController::class, 'index'])->name('admin.product');
            Route::post('sort', [ProductController::class, 'sort'])->name('admin.product.sort');
            Route::post('save', [ProductController::class, 'save'])->name('admin.product.save');
            Route::post('create', [ProductController::class, 'create'])->name('admin.product.create');
            Route::post('update', [ProductController::class, 'update'])->name('admin.product.update');
            Route::post('remove', [ProductController::class, 'remove'])->name('admin.product.remove');
        });

        Route::group(['prefix' => 'post'], function () {
            Route::get('{key?}', [PostController::class, 'index'])->name('admin.post');
            Route::post('sort', [PostController::class, 'sort'])->name('admin.post.sort');
            Route::post('save', [PostController::class, 'save'])->name('admin.post.save');
            Route::post('create', [PostController::class, 'create'])->name('admin.post.create');
            Route::post('update', [PostController::class, 'update'])->name('admin.post.update');
            Route::post('remove', [PostController::class, 'remove'])->name('admin.post.remove');
        });

        Route::group(['prefix' => 'image'], function () {
            Route::get('{key?}', [ImageController::class, 'index'])->name('admin.image');
            Route::post('/upload', [ImageController::class, 'upload'])->name('admin.image.upload');
            Route::post('/update', [ImageController::class, 'update'])->name('admin.image.update');
            Route::post('/delete', [ImageController::class, 'delete'])->name('admin.image.delete');
        });

        Route::group(['prefix' => 'catalogue'], function () {
            Route::get('{key?}', [CatalogueController::class, 'index'])->name('admin.catalogue');
            Route::post('sort', [CatalogueController::class, 'sort'])->name('admin.catalogue.sort');
            Route::post('create', [CatalogueController::class, 'create'])->name('admin.catalogue.create');
            Route::post('update', [CatalogueController::class, 'update'])->name('admin.catalogue.update');
            Route::post('remove', [CatalogueController::class, 'remove'])->name('admin.catalogue.remove');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('{key?}', [CategoryController::class, 'index'])->name('admin.category');
            Route::post('sort', [CategoryController::class, 'sort'])->name('admin.category.sort');
            Route::post('create', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('update', [CategoryController::class, 'update'])->name('admin.category.update');
            Route::post('remove', [CategoryController::class, 'remove'])->name('admin.category.remove');
        });

        Route::group(['prefix' => 'transaction'], function () {
            Route::get('{key?}', [TransactionController::class, 'index'])->name('admin.transaction');
            Route::post('create', [TransactionController::class, 'create'])->name('admin.transaction.create');
            Route::post('update', [TransactionController::class, 'update'])->name('admin.transaction.update');
            Route::post('pay', [TransactionController::class, 'pay'])->name('admin.transaction.pay');
            Route::post('remove', [TransactionController::class, 'remove'])->name('admin.transaction.remove');
        });

        Route::group(['prefix' => 'debt'], function () {
            Route::get('{key?}', [DebtController::class, 'index'])->name('admin.debt');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('{key?}', [OrderController::class, 'index'])->name('admin.order');
            Route::post('create', [OrderController::class, 'create'])->name('admin.order.create');
            Route::post('update', [OrderController::class, 'update'])->name('admin.order.update');
            Route::post('remove', [OrderController::class, 'remove'])->name('admin.order.remove');
        });

        Route::group(['prefix' => 'order_detail'], function () {
            Route::get('{key?}', [OrderDetailController::class, 'index'])->name('admin.order_detail');
            Route::post('create', [OrderDetailController::class, 'create'])->name('admin.order_detail.create');
            Route::post('update', [OrderDetailController::class, 'update'])->name('admin.order_detail.update');
            Route::post('remove', [OrderDetailController::class, 'remove'])->name('admin.order_detail.remove');
        });


        Route::group(['prefix' => 'variable'], function () {
            Route::get('{key?}', [VariableController::class, 'index'])->name('admin.variable');
            Route::post('create', [VariableController::class, 'create'])->name('admin.variable.create');
            Route::post('update', [VariableController::class, 'update'])->name('admin.variable.update');
            Route::post('remove', [VariableController::class, 'remove'])->name('admin.variable.remove');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('{key?}', [UserController::class, 'index'])->name('admin.user');
            Route::post('create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('update', [UserController::class, 'update'])->name('admin.user.update');
            Route::post('update/role', [UserController::class, 'updateRole'])->name('admin.user.update.role');
            Route::post('update/password', [UserController::class, 'updatePassword'])->name('admin.user.update.password');
            Route::post('remove', [UserController::class, 'remove'])->name('admin.user.remove');
        });

        Route::group(['prefix' => 'role'], function () {
            Route::get('{key?}', [RoleController::class, 'index'])->name('admin.role');
            Route::post('create', [RoleController::class, 'create'])->name('admin.role.create');
            Route::post('update', [RoleController::class, 'update'])->name('admin.role.update');
            Route::post('remove', [RoleController::class, 'remove'])->name('admin.role.remove');
        });

        Route::group(['prefix' => 'log'], function () {
            Route::get('{key?}', [LogController::class, 'index'])->name('admin.log');
            Route::post('create', [LogController::class, 'create'])->name('admin.log.create');
            Route::post('remove', [LogController::class, 'remove'])->name('admin.log.remove');
        });

        Route::group(['prefix' => 'setting'], function () {
            Route::get('/', [SettingController::class, 'index'])->name('admin.setting');
            Route::post('/companyupdate', [SettingController::class, 'updateCompany'])->name('admin.setting.company.update');
            Route::post('/payupdate', [SettingController::class, 'updatePay'])->name('admin.setting.pay.update');
            Route::post('/mailupdate', [SettingController::class, 'updateMail'])->name('admin.setting.mail.update');
        });
    });
});


Route::group(['middleware' => 'language'], function () {
    Route::get('language/{language}', [HomeController::class, 'languageChange'])->name('lang.change');
});
Route::get('/geolocation/country', [GeolocationController::class, 'getCountry'])->name('geolocation.country');
Route::get('/geolocation/city', [GeolocationController::class, 'getCity'])->name('geolocation.city');
Route::get('/geolocation/district', [GeolocationController::class, 'getDistrict'])->name('geolocation.district');

Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/checkout/success', [CartController::class, 'checkout'])->name('cart.checkout.success');
Route::get('/shop/{catalogue?}/{product?}', [ShopController::class, 'shop'])->name('shop.index');
Route::get('/profile/{page?}/{id?}', [HomeController::class, 'index'])->name('profile.index');
Route::get('/{page?}/{category?}/{post?}', [HomeController::class, 'index'])->name('home.index');
