<?php
/**
 * Created by PhpStorm.
 * User: Pauk
 * Date: 05.04.2019
 * Time: 14:44
 */

namespace App\UseCases\Widget;


use App\Entity\Shop\Widgets\Widget;
use App\Entity\Shop\Widgets\WidgetProductItem;

class WidgetService
{

    public $widget;

    public function __construct(Widget $widget)
    {
        $this->widget = $widget;
    }

    public function getWidget($id) {
        return Widget::findOrFail($id);
    }

    public function getAll() {
        return Widget::with('widgetProductItems')->get();
    }

    public function getWidgetItem($id) {
        return WidgetProductItem::findOrFail($id);
    }

    public function getWidgetItemWhereWidgetProduct($widgetId, $productId) {
        return WidgetProductItem::where([
            ['widget_id', $widgetId],
            ['product_id', $productId]
        ])->first();
    }

    public function deleteItem($itemId) {
        $this->getWidgetItem($itemId)->delete();
    }

    public function addProduct($widget, $productId)
    {
        $widget = $this->getWidget($widget->id);

        if (!empty($this->getWidgetItemWhereWidgetProduct($widget->id, $productId))) {
            throw new \DomainException('Такой товар уже добавлен.');
        }

        WidgetProductItem::create([
            'product_id' => $productId,
            'widget_id' => $widget->id,
        ]);

    }

}
