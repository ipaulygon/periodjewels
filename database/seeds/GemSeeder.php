<?php

use Illuminate\Database\Seeder;

class GemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gem')->insert([
            'name' => 'Diamond',
            'description' => ''
        ]);
        DB::table('gem')->insert([
            'name' => 'Sapphire',
            'description' => ''
        ]);
        DB::table('gem')->insert([
            'name' => 'Ruby',
            'description' => ''
        ]);
        DB::table('gem')->insert([
            'name' => 'Emerald',
            'description' => ''
        ]);
        DB::table('gem')->insert([
            'name' => 'Pearl',
            'description' => ''
        ]);
        DB::table('gem')->insert([
            'name' => 'Coral',
            'description' => ''
        ]);
        DB::table('gem')->insert([
            'name' => 'Gold',
            'description' => ''
        ]);
    }
}
