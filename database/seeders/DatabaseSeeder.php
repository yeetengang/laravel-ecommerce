<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,50) as $index) {
            $price = $faker->numberBetween($min = 10, $max = 200);
            DB::table('products')->insert([
                'name' => $faker->word,
                'type' => $faker->word,
                'status' => $faker->randomElement(['draft', 'publish']),
                'catalog_visibility' => $faker->randomElement(['hidden', 'visible']),
                'description' => $faker->sentence,
                'regular_price' => $price,
                'sale_price' => $price * 0.8,
                'stock_quantity' => $faker->randomDigit,
                'in_stock' => $faker->boolean,
                'images' => $faker->imageUrl($width = 140, $height = 300),
            ]);
        }
    }
}
