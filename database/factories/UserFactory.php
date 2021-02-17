<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

// category

$factory->define(Category::class, function (Faker $faker) {
    return [
        'category_name' =>'Electronic',
    ];
});

$factory->define(Subcategory::class, function (Faker $faker) {
    return [
        'subcat_name' => 'mobile',
        'cat_id'=>1,
    ];
});
// brand
$factory->define(Brand::class, function (Faker $faker) {
    return [
        'brand_name' => 'Apple',
    ];
});
// subCat



// product

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name'=>'I Phone X',
        'product_price'=>rand(100,1000),
        'product_color'=>'Blue',
        'product_size'=>'Medium',
        'product_quantity'=>10,
        'cat_id'=>1,
        'subcat_id'=>1,
        'product_stockout'=>1,
        'product_buy_one_get_one'=>1,
        'product_status'=>1,
        'product_offer_price'=>rand(100,500),
        'product_image'=>json_encode([
                  "default1.jpg",
                  "default2.jpg", 
        ]),
        'admin_id'=>1,
        'product_description'=>$faker->paragraph,
        'product_hot_deal'=>1,
        'product_slug'=>'product-slug',
        'brand_id'=>1
    ];
});
