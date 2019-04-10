<?php
/**
 * Created by PhpStorm.
 * User: Pauk
 * Date: 05.04.2019
 * Time: 14:44
 */

namespace App\UseCases\Widget;


use App\Entity\Shop\Widgets\Widget;
use App\Entity\Shop\Widgets\WidgetCategoryItem;
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
        return Widget::where('status', $this->widget::STATUS_ACTIVE)->with('widgetProductItems', 'widgetCategoryItems')->get();
    }

    public function getWidgetItem($id) {
        return WidgetProductItem::findOrFail($id);
    }

    public function getWidgetCategoryItem ($id) {
        return WidgetCategoryItem::findOrFail($id);
    }

    public function getWidgetItemWhereWidgetProduct($widgetId, $productId) {
        return WidgetProductItem::where([
            ['widget_id', $widgetId],
            ['product_id', $productId]
        ])->first();
    }

    public function getWidgetItemWhereWidgetCategory($widgetId, $categoryId) {
        return WidgetCategoryItem::where([
            ['widget_id', $widgetId],
            ['category_id', $categoryId]
        ])->first();
    }

    public function deleteItem($widget, $itemId) {

        $widget = $this->getWidget($widget->id);

        if ($widget->type == $this->widget::TYPE_PRODUCT) {
            $this->getWidgetItem($itemId)->delete();
            return;
        }
        $this->getWidgetCategoryItem($itemId)->delete();

    }

    public function addVariant($widget, $id) {
        $widget = $this->getWidget($widget->id);

        if($widget->type === $this->widget::TYPE_PRODUCT) {
            $this->addProduct($widget, $id);
            return;
        } $this->addCategory($widget, $id);

    }

    public function addProduct($widget, $id)
    {
        if (!empty($this->getWidgetItemWhereWidgetProduct($widget->id, $id))) {
            throw new \DomainException('Такой товар уже добавлен.');
        }
        WidgetProductItem::create([
            'product_id' => $id,
            'widget_id' => $widget->id,
        ]);

    }

    public function addCategory($widget, $id)
    {

        if (!empty($this->getWidgetItemWhereWidgetCategory($widget->id, $id))) {
            throw new \DomainException('Такая категория уже добавлена.');
        }
        WidgetCategoryItem::create([
            'category_id' => $id,
            'widget_id' => $widget->id,
        ]);

    }

}
