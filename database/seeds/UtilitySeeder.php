<?php

use Illuminate\Database\Seeder;

class UtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utility')->insert([
            'name' => 'Periodjewels',
            'address' => '9454 Wilshire Blvd Suite M18 Beverly Hills, CA 90212',
            'logo' => 'img/logo.png'
        ]);
    }
}
