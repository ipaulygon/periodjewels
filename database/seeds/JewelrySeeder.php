<?php

use Illuminate\Database\Seeder;

class JewelrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jewelry')->insert([
            'name' => '-N/A-',
            'description' => ''
        ]);
        DB::table('jewelry')->insert([
            'name' => 'Ring',
            'description' => ''
        ]);
        DB::table('jewelry')->insert([
            'name' => 'Necklace',
            'description' => ''
        ]);
        DB::table('jewelry')->insert([
            'name' => 'Earring',
            'description' => ''
        ]);
        DB::table('jewelry')->insert([
            'name' => 'Bracelet',
            'description' => ''
        ]);
        DB::table('jewelry')->insert([
            'name' => 'Brooch',
            'description' => ''
        ]);
        DB::table('jewelry')->insert([
            'name' => 'Pendant',
            'description' => ''
        ]);
    }
}
