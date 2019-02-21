<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Product::class, function (Faker $faker) {
    return [
        'available' => \App\Entity\Product::AVAILABLE_TRUE,
        'status' => \App\Entity\Product::STATUS_ACTIVE,
        'original_id' => '44150',
        'original_url' => 'https://instrument.ru/betonosmesitel-bsl-180-180-l-700-vt-sibrtekh',
        'name' => 'Бетоносмеситель БСЛ-180, 180 л, 700 Вт. Сибртех - '. random_int(1, 10),
        'name_original' => 'Бетоносмеситель БСЛ-180, 180 л, 700 Вт. Сибртех',
        'price' => random_int(1000, 100000),
        'vendor_price' => random_int(1000, 100000),
        'picture' => 'https://instrument.ru/wa-data/public/shop/products/50/41/44150/images/80206/80206.970.jpg',
        'vendor_code' => '10-95474',
        'vendor_code_original' => '95474',
        'sh_desc' => $faker->realText(150, 2),
        'desc' => $faker->realText(450, 2),

        'type_packaging' => 'Картонная коробка',
        'packing_dimensions' => '810 x 730 x 580',
        'length' => '810',
        'width' => '730',
        'height' => '580',
        'barcode' => $faker->randomNumber(8),
        'weight' => 50,
        'slug' => str_slug(str_random(16)),

        'user_id' => 1,
        'brand_id' => random_int(1, 3),
        'vendor_id' => random_int(1, 3),
        'category_id' => random_int(1, 3),
    ];
});
