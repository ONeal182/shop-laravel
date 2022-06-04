<?php

namespace Database\Seeders;

use CategoriesTableSeeder;
use Illuminate\Database\Seeder;
use ProductsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(usersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);


    }
}
