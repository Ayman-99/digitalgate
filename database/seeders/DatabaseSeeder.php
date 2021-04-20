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
        $product = 1;
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name' => "User_" . $i,
                'email' => "User_" . $i . '@gmail.com',
                'password' => Hash::make('password'),
            ]);

            for($temp = 1; $temp < 20; $temp++){
                DB::table('products')->insert([
                    'user_id' => $i,
                    'category_id' => 1,
                    'sku' => Str::random(10),
                    'name' => "product-" . $product,
                    'description' => "description",
                    'price' => rand(10, 90),
                    'sale' => rand(0, 9),
                    'image' => 'img-1616144505.jpg',
                    'rate' => 0,
                    'meta' => Str::random(50)
                ]);
                for ($iii = 1; $iii <= 10; $iii++) {
                    DB::table('items')->insert([
                        'product_id' => $product,
                        'activated' => 0,
                        'value' => 'val' . $iii,
                    ]);
                }
                $product++;
            }
        }
    }
}
