<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory(5)->create();

        // User::factory()->create();
       //Category::factory(5)->create();
       Product::factory(10)->create();

        //Product::factory(10)->create();
        //Category::factory(5)->create();
        // CategoryProduct::factory(30)->create();
        // ProductTranslation::factory(30)->create();
        // Basket::factory(30)->create();
        // Category::factory(10)->create();



    }
}
