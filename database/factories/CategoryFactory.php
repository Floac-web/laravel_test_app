<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
        return $this->afterCreating(function (Category $category) {
            $langs = config('app.support_langs');
            foreach ($langs as $lang) {
                $faker = Faker::create("$lang");
                $category->translations()->create([
                    'locale' => mb_substr($lang, 0, 2),
                    'name' => $faker->firstName(),
                ]);
            }
        });
    }
}
