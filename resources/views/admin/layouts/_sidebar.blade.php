<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Панель Управления</li>
    <li>
        <a href="{{ route('admin.home') }}">
            <i class="fas fa-tachometer text-blue mr-2"></i> <span>Админ-панель</span>
        </a>
    </li>
    <li><a href="/" target="_blank"><i class="fas fa-sitemap text-red mr-2"></i> <span>На сайт</span></a></li>



    <li class="header">Заказы</li>
    <li><a href="#"><i class="fas fa-shopping-basket text-success mr-2"></i>
            <span>Список заказов</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
            </span>
        </a>
    </li>
    <li><a href="#"><i class="fal fa-align-justify text-danger mr-2 pr-1"></i> <span>Статусы заказов</span></a></li>

    <li class="header">Каталог Товаров</li>
    <li><a href="{{ route('admin.categories.index') }}"><i class="fas fa-th-list text-info mr-2"></i> <span>Категории товаров</span></a></li>
    <li><a href="#"><i class="fab fa-product-hunt text-info mr-2"></i> <span>Список товаров</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-blue">10 980</small>
            </span>
        </a></li>
    <li><a href="#"><i class="far fa-truck-container text-info mr-1"></i> <span>Поставщики</span></a></li>

    <li class="header">Уведомления / Обратный звонок</li>
    <li class="treeview">
        <a href="#">
            <i class="fas fa-bell mr-2"></i> <span>Уведомления</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
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
              <small class="label pull-right bg-red">3</small>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fal fa-circle text-red mr-2 "></i> Список звонков</a></li>
            <li><a href="#"><i class="fal fa-circle text-red mr-2  "></i> Статусы</a></li>
            <li><a href="#"><i class="fal fa-circle text-red mr-2 "></i> Темы</a></li>
        </ul>
    </li>


    <li class="header">Пользователи</li>
    <li><a href="{{ route('admin.users.index') }}"><i class="fal fa-users-class text-success mr-2"></i> <span>Список пользователей</span></a></li>
    <li><a href="#"><i class="fal fa-comment-alt-lines text-aqua mr-2"></i> <span>Комментария</span></a></li>



</ul>
