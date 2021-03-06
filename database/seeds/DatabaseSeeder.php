<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UtilitySeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(GemSeeder::class);
        $this->call(JewelrySeeder::class);
    }
}
