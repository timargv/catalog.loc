<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('widget_product_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('widget_id')->references('id')->on('widgets')->onDelete('CASCADE');
            $table->integer('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->integer('sort')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widgets');
        Schema::dropIfExists('widget_product_items');
    }
}
