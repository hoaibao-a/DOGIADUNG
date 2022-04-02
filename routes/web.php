<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::post('/tim-kiem', [HomeController::class, 'tim_kiem']);
// danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_product_home']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'details_product']);



// admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout',[AdminController::class, 'log_out']);
Route::get('/add-admin', [AdminController::class, 'add_admin']);
Route::get('/all-admin', [AdminController::class, 'all_admin']);
Route::get('/edit-admin/{AdminID}', [AdminController::class, 'edit_admin']);
Route::get('/delete-admin/{AdminID}', [AdminController::class, 'delete_admin']);

Route::post('/update-admin/{AdminID}', [AdminController::class, 'update_admin']);
Route::post('/save-admin', [AdminController::class, 'save_admin']);
// Route::get('/admin-dashboard',[AdminController::class, 'dashboard']);
Route::post('/admin-dashboard',[AdminController::class, 'dashboard']);



// category product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);


Route::post('/save_category_product', [CategoryProduct::class, 'save_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);


Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);

Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);



//Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);


//cart
Route::post('/save-cart',[CartController::class,'save_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'addCartAjax'])->name('cart.add'); 
Route::post('/update-cart',[CartController::class,'update_cart']);
Route::get('/gio-hang',[CartController::class,'gio_hang']);
Route::get('/del-product/{session_id}',[CartController::class,'del_product']);

//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);

//Order
Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{orderId}', [OrderController::class, 'view_order']);

//Customer
Route::get('/all-customer', [CustomerController::class,'all_customer']);
Route::get('/delete-customer/{customerId}', [CustomerController::class, 'delete_customer']);
Route::get('/edit-customer/{customerId}', [CustomerController::class,'edit_customerr']);
Route::post('/update-customer/{customerId}', [CustomerController::class, 'update_customer']);