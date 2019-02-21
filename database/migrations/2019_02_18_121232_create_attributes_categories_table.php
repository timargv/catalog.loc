<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('attributes_categories');
        Schema::create('attributes_categories', function (Blueprint $table) {
//            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('category_id')->unsigned();
        });

        Schema::table('attributes_categories', function($table) {
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('CASCADE');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes_categories');
    }
}
