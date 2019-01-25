<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->index();                    // Название редактированое на сайте
            $table->string('name_original')->index();                       // Оригинальное название
            $table->string('name_h1')->nullable()->index();                 // Название для тега H1
            $table->text('description')->nullable();                        // Описание для категории
            $table->string('status')->default('N');                   // Статус Категории N-отключен Y-включено
            $table->string('code')->nullable()->default('000-000');   // Код для категории можно оставить пустым
            $table->integer('count')->nullable()->default('0');       // Количество товаров в Категории
            $table->string('image')->nullable();                            // Картинка для Категории
            $table->string('icon')->nullable();                             // Иконка для Категории
            $table->string('slug')->nullable();                             // URL ЧПУ для Категории
            NestedSet::columns($table);
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
        Schema::dropIfExists('categories');
    }
}
