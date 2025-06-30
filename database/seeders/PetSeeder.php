<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;
use Faker\Factory as Faker;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            Pet::create([
                'owner_id' => $faker->numberBetween(1, 12), // Assuming there are 10 owners
                'category_id' => $faker->numberBetween(1, 5), // Assuming there are 5 categories
                'sub_category_id' => $faker->numberBetween(1, 5), // Assuming there are 10 sub-categories
                'name' => $faker->word,
                'slug' => $faker->slug,
                'age' => $faker->numberBetween(1, 15),
                'size' => $faker->randomElement(['small', 'medium', 'large']),
                'location' => $faker->city,
                'about' => $faker->paragraph,
                'meta_title' => $faker->sentence,
                'meta_description' => $faker->paragraph,
                'meta_keywords' => implode(',', $faker->words(5)),
                'gender' => $faker->randomElement(['male', 'female']),
                'price' => $faker->randomFloat(2, 50, 1000), // Random price between 50 and 1000
                'description' => $faker->paragraph,
                // 'is_featured' => $faker->boolean,
                // 'is_top_search' => $faker->boolean,
                'status' => $faker->randomElement(['available', 'sold', 'pending']),
                'likes' => $faker->numberBetween(0, 1000),
            ]);
        }
    }
}
