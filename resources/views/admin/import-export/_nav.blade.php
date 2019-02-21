<ul class="nav nav-tabs">
    <li class="{{{ (Request::is('admin/import/product') ? 'active' : '') }}}"><a href="{{ route('admin.import.product') }}">Товары</a></li>
    {{--<li class="dropdown">--}}
        {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#">--}}
            {{--Товары <span class="caret"></span>--}}
        {{--</a>--}}
        {{--<ul class="dropdown-menu">--}}
            {{--<li><a href="#">Action</a></li>--}}
            {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>--}}
            {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>--}}
            {{--<li role="presentation" class="divider"></li>--}}
            {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>--}}
        {{--</ul>--}}
    {{--</li>--}}
    <li class="{{{ (Request::is('admin/import/category') ? 'active' : '') }}}"><a href="{{ route('admin.import.category') }}">Категория</a></li>
    <li class="{{{ (Request::is('admin/import/user') ? 'active' : '') }}}"><a href="{{ route('admin.import.user') }}">Пользовател</a></li>



    <li class="pull-right"><a href="#" class="text-muted"><i class="fas fa-cogs"></i></a></li>
</ul>