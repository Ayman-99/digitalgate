<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        /*for ($i = 0; $i < 30; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
        for ($i = 0; $i < 40; $i++) {
            DB::table('products')->insert([
                'user_id' => 1,
                'category_id' => 1,
                'sku' => Str::random(10),
                'name' => "product-" . rand(10,90),
                'description' => "description",
                'price' => rand(10,90),
                'sale' => rand(0,9),
                'image' => 'img-1616144505.jpg',
                'rate' => 0,
                'meta' => Str::random(50)
            ]);
        }
        for ($i = 0; $i < 30; $i++) {
            DB::table('items')->insert([
                'product_id' => rand(1,35),
                'activated' => 0,
                'value' => 'description',
            ]);
        }*/
        for ($i = 0; $i < 50; $i++) {
            DB::table('rates')->insert([
                'user_id' => rand(1,31),
                'product_id' => rand(1,40),
                'value' => rand(1,5),
            ]);
        }
    }
}
