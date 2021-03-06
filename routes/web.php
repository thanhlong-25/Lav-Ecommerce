<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryAddressController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use App\Models\UserCustomer;
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

// FRONT E

Route::get('/', [HomeController::class, 'index' ]);
Route::get('/trang-chu', [HomeController::class, 'index' ]);
Route::post('/tim-kiem', [HomeController::class, 'search_product' ]);
Route::get('/404', [HomeController::class], 'error_page');
Route::get('/danh-muc-san-pham/{cate_slug}', [CategoryController::class, 'danh_muc_san_pham' ]);
Route::get('/thuong-hieu-san-pham/{brand_slug}', [BrandController::class, 'thuong_hieu_san_pham' ]);
Route::get('/chi-tiet-san-pham/{product_slug}', [ProductController::class, 'chi_tiet_san_pham' ]);
Route::post('/autocomplete-search',  [HomeController::class, 'autocomplete_search' ]);
Route::get('/contact',  [HomeController::class, 'contact' ]);

// // BACK END
Route::get('/admin', [AdminController::class, 'admin' ]);
Route::get('/dashboard', [AdminController::class, 'show_dashboard' ]);
Route::get('/admin-logout', [AdminController::class, 'admin_logout' ]); // Log out
Route::post('/admin-login', [AdminController::class, 'admin_login' ]); // Log in
Route::get('/register', [AdminController::class, 'register' ]);
Route::post('/admin-register', [AdminController::class, 'admin_register' ]);


// CATEGOTY
Route::post('/add-category', [CategoryController::class, 'add_category' ]);
Route::get('/edit-category/{param_cate_id}', [CategoryController::class, 'edit_category' ]);
Route::post('/update-category/{param_cate_id}', [CategoryController::class, 'update_category' ]);
Route::get('/delete-category/{param_cate_id}', [CategoryController::class, 'delete_category' ]);
Route::get('/list-category', [CategoryController::class, 'list_category' ]);
Route::get('/inactive-status-cate/{param_cate_id}', [CategoryController::class, 'inactive_status_cate' ]);
Route::get('/active-status-cate/{param_cate_id}', [CategoryController::class, 'active_status_cate' ]);

// BRANDS
Route::post('/add-brand', [BrandController::class, 'add_brand' ]);
Route::get('/edit-brand/{param_brand_id}', [BrandController::class, 'edit_brand' ]);
Route::post('/update-brand/{param_brand_id}', [BrandController::class, 'update_brand' ]);
Route::get('/delete-brand/{param_brand_id}', [BrandController::class, 'delete_brand' ]);
Route::get('/list-brand', [BrandController::class, 'list_brand' ]);
Route::get('/inactive-status-brand/{param_brand_id}', [BrandController::class, 'inactive_status_brand' ]);
Route::get('/active-status-brand/{param_brand_id}', [BrandController::class, 'active_status_brand' ]);
Route::post('/tab-brands', [BrandController::class, 'tab_brands' ]); 

// PRODUCTS
Route::post('/add-product', [ProductController::class, 'add_product' ]);
Route::get('/edit-product/{param_product_id}', [ProductController::class, 'edit_product' ]);
Route::post('/update-product/{param_product_id}', [ProductController::class, 'update_product' ]);
Route::get('/delete-product/{param_product_id}', [ProductController::class, 'delete_product' ]);
Route::get('/list-product', [ProductController::class, 'list_product' ]);
Route::get('/inactive-status-product/{param_product_id}', [ProductController::class, 'inactive_status_product' ]);
Route::get('/active-status-product/{param_product_id}', [ProductController::class, 'active_status_product' ]);
Route::post('/rating-product', [ProductController::class, 'rating_product' ]);

// COMMENT
Route::get('/list-comment', [CommentController::class, 'list_comment' ]);
Route::post('/load-comment', [CommentController::class, 'load_comment' ]);
Route::post('/send-comment', [CommentController::class, 'send_comment' ]);
Route::get('/delete-comment/{param_comment_id}', [CommentController::class, 'delete_comment' ]);


