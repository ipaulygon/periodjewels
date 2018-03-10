<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username',50);
            $table->string('password')->default(bcrypt('p@ssw0rd'));
            $table->string('firstName',50);
            $table->string('middleName',50)->nullable();
            $table->string('lastName',50);
            $table->string('contact',20);
            $table->string('email',50)->nullable();
            $table->tinyInteger('level');
            $table->boolean('isActive')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->unique(['firstName', 'middleName','lastName']);            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
