<?php
/**
 * Created by PhpStorm.
 * User: Pauk
 * Date: 05.04.2019
 * Time: 14:44
 */

namespace App\UseCases\Widget;


use App\Entity\Shop\Widgets\Widget;

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
        return Widget::all();
    }

    public function getProducts() {
        return $this->widget->widgetProductItems()->orderBy('sort')->take(6);
    }

}
