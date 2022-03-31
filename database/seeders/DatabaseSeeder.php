<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UsersTableSeeder::class);

        // Attaching Categories to Poducts
        $categories = Category::all();

        Product::all()->each(
            fn ($product) => $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            )
        );
    }
}
