<?php

namespace App\Entity\Shop;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $order_items
 */
class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'delivery_method_id',
        'delivery_method_name',
        'delivery_cost',
        'payment_method',
        'cost',
        'note',
        'current_status',
        'cancel_reason',
        'order_statuses_id',
        'customer_phone',
        'customer_name',
        'delivery_index',
        'delivery_address',
    ];

    //------------------- Товыра в заказе
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
