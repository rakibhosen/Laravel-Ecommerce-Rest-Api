<?php

use App\Http\Controllers\Backend\PostController;
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

Route::get('/', function () {
    return view('welcome');
})->name('user.dashboard');


// ==========Admin Route===========
Route::group(['prefix'=>'admin', 'namespace'=>'Auth\admin'], function(){
Route::get('dashboard','AdminController@index')->name('admin.dashboard');
Route::get('/','LoginController@showLoginForm')->name('admin.login');
Route::post('/','LoginController@login');
Route::post('logout','LoginController@logout')->name('admin.logout');
Route::post('password/email','ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('password/reset','ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('password/reset','ResetPasswordController@reset')->name('admin.password.update');
Route::get('password/reset/{token} ','ResetPasswordController@showResetForm')->name('admin.password.reset');
});
// ==========End Route


// ========frontend route=================
Route::group(['prefix'=>'admin'], function(){

    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');


});





// ========ecom route =============
Route::group(['prefix'=>'admin', 'namespace'=>'Backend'], function(){
    Route::resource('brands','BrandController');
    Route::resource('categories','CategoriesController');
    Route::resource('subcategories','SubCategoryController');
    Route::resource('products','ProductController');
    Route::get('get/subcat/{id}','CategoriesController@getSubcat');
  
});



Auth::routes();


