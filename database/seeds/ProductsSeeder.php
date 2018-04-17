<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(2) . '_NAME',
            'login' => str_random(2) . 'tima',
            'email' => str_random(3) . '@gmail.com',
            'password' => str_random(3),
        ]);

        DB::table('category')->insert([
            'name' => str_random(2) . '_NAME',
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => str_random(2) . '_NAME',
            'text' => str_random(3) . '_TEXT',
            'image' => str_random(4) . 'jpeg',
            'currency' => 'UAN',
            'price' => 80,
            'user_id' => 1,
        ]);

        DB::table('roles')->insert([
            'name' => str_random(2) . '_NAME',
        ]);

    }
}
