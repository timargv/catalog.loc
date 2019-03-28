<?php

namespace App\Entity\Shop;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_code',
        'price',
        'quantity',
    ];

    //------------------- Заказы на этот товар
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
