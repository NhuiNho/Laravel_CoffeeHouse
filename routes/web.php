<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ToppingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Models\Order;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
    // Các route admin khác nằm trong group này
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/{id}/show', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::group(['prefix' => 'menus'], function () {
        Route::get('/', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::get('/create', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::post('/', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::put('/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::get('/{id}/show', [MenuController::class, 'show'])->name('admin.menu.show');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/{id}/show', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/{id}/show', [ProductController::class, 'show'])->name('admin.product.show');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    });

    Route::group(['prefix' => 'product_details'], function () {
        Route::get('/create/{id}', [ProductDetailController::class, 'create'])->name('admin.product_detail.create');
        Route::post('/', [ProductDetailController::class, 'store'])->name('admin.product_detail.store');
        Route::get('/{id}/edit', [ProductDetailController::class, 'edit'])->name('admin.product_detail.edit');
        Route::put('/{id}', [ProductDetailController::class, 'update'])->name('admin.product_detail.update');
        Route::delete('/{id}', [ProductDetailController::class, 'destroy'])->name('admin.product_detail.destroy');

        Route::group(['prefix' => 'sizes'], function () {
            Route::get('/', [SizeController::class, 'index'])->name('admin.product_detail.size.index');
            Route::get('/create', [SizeController::class, 'create'])->name('admin.product_detail.size.create');
            Route::post('/', [SizeController::class, 'store'])->name('admin.product_detail.size.store');
            Route::get('/{id}/show', [SizeController::class, 'show'])->name('admin.product_detail.size.show');
            Route::get('/{id}/edit', [SizeController::class, 'edit'])->name('admin.product_detail.size.edit');
            Route::put('/{id}', [SizeController::class, 'update'])->name('admin.product_detail.size.update');
            Route::delete('/{id}', [SizeController::class, 'destroy'])->name('admin.product_detail.size.destroy');
        });

        Route::group(['prefix' => 'toppings'], function () {
            Route::get('/', [ToppingController::class, 'index'])->name('admin.product_detail.topping.index');
            Route::get('/create', [ToppingController::class, 'create'])->name('admin.product_detail.topping.create');
            Route::post('/', [ToppingController::class, 'store'])->name('admin.product_detail.topping.store');
            Route::get('/{id}/show', [ToppingController::class, 'show'])->name('admin.product_detail.topping.show');
            Route::get('/{id}/edit', [ToppingController::class, 'edit'])->name('admin.product_detail.topping.edit');
            Route::put('/{id}', [ToppingController::class, 'update'])->name('admin.product_detail.topping.update');
            Route::delete('/{id}', [ToppingController::class, 'destroy'])->name('admin.product_detail.topping.destroy');
        });
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/{status}', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('/{id}/show', [OrderController::class, 'show'])->name('admin.order.show');
        Route::put('/{id}/update', [OrderController::class, 'update'])->name('admin.order.update');
        Route::get('/{id}/cancel', [OrderController::class, 'cancel'])->name('admin.order.cancel');
    });

    Route::group(['prefix' => 'vouchers'], function () {
        Route::get('/', [VoucherController::class, 'index'])->name('admin.voucher.index');
        Route::get('/create', [VoucherController::class, 'create'])->name('admin.voucher.create');
        Route::post('/', [VoucherController::class, 'store'])->name('admin.voucher.store');
        Route::get('/{id}/show', [VoucherController::class, 'show'])->name('admin.voucher.show');
        Route::get('/{id}/edit', [VoucherController::class, 'edit'])->name('admin.voucher.edit');
        Route::put('/{id}', [VoucherController::class, 'update'])->name('admin.voucher.update');
        Route::delete('/{id}', [VoucherController::class, 'destroy'])->name('admin.voucher.destroy');
    });
});
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest:admin');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.action');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('user.login');
    Route::post('/login', [AuthController::class, 'loginUser'])->name('user.login.action');
    Route::get('/logout', [AuthController::class, 'logoutUser'])->name('user.logout');
    Route::get('/index', [UserController::class, 'index'])->name('user.index');
    Route::post('/uploadImage/{id}', [UserController::class, 'uploadImage'])->name('user.uploadImage');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/changePassword', [UserController::class, 'showFormChangepw'])->name('user.showFormChangepw');
    Route::post('/changePassword', [UserController::class, 'changepw'])->name('user.changepw');
});

Route::group(['prefix' => 'verify'], function () {
    Route::post('/account', [UserController::class, 'verifyAccount'])->name('verify.account');
    Route::get('/otp/form', [UserController::class, 'showVerifyOtpForm'])->name('verify.otp.form');
    Route::post('/otp/store', [UserController::class, 'store'])->name('verify.otp.account');
    Route::post('/otp/storeOrder', [OrderController::class, 'storeOrder'])->name('verify.otp.order');
    Route::get('/resetpw', [UserController::class, 'showFormResetpw'])->name('verify.showFormResetpw');
    Route::post('/resetpw/check', [UserController::class, 'checkResetpw'])->name('verify.resetpw.check');
    Route::post('/resetpw/update', [UserController::class, 'resetpw'])->name('verify.otp.resetpw');
    Route::post('/otp/getOrder', [OrderController::class, 'getOrder'])->name('verify.otp.getOrder');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');

    Route::group(['prefix' => 'details'], function () {
        Route::get('/{id}/show', [ProductDetailController::class, 'show'])->name('product_details.show');
        Route::post('/{id}/addCart', [CartController::class, 'store'])->name('cart.add');
    });
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::delete('/destroy/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::group(['prefix' => 'order'], function () {
    Route::get('/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/create', [OrderController::class, 'addCoupon'])->name('order.create.addCoupon');
    Route::post('/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/{status}', [OrderController::class, 'index'])->name('order.index');
    Route::get('/{id}/show', [OrderController::class, 'show'])->name('order.show');
    Route::put('/cancel/{id}', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::get('/{id}/rebook', [OrderController::class, 'rebook'])->name('order.rebook');
});

Route::get('/test-email', [UserController::class, 'testEmail'])->name('email.test');
Route::get('/search/order', [OrderController::class, 'searchOrder'])->name('search.order');
Route::post('/search/order/check', [OrderController::class, 'orderCheck'])->name('search.order.check');
