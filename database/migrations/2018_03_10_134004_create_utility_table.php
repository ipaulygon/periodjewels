<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('utility', function (Blueprint $table) {
            $table->engine = 'InnoDB';            
            $table->increments('id');
            $table->string('name',100);
            $table->text('address');
            $table->text('logo');
            $table->string('site',150);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utility');
    }
}
