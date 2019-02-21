<?php

use App\Entity\Vendor;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'title' => 'ООО «ГК ТСС»',
            'number' => '+7 (495) 258-00-20',
            'email' => 'info@tss.ru',
            'code_product' => '110',
            'address' => '129626, г.Москва, Кулаков переулок, д.6, с.1 метро Алексеевская',
            'url' => 'https://tss.ru/',
            'slug' => 'ooo-gk-tss',
        ]);
    }
}
