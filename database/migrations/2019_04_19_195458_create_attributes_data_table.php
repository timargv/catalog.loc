<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->integer('attribute_id')->references('id')->on('attributes')->onDelete('CASCADE');
            $table->integer('value_id')->references('id')->on('attribute_values')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes_data');
    }
}
