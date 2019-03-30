<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Панель Управления</li>
    <li>
        <a href="{{ route('admin.home') }}">
            <i class="fas fa-tachometer text-blue mr-2"></i> <span>Админ-панель</span>
        </a>
    </li>
    <li><a href="/" target="_blank"><i class="fas fa-share text-red mr-2"></i> <span>На сайт</span></a></li>

    <li class="treeview">
        <a href="#">
            <i class="fas fa-shopping-cart  mr-2"></i> <span>Продажи</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-success">new</small>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fal fa-circle pr-2"></i>
                <span>Список заказов</span>
                <span class="pull-right-container">
                    <small class="label pull-right bg-info">3</small>
                </span>
                </a>
            </li>
            <li><a href="{{ route('admin.order-statuses-list.index') }}"><i class="fal fa-circle pr-2"></i> <span>Статусы заказов</span></a></li>

        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fas fa-inventory  mr-2"></i> <span>Каталог товаров</span>
            <span class="pull-right-container">
                <i class="far fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('admin.categories.index') }}"><i class="fas fa-th-list text-info mr-2"></i> <span>Категории товаров</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-blue">{{ $countCategories }}</small>
            </span>
                </a></li>
            <li><a href="{{ route('admin.products.index') }}"><i class="fab fa-product-hunt text-info mr-2"></i> <span>Список товаров</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-blue">{{ $countProducts }}</small>
            </span>
                </a></li>
            <li><a href="{{ route('admin.attribute-groups.index') }}"><i class="far fa-lock text-info mr-2 pr-1"></i> <span>Атрибуты</span></a></li>
            <li><a href="{{ route('admin.vendors.index') }}"><i class="far fa-truck-container text-info mr-1"></i> <span>Поставщики</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ $countVendors }}</small>
            </span>
                </a></li>

            <li><a href="{{ route('admin.brands.index') }}"><i class="far fa-bars text-info mr-2 pr-1"></i> <span>Бренды</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ $countBrands }}</small>
            </span>
                </a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fas fa-bell mr-2 pr-1"></i> <span>Уведомления</span>
            <span class="pull-right-container">
                <i class="far fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fal fa-circle text-red mr-2"></i> <span>О появлении товара</span></a></li>
            <li><a href="#"><i class="fal fa-circle text-red mr-2"></i> <span>Статусы</span></a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fas fa-headset  mr-2"></i> <span>Обратный звонок</span>
            <span class="pull-right-container">
                <i class="far fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fal fa-circle text-red mr-2 "></i> Список звонков</a></li>
            <li><a href="#"><i class="fal fa-circle text-red mr-2  "></i> Статусы</a></li>
            <li><a href="#"><i class="fal fa-circle text-red mr-2 "></i> Темы</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fas fa-user mr-2 pr-1"></i> <span>Пользователи</span>
            <span class="pull-right-container">
                <i class="far fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('admin.users.index') }}"><i class="fal fa-users-class text-success mr-2"></i> <span>Список пользователей</span></a></li>
            <li><a href="#"><i class="fal fa-comment-alt-lines text-aqua mr-2"></i> <span>Комментария</span></a></li>
            <li><a href="{{ route('admin.carts.index') }}"><i class="fal fa-shopping-basket pr-2"></i> <span>Корзины</span></a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fal fa-cog mr-2"></i> <span>Настройки</span>
            <span class="pull-right-container">
              <i class="far fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
            <li class="treeview">
                <a href="#"><i class="fal fa-circle mr-2 pr-2"></i> Import / Export
                    <span class="pull-right-container">
                      <i class="far fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ route('admin.import.product') }}"><i class="fal fa-arrow-from-bottom text-danger mr-2 pr-1"></i> <span>Import</span></a></li>
                    <li><a href="#"><i class="fal fa-arrow-from-top text-danger mr-2 pr-1"></i> <span>Export</span></a></li>
                </ul>
            </li>
            <li><a href="{{ route('admin.deliveries.index') }}"><i class="fal fa-truck mr-2"></i> Спопсобы доставки</a></li>
        </ul>
    </li>



</ul>
