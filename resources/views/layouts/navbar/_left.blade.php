<ul class="navbar-nav mr-3 top-left-nav">
    <li class="nav-item dropdown" style="position: initial"><a class="nav-link bg-purpl rounded-sm py-2 text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
            <span class="px-1 font-weight-bold"><i class="fas fa-bars pr-1"></i> Каталог товаров</span>
        </a>
        <div class="dropdown-menu w-100 rounded-0 border-0 shadow-sm" aria-labelledby="dropdown01">
            <div class="container">
                <ul class="list-menu">
                    <li>
                        <a href="" id="aHref" data-id="1">
                            <span>Catalog list</span>
                        </a>
                    </li>
                    <li>
                        <a href="" id="aHref" data-id="2">
                            <span>Catalog list</span>
                        </a>
                    </li>
                </ul>
                <div class="vertical-menu">
                    <div class="vertical-menu_block" data-id="1">
                        <div class="vertical-menu-block">
                            <div class="vertical-menu-block-title font-weight-bold">Adsad1</div>
                            <ul class="vertical-menu-block-list-item">
                                <li><a href="">Asdasd</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="vertical-menu_block" data-id="2">
                        <div class="vertical-menu-block">
                            <div class="vertical-menu-block-title font-weight-bold">Adsad2</div>
                            <ul class="vertical-menu-block-list-item">
                                <li><a href="">Asdasd</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>

<div class="w-50">
    <form action="?" method="GET" class="form-inline">
        <input id="name" class="form-control form-control-sm mr-1" name="name" value="{{ request('name') }}" placeholder="" style="width: 68%;">
        <th class="text-right">
            <button type="submit" class="btn btn-outline-primary btn-sm mr-1">{{ __('button.Search') }}</button>
            <a href="?" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Очистить Поиск">X</a>
        </th>
    </form>
</div>
