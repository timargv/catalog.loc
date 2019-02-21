<?php

use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Attribute\AttributeGroup;
use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        Attribute::create([
            'name' => 'Цвет',
            'type' => 'string',
            'group_id' => 1,
            'required' => true,
            'variants' => ['Красный','Белый','Зеленый','Желтый'],
            'sort' => 1,
            'slug' => 'colors',
        ]);

        Attribute::create([
            'name' => 'Объем',
            'type' => 'integer',
            'group_id' => 1,
            'required' => true,
            'variants' => [],
            'sort' => 2,
            'slug' => 'colors',
        ]);

        Attribute::create([
            'name' => 'Высота',
            'type' => 'integer',
            'group_id' => 2,
            'required' => true,
            'variants' => [],
            'sort' => 1,
            'slug' => 'visota',
        ]);

        AttributeGroup::create([
            'name' => 'Основные характеристики',
            'slug' => 'osnovnye-kharakteristiki'
        ]);
        AttributeGroup::create([
            'name' => 'Дополнительно',
            'slug' => 'dopolnitelno'
        ]);
    }
}
