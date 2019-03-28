<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('delivery_method_id');   // ID Метода доставки
            $table->string('delivery_method_name');  // Название доставки
            $table->integer('delivery_cost');        // Стоимость доставки
            $table->string('payment_method');        // Способ Оплаты
            $table->float('cost', 8, 2); // Стоимость заказа
            $table->text('note')->nullable();        // Комментария к заказу
            $table->integer('current_status');       // Текущее состояние
            $table->text('cancel_reason');           // Причина отмены
            $table->integer('order_statuses_id');    // ID Статус заказа
            $table->string('customer_phone');        // Телефон клиента
            $table->string('customer_name');         // Имя клиента
            $table->string('delivery_index');        // Почтовый индекс
            $table->string('delivery_address');      // Адрес доставки

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
        Schema::dropIfExists('orders');
    }
}
