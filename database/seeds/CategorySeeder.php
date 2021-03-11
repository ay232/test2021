<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seedeng categories with products
        factory(\App\Models\Category::class, 10)->create()->each(function ($category) {
            $category->products()->createMany(
                factory(\App\Models\Product::class, 5)->make()->toArray()
            );
        });
        //seeding empty categories
        factory(\App\Models\Category::class, 5)->create();

    }
}
