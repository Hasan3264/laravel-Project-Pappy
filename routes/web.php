<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontendcontrollar;
use App\Http\Controllers\CatController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\subcategorycontroller;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\ArivalBannerController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\QuickPhoneController;
use App\Http\Controllers\OrderBackendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes([
    'login'=>false,
]);
Route::get('/logtoin',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login');
//frontend parts
Route::get('/', [Frontendcontrollar::class, 'index'])->name('homepage');
Route::get('/Product/details/{product_id}', [Frontendcontrollar::class, 'Pro_details'])->name('Product.details');
Route::get('/error', [Frontendcontrollar::class, 'error'])->name('error.get');
Route::post('/getsize', [Frontendcontrollar::class, 'getsize']);
Route::post('/getsizes', [Frontendcontrollar::class, 'getsizes']);
Route::post('/stockout', [Frontendcontrollar::class, 'stockout']);
Route::get('/shop/uniqe', [Frontendcontrollar::class, 'shop'])->name('shop.in');
Route::get('/shop', [Frontendcontrollar::class, 'shop_p'])->name('shop.page');


//customer login all
Route::post('/customer/login', [CustomerLoginController::class, 'login'])->name('customer.login');
//customer register all
Route::get('/customer/register', [CustomerRegisterController::class, 'register'])->name('customer.register');
Route::post('/customer/insert', [CustomerRegisterController::class, 'insert'])->name('customer.insert');
//customer log out
Route::get('/customer/logout', [CustomerRegisterController::class, 'logout'])->name('customer.logout');
//customer desh board
Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
Route::post('/customer/dashboard/update', [CustomerController::class, 'customerinp_update'])->name('customer.dashboard_update');
// cart
Route::post('/customer/cart/insert', [CartController::class, 'cart_insert'])->name('cart.insert');
Route::get('/customer/cart/delete/{cart_id}', [CartController::class, 'cart_remove'])->name('cart.remove');
Route::get('/customer/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/customer/cart/update', [CartController::class, 'update_cart'])->name('cart.update');
//cupon
Route::get('/coupon', [CuponController::class, 'index'])->name('coupon');
Route::post('/coupon/add', [CuponController::class, 'insert'])->name('add.coupon');
//chack out
Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');
Route::post('/getcityId', [CheckOutController::class, 'getcity']);
Route::post('/order/insert', [CheckOutController::class, 'insert'])->name('order.insert');
Route::get('/order/success', [CheckOutController::class, 'order_success'])->name('order.success');
// Route::post('/getunionId', [CheckOutController::class, 'getunion']);
//invoice
Route::get('/order/invoice/{order_id}', [InvoiceController::class, 'download_invoice'])->name('download.invoice');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/ssl/pay', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//stripe
Route::get('stripe', [StripePaymentController::class, 'stripe']);

Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

//review
Route::post('/product/review', [Frontendcontrollar::class, 'review'])->name('product.review');
//pass word reset
Route::get('/password/resat', [CustomerLoginController::class, 'resat_pass'])->name('passsword.reset');
Route::post('/password/resat/store', [CustomerLoginController::class, 'resat_pass_store'])->name('pass.reset.con');
Route::get('/password/resat/form/{token}', [CustomerLoginController::class, 'resat_pass_form'])->name('pass.reset.form');
Route::post('/password/resat/update', [CustomerLoginController::class, 'resat_pass_update'])->name('pass.reset.update');
//email confirm

Route::get('/customer/email/varify/{token}', [CustomerController::class, 'confirm_email_varify']);

//login with github
Route::get('/github/redirect', [GithubController::class, 'redirectToProvider']);
Route::get('/github/callback', [GithubController::class, 'handleToProviderCalback']);

//login with google
Route::get('/google/redirect', [GoogleController::class, 'redirectToProvider']);
Route::get('/google/callback', [GoogleController::class, 'handleToProviderCalback']);
//login with facebook
Route::get('/facebook/redirect', [FacebookController::class, 'redirectToProvider']);
Route::get('/facebook/callback', [FacebookController::class, 'handleToProviderCalback']);
//wishlist part
Route::get('/wishlist', [WishlistController::class, 'wishlist_page'])->name('wishlist.page');
Route::get('/wishlist/insert/{product_id}', [WishlistController::class, 'wishlist_insert'])->name('wishlist.insert');
Route::get('/wishlist/delete/{wishlist_id}', [WishlistController::class, 'wishlist_delete'])->name('wishlist.delete');

//frontend parts  end








//backend parts  ===============================================================================================
//about
// Route::get('/about', [Frontendcontrollar::class, 'about']);
// // home
Route::get('/home', [HomeController::class, 'index'])->name('home');
//users/
Route::get('/users', [HomeController::class, 'users'])->name('users');
Route::get('/users/userdetails', [HomeController::class, 'usersdetails'])->name('usersdetails');
Route::get('/users/delete/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');
Route::post('/name/update', [HomeController::class, 'updatename']);
Route::post('/password/update', [HomeController::class, 'update_pass']);
Route::post('/photo/update', [HomeController::class, 'photo_update']);
//catagory
Route::get('/catagory', [CatController::class, 'index'])->name('add.catagory');
Route::post('/category/insert', [CatController::class, 'insert']);
Route::get('/category/softdelete/{categorysoftdlt_id}', [CatController::class, 'catagory_soft_delete'])->name('cat.softdelete');
Route::get('/category/delete/{categorydlt_id}', [CatController::class, 'catagory_herd_delete'])->name('cat.delete');
Route::get('/category/edit/{categoryedit_id}', [CatController::class, 'catagory_edit'])->name('cat.edit');
Route::post('/category/edit', [CatController::class, 'edit']);
Route::get('/category/restore/{restore_id}', [CatController::class, 'restore'])-> name('cat.restore');
Route::post('/mark/delete', [CatController::class, 'mark_delete']);
Route::post('/mark/restoreall', [CatController::class, 'mark_restore']);
//sub catt
Route::get('/add/sub_catagory', [subcategorycontroller::class, 'index'])->name('add.sub_catagory');
Route::post('/subcategory/Insert', [subcategorycontroller::class, 'insertsub']);
Route::post('/subcategory/update', [subcategorycontroller::class, 'update']);
Route::get('/sub_catagory/edit/{subcategory_id}', [subcategorycontroller::class, 'editsubcat'])->name('edit.subcategory');
Route::get('/subcategory/delete/{subcategorydlt_id}', [subcategorycontroller::class, 'subcategory_herd_delete'])->name('sub.delete');
//product

Route::get('/add/product', [ProductController::class, 'index'])->name('add.product');
Route::post('/getsubcategory', [ProductController::class, 'getsubcategory']);
Route::post('/product/insert', [ProductController::class, 'insert']);
Route::get('/add/product/list', [ProductController::class, 'get_product'])->name('add.product_list');
Route::get('/add/product/edit/{product_id}', [ProductController::class, 'edit_product_page'])->name('edit.product_page');
Route::post('/product/edit/update', [ProductController::class, 'edit_product']);
Route::get('/product/delete/{product_id}', [ProductController::class, 'product_delete'])->name('product.dlt');
//inventory
Route::get('/add/color_size', [InventoryController::class, 'add_color'])->name('add.color_size');
Route::get('/color/delete/{color_id}', [InventoryController::class, 'delete_color'])->name('color.delete');
Route::get('/size/delete/{size_id}', [InventoryController::class, 'size_delete'])->name('size.delete');
Route::post('/color/insert', [InventoryController::class, 'insert_color']);
Route::post('/size/insert', [InventoryController::class, 'insert_size']);
Route::get('/inventory/{product_id}', [InventoryController::class, 'inventory'])->name('inventory');
Route::post('/inventory/insert', [InventoryController::class, 'insert_ventory']);
//role managemaent
Route::get('/role/management', [RoleManagementController::class, 'role_manage'])->name('role.manage');
Route::post('/role/management/parmission', [RoleManagementController::class, 'add_parmission'])->name('add.parmission');
Route::post('/role/management/add/role', [RoleManagementController::class, 'add_role'])->name('add.role');
Route::post('/role/management/role/assign', [RoleManagementController::class, 'assign_role'])->name('assign.role');
Route::get('/permition/edit/{user_id}', [RoleManagementController::class, 'edit_permition'])->name('edit.permition');
Route::get('/permition/update', [RoleManagementController::class, 'update_permition'])->name('update.permission');
//banner
Route::get('banner/add', [bannerController::class, 'banner'])->name('add.banner');
Route::post('banner/added', [bannerController::class, 'banner_add']);
Route::get('bannerstatus/change/{banner_id}', [bannerController::class, 'bannerstatus'])->name('bannerstatus.change');
//quick Sell
Route::get('quick/phone', [QuickPhoneController::class, 'quick_phone'])->name('phone');
Route::post('add/phone', [QuickPhoneController::class, 'add_phone'])->name('add.phone');
Route::get('add/audio', [QuickPhoneController::class, 'audio'])->name('audio');
Route::post('add/audio/add', [QuickPhoneController::class, 'add_audiolist'])->name('add.audiolist');
Route::post('add/audio/final', [QuickPhoneController::class, 'add_audio'])->name('add.audio');
//promotion
Route::get('promotion', [PromotionController::class, 'promotion'])->name('promotion');
Route::post('promotion/add', [PromotionController::class, 'promotion_add'])->name('add.promotion');
Route::get('promotionstatus/change/{promotion_id}', [PromotionController::class, 'promotion_status'])->name('promotion.status');
//new arival banner part\
Route::get('arivalbanner', [ArivalBannerController::class, 'arivalbanner'])->name('arivalbanner');
Route::post('add/arival', [ArivalBannerController::class, 'arival_add'])->name('add.arival');
Route::get('arivalbanner/status/{aribanbanner_id}', [ArivalBannerController::class, 'arivalbannerstatus'])->name('arivalbanner.status');
//brand section
Route::get('brand', [ArivalBannerController::class, 'brand'])->name('brandsection');
Route::post('brand/add', [ArivalBannerController::class, 'brand_add'])->name('add.brand');
//order section 
Route::get('order', [OrderBackendController::class, 'order'])->name('order.sec');
Route::get('order_position/get/{orderposition_id}', [OrderBackendController::class, 'order_position'])->name('order.position');
//backend parts


