<?php

use App\Entity\Shop\OrderStatusesList;
use Illuminate\Database\Seeder;

class OrderStatusesListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatusesList::create([
            'title' => 'Новый',
            'color' => 'green'
        ]);
        OrderStatusesList::create([
            'title' => 'Отменён',
            'color' => 'red'
        ]);
        OrderStatusesList::create([
            'title' => 'Доставлен',
            'color' => '#246eff'
        ]);
    }
}
