<?php

use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DebtController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\LanguageController;
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

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeolocationController;
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
            Route::post('remove', [PostController::class, 'remove'])->name('admin.post.remove');
        });

        Route::group(['prefix' => 'page'], function () {
            Route::get('{key?}', [PostController::class, 'index'])->name('admin.page');
            Route::post('save', [PostController::class, 'save'])->name('admin.page.save');
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

        Route::group(['prefix' => 'language'], function () {
            Route::get('/{key?}', [LanguageController::class, 'index'])->name('admin.language');
            Route::post('create', [LanguageController::class, 'create'])->name('admin.language.create');
            Route::post('update', [LanguageController::class, 'update'])->name('admin.language.update');
        });

        Route::group(['prefix' => 'setting'], function () {
            Route::get('{key?}', [SettingController::class, 'index'])->name('admin.setting');
            Route::post('/company', [SettingController::class, 'updateCompany'])->name('admin.setting.company');
            Route::post('/code', [SettingController::class, 'updateCode'])->name('admin.setting.code');
            Route::post('/popup', [SettingController::class, 'updatePopup'])->name('admin.setting.popup');
            Route::post('/pay', [SettingController::class, 'updatePay'])->name('admin.setting.pay');
            Route::post('/email', [SettingController::class, 'updateEmail'])->name('admin.setting.email');
            Route::post('/recaptcha', [SettingController::class, 'updateRecaptcha'])->name('admin.setting.recaptcha');
            Route::post('/social', [SettingController::class, 'updateSocial'])->name('admin.setting.social');
        });
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('settings', [ProfileController::class, 'settings'])->name('profile.settings');
        Route::post('password', [ProfileController::class, 'password'])->name('profile.password');
        Route::post('avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::get('checkout/success', [CartController::class, 'checkout'])->name('cart.checkout.success');
        Route::post('add', [CartController::class, 'add'])->name('cart.add');
        Route::post('update', [CartController::class, 'update'])->name('cart.update');
        Route::post('remove', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('clear', [CartController::class, 'clear'])->name('cart.clear');
    });
});

Route::group(['middleware' => 'language'], function () {
    Route::get('language/{language?}', [HomeController::class, 'change'])->name('language.change');
});

Route::group(['prefix' => 'geolocation'], function () {
    Route::get('country', [GeolocationController::class, 'getCountry'])->name('geolocation.country');
    Route::get('city', [GeolocationController::class, 'getCity'])->name('geolocation.city');
    Route::get('district', [GeolocationController::class, 'getDistrict'])->name('geolocation.district');
});

Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/shop/{catalogue?}/{product?}', [ShopController::class, 'shop'])->name('shop.index');
Route::get('/{page?}/{category?}/{post?}', [HomeController::class, 'index'])->name('home.index');