//GALLERY
Route::get('/list-gallery/{product_id}', [GalleryController::class, 'list_gallery' ]);
Route::post('/load-gallery', [GalleryController::class, 'load_gallery' ]);
Route::post('/add-gallery/{product_id}', [GalleryController::class, 'add_gallery' ]);
Route::post('/delete-gallery', [GalleryController::class, 'delete_gallery' ]);
Route::post('/update-gallery', [GalleryController::class, 'update_gallery' ]);

// CART
Route::get('/delete-cart/{session_id}', [CartController::class, 'delete_cart' ]);
Route::post('/update-cart', [CartController::class, 'update_cart' ]);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax' ]);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax' ]);

//Check Out and Customer
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout' ]);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout' ]);
Route::post('/register-customer', [CheckoutController::class, 'register_customer' ]);
Route::post('/login-customer', [CheckoutController::class, 'login_customer' ]);
Route::post('/send-orther', [CheckoutController::class, 'send_orther' ]);
Route::get('/forgot-password', [CheckoutController::class, 'forgot_password' ]);
Route::post('/recover-password', [CheckoutController::class, 'recover_password' ]);

//User 
Route::get('/list-user', [UserController::class, 'list_user' ]);
Route::get('/delete-user/{param_customer_id}', [UserController::class, 'delete_user' ]);

//PDF
Route::get('/print-order/{order_id}', [CheckoutController::class, 'print_order' ]);
Route::get('/print-order-convert/{order_id}', [CheckoutController::class, 'print_order_convert' ]);

//Order
Route::get('/view-order/{order_id}', [CheckoutController::class, 'view_order' ]);
Route::get('/list-order', [CheckoutController::class, 'list_order' ]);
Route::post('/update-order-status', [CheckoutController::class, 'update_order_status' ]);

//Email
Route::get('send-mail', [HomeController::class, 'send_mail']);

//Coupon
Route::post('/add-coupon', [CouponController::class, 'add_coupon' ]);
Route::get('/list-coupon', [CouponController::class, 'list_coupon' ]);
Route::get('/edit-coupon/{param_coupon_id}', [CouponController::class, 'edit_coupon' ]);
Route::post('/update-coupon/{param_coupon_id}', [CouponController::class, 'update_coupon' ]);
Route::get('/delete-coupon/{param_coupon_id}', [CouponController::class, 'delete_coupon' ]);
Route::post('/check-coupon', [CouponController::class, 'check_coupon' ]);

//SLider Banner
Route::get('/list-banner', [BannerController::class, 'list_banner' ]);
Route::post('/add-banner', [BannerController::class, 'add_banner' ]);
Route::get('/delete-banner/{param_banner_id}', [BannerController::class, 'delete_banner' ]);
Route::get('/show-banner', [BannerController::class, 'show_banner' ]);
Route::get('/inactive-status-banner/{param_banner_id}', [BannerController::class, 'inactive_status_banner' ]);
Route::get('/active-status-banner/{param_banner_id}', [BannerController::class, 'active_status_banner' ]);


//Delivery
Route::get('/delivery-address',[DeliveryAddressController::class, 'delivery_address' ]);
Route::post('/select-delivery', [DeliveryAddressController::class, 'select_delivery' ]);
Route::post('/add-cost', [DeliveryAddressController::class, 'add_cost' ]);
Route::post('/load-delivery-cost', [DeliveryAddressController::class, 'load_delivery_cost' ]);
Route::post('/update-delivery-cost', [DeliveryAddressController::class, 'update_delivery_cost' ]);

//STATISTICS
Route::post('/filter-by-date', [StatisticsController::class, 'filter_by_date' ]);
Route::post('/filter-by-option', [StatisticsController::class, 'filter_by_option' ]);
Route::post('/load-chart', [StatisticsController::class, 'load_chart' ]);



