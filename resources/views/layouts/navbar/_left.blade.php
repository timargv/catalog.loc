{{--<ul class="navbar-nav mr-auto">--}}

{{--</ul>--}}



<div class="w-75">

    <form action="?" method="GET" class="form-inline w-75">
        <input id="name" class="form-control form-control-sm mr-1" name="name" value="{{ request('name') }}" placeholder="" style="width: 68%;">

        <th class="text-right">
            <button type="submit" class="btn btn-outline-primary btn-sm mr-1">{{ __('button.Search') }}</button>
            <a href="?" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Очистить Поиск">X</a>
        </th>

    </form>

</div>