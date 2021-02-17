<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// ==============Authentication Route=============

// Login
Route::post('/auth/login','Api\Auth\AuthApiController@login');

// Register
Route::post('/auth/register','Api\Auth\AuthApiController@Register');

// Forgot Password
Route::post('/forgotpassword','Api\Auth\ForgotController@ForgotPassword');

// Reset Password
Route::post('/resetpassword','Api\Auth\ForgotController@ResetPassword');

// Auth User
Route::get('/user','Api\Auth\UserController@AuthUser')->middleware('auth:api');

// ==============end Authentication Route=============


// =====================Frontend Route=====================

// Fetch all menu
Route::get('/menus','Api\Frontend\MenuController@AllMenu');

// All Category
Route::get('/categories','Api\Frontend\CategoriesController@Categories');

// Categories with sub Category
Route::get('/categorieswithsub','Api\Frontend\CategoriesController@CategoriesWithSub');

// Sub Categories
Route::get('/subcategories','Api\Frontend\CategoriesController@SubCategories');

// Sub Category Product
Route::get('/subcategoryproduct/{id}','Api\Frontend\ProductController@SubCategoryProduct');

// Category Product
Route::get('/categoryproduct/{id}','Api\Frontend\ProductController@SubCategoryProduct');

// Hot deal product
Route::get('/hotdeal','Api\Frontend\OfferController@hot_deal');

// Offer Product
Route::get('/getone','Api\Frontend\OfferController@GetOne');

// Brand Products
Route::get('/brands','Api\Frontend\BrandController@brands');

// All Product
Route::get('/products','Api\Frontend\ProductController@AllProduct');

// Recent Product
Route::get('/recentproducts','Api\Frontend\ProductController@RecentProducts');

// Single Product
Route::get('/product/{id}','Api\Frontend\ProductController@SingleProduct');

// Product wishlist
Route::get('/wishlist/{id}','Api\Frontend\ProductController@WishlistProduct')->middleware('auth:api');

// Add to cart
Route::post('/addcart/{id}','Api\Frontend\CartController@AddCart')->middleware('auth:api');

// Product remove from cart
Route::get('/itemremove/{id}','Api\Frontend\CartController@RemoveItem')->middleware('auth:api');

// Remove Cart
Route::get('/removecart','Api\Frontend\CartController@RemoveCart')->middleware('auth:api');

// All Cart
Route::get('/allcart','Api\Frontend\CartController@CartDetails')->middleware('auth:api');

// Payments Method
Route::get('/payments','Api\Frontend\PaymentController@AllPaymentMethod');

// Cart Details
Route::get('/orderdetails','Api\Frontend\OrderController@OrderDetails')->middleware('auth:api');

// Order route
Route::post('/order','Api\Frontend\OrderController@OrderStore')->middleware('auth:api');

// Cart Update
Route::post('/cartupdate/{id}','Api\Frontend\CartController@cartQty')->middleware('auth:api');

// =================End Frontend Route====================
