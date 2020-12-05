<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryAddressController;
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

// FRONT END
Route::get('/', [HomeController::class, 'index' ]);
Route::get('/trang-chu', [HomeController::class, 'index' ]);
Route::post('/tim-kiem', [HomeController::class, 'search_product' ]);
Route::get('/danh-muc-san-pham/{cate_id}', [CategoryController::class, 'danh_muc_san_pham' ]);
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandController::class, 'thuong_hieu_san_pham' ]);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'chi_tiet_san_pham' ]);

// BACK END
Route::get('/admin', [AdminController::class, 'admin' ]);
Route::get('/dashboard', [AdminController::class, 'show_dashboard' ]);
Route::get('/admin-logout', [AdminController::class, 'admin_logout' ]); // Log out
Route::post('/admin-dashboard', [AdminController::class, 'admin_login' ]); // Log in

// CATEGOTY
Route::get('/add-category', [CategoryController::class, 'add_category' ]);
Route::get('/edit-category/{param_cate_id}', [CategoryController::class, 'edit_category' ]);
Route::post('/update-category/{param_cate_id}', [CategoryController::class, 'update_category' ]);
Route::get('/delete-category/{param_cate_id}', [CategoryController::class, 'delete_category' ]);
Route::get('/list-category', [CategoryController::class, 'list_category' ]);
Route::post('/save-category', [CategoryController::class, 'save_category' ]);
Route::get('/unactive-status-cate/{param_cate_id}', [CategoryController::class, 'unactive_status_cate' ]);
Route::get('/active-status-cate/{param_cate_id}', [CategoryController::class, 'active_status_cate' ]);

// BRANDS
Route::get('/add-brand', [BrandController::class, 'add_brand' ]);
Route::get('/edit-brand/{param_brand_id}', [BrandController::class, 'edit_brand' ]);
Route::post('/update-brand/{param_brand_id}', [BrandController::class, 'update_brand' ]);
Route::get('/delete-brand/{param_brand_id}', [BrandController::class, 'delete_brand' ]);
Route::get('/list-brand', [BrandController::class, 'list_brand' ]);
Route::post('/save-brand', [BrandController::class, 'save_brand' ]);
Route::get('/unactive-status-brand/{param_brand_id}', [BrandController::class, 'unactive_status_brand' ]);
Route::get('/active-status-brand/{param_brand_id}', [BrandController::class, 'active_status_brand' ]);

// PRODUCTS
Route::get('/add-product', [ProductController::class, 'add_product' ]);
Route::get('/edit-product/{param_product_id}', [ProductController::class, 'edit_product' ]);
Route::post('/update-product/{param_product_id}', [ProductController::class, 'update_product' ]);
Route::get('/delete-product/{param_product_id}', [ProductController::class, 'delete_product' ]);
Route::get('/list-product', [ProductController::class, 'list_product' ]);
Route::post('/save-product', [ProductController::class, 'save_product' ]);
Route::get('/unactive-status-product/{param_product_id}', [ProductController::class, 'unactive_status_product' ]);
Route::get('/active-status-product/{param_product_id}', [ProductController::class, 'active_status_product' ]);

// CART
Route::get('/delete-cart/{session_id}', [CartController::class, 'delete_cart' ]);
Route::post('/update-cart', [CartController::class, 'update_cart' ]);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax' ]);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax' ]);

//Check Out
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout' ]);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout' ]);
Route::post('/register-customer', [CheckoutController::class, 'register_customer' ]);
Route::post('/login-customer', [CheckoutController::class, 'login_customer' ]);
Route::post('/send-orther', [CheckoutController::class, 'send_orther' ]);

//PDF
Route::get('/print-order/{order_id}', [CheckoutController::class, 'print_order' ]);
Route::get('/print-order-convert/{order_id}', [CheckoutController::class, 'print_order_convert' ]);

// Excel 
Route::post('export-excel', [ProductController::class, 'export_excel']);
Route::post('import-excel', [ProductController::class, 'import_excel']);

//Order
Route::get('/view-order/{order_id}', [CheckoutController::class, 'view_order' ]);
Route::get('/list-order', [CheckoutController::class, 'list_order' ]);
Route::post('/update-order-status', [CheckoutController::class, 'update_order_status' ]);

//Email
Route::get('send-mail', [HomeController::class, 'send_mail']);

//Coupon
Route::get('/add-coupon', [CouponController::class, 'add_coupon' ]);
Route::post('/save-coupon', [CouponController::class, 'save_coupon' ]);
Route::get('/list-coupon', [CouponController::class, 'list_coupon' ]);
Route::get('/edit-coupon/{param_coupon_id}', [CouponController::class, 'edit_coupon' ]);
Route::post('/update-coupon/{param_coupon_id}', [CouponController::class, 'update_coupon' ]);
Route::get('/delete-coupon/{param_coupon_id}', [CouponController::class, 'delete_coupon' ]);
Route::post('/check-coupon', [CouponController::class, 'check_coupon' ]);

//SLider Banner
Route::get('/list-banner', [BannerController::class, 'list_banner' ]);
Route::get('/add-banner', [BannerController::class, 'add_banner' ]);
Route::get('/delete-banner/{param_banner_id}', [BannerController::class, 'delete_banner' ]);
Route::get('/show-banner', [BannerController::class, 'show_banner' ]);
Route::get('/unactive-status-banner/{param_banner_id}', [BannerController::class, 'unactive_status_banner' ]);
Route::get('/active-status-banner/{param_banner_id}', [BannerController::class, 'active_status_banner' ]);
Route::post('/save-banner', [BannerController::class, 'save_banner' ]);


//Delivery
Route::get('/delivery-address',[DeliveryAddressController::class, 'delivery_address' ]);
Route::post('/select-delivery', [DeliveryAddressController::class, 'select_delivery' ]);
Route::post('/add-cost', [DeliveryAddressController::class, 'add_cost' ]);
Route::post('/load-delivery-cost', [DeliveryAddressController::class, 'load_delivery_cost' ]);
Route::post('/update-delivery-cost', [DeliveryAddressController::class, 'update_delivery_cost' ]);




