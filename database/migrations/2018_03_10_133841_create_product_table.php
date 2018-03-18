<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('gemId');
            $table->unsignedInteger('jewelryId');
            $table->double('carat',15,2)->nullable();
            $table->string('color',50)->nullable();
            $table->string('clarity',50)->nullable();
            $table->string('cut',50)->nullable();
            $table->string('origin',50)->nullable();
            $table->text('description');
            $table->double('price',15,2);
            $table->boolean('isSold')->default(0);
            $table->boolean('isActive')->default(1);
            $table->foreign('gemId')
                  ->references('id')->on('gem')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('jewelryId')
                  ->references('id')->on('jewelry')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
