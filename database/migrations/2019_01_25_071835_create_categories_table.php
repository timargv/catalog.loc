<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;
use App\Entity\Category;

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

            $table->integer('shipper_id')->nullable();                      // ID Категории у Поставщика

            $table->string('name')->index();                                // Название редактированое на сайте
            $table->string('name_original')->nullable()->index();           // Оригинальное название
            $table->string('name_h1')->nullable()->index();                 // Название для тега H1

            // Meta Data
            $table->string('meta_description')->nullable();                 // Название для тега Meta Description
            $table->string('meta_title')->nullable();                       // Название для тега Meta Title
            $table->string('meta_keywords')->nullable();                    // Название для тега Meta Keywords

            $table->text('description', 3000)->nullable();                                                // Описание для категории
            $table->string('status', 10)->default(Category::STATUS_ACTIVE);                  // Статус Категории N-отключен Y-включено
            $table->string('code', 7)->nullable()->default('000-000');                       // Код для категории можно оставить пустым
            $table->integer('count')->nullable()->default('0');                                     // Количество товаров в Категории
            $table->string('image')->nullable();                                                          // Картинка для Категории
            $table->string('icon')->nullable();                                                           // Иконка для Категории
            $table->string('slug')->nullable()->unique();                                                 // URL ЧПУ для Категории
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
