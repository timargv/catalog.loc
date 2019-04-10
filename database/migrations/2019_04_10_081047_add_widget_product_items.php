<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWidgetProductItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->string('status')->after('title')->default('active');
            $table->string('type')->after('status')->default('products');
            $table->string('option')->after('type')->nullable();
        });

        Schema::create('widget_category_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('widget_id')->references('id')->on('widgets')->onDelete('CASCADE');
            $table->integer('category_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->integer('sort')->default(1);
        });

        Schema::create('widget_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('widget_id')->references('id')->on('widgets')->onDelete('CASCADE');
            $table->integer('category_id')->references('id')->on('categories')->onDelete('CASCADE');
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
        Schema::table('widgets', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('type');
            $table->dropColumn('option');
        });
        Schema::dropIfExists('widget_category_items');
        Schema::dropIfExists('widget_categories');
    }
}
