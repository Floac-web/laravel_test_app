<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductCountryPrice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $langs = config('app.support_langs');
            foreach ($langs as $lang) {
                $faker = Faker::create("$lang");
                $product->translations()->create([
                    'locale' => mb_substr($lang, 0, 2),
                    'title' => $faker->realText(100),
                    'description' => $faker->realText(500),
                ]);

                ProductCountryPrice::create([
                    'product_id' => $product->id,
                    'locale' => mb_substr($lang, 0, 2),
                    'price' => fake()->numberBetween(100,150)
                ]);
            }

            CategoryProduct::create([
                'product_id' => $product->id,
                'category_id' => Category::inRandomOrder()->first()->id
            ]);

            gc_collect_cycles();
        });
    }
}
