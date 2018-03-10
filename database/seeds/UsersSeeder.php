<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('p@ssw0rd'),
            'firstName' => 'Paul Andrei',
            'middleName' => 'Navarro',
            'lastName' => 'Cruz',
            'contact' => '09054090523',
            'email' => 'paulandrei@ymail.com',
            'level' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
