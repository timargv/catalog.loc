<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->increments('id');
            $table->string('status')->default('active');    // Статус товара активен или нет

            $table->string('available')->default('yeas');   // В наличии или нет

            $table->integer('original_id')->nullable();         // ID в списке поставщика
            $table->string('original_url')->nullable();         // Ссылка на сайт


            // ЦЕНЫ
            $table->float('price');                 // Цена
            $table->float('vendor_price');          // Цена поставщика


            $table->integer('currency_id')->references('id')->on('currency')->default('1');  // Валюта
            $table->integer('user_id')->default(0);
            $table->integer('category_id')->references('id')->on('categories')->default(0);
//            $table->integer('brand_id')->nullable()->references('id')->on('brands');

            $table->string('picture')->nullable();              // Главная Картинка

            $table->string('name')->nullable();                 // Свое Название
            $table->string('name_original')->nullable();        // Оригинальное Название

            $table->integer('vendor_id')->references('id')->on('vendors')->nullable();      // Потсавшик
            $table->string('vendor_code')->nullable();                                      // Артикул
            $table->string('vendor_code_original')->nullable();                             // Артикул Потсавшика

            $table->text('sh_desc')->nullable();                // Крат. Описание
            $table->text('desc')->nullable();                   // Полное описание

            $table->integer('brand_id')->nullable()->default(0);              // Бренд


            $table->string('type_packaging')->nullable();      // Тип упаковки : Катронная коробка
            $table->string('packing_dimensions')->nullable();  // Габариты в упаковке : 810 x 730 x 580 мм
            $table->float('length')->nullable();               // Длина в упаковке : 810 мм
            $table->float('width')->nullable();                // Ширина в упаковке : 730 мм
            $table->float('height')->nullable();               // Высота в упаковке : 580 мм

            $table->string('barcode')->nullable();              // Штрих Код
            $table->float('weight')->nullable();                // Ширина

            $table->string('slug')->nullable();                // URL

            $table->timestamps();
        });

        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->integer('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->integer('attribute_id')->references('id')->on('attributes')->onDelete('CASCADE');
            $table->string('value');
            $table->primary(['product_id', 'attribute_id']);
        });

        Schema::create('product_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->integer('sort')->default(2);
            $table->string('main')->nullable();
            $table->string('file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_photos');
    }
}
