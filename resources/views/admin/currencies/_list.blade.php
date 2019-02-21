<table class="table table-hover">

    <tbody>
    <tr>
        <th style="width: 50px">ID</th>
        <th>Название</th>
        <th>Код Пост.</th>
        <th>Сайт</th>
        <th>Номера</th>
        <th>Email</th>
        {{--<th>Адреса</th>--}}
        <th style="width: 90px"></th>
        {{--<th>Комментария</th>--}}
    </tr>

    @foreach ($shippers as $shipper)
    <tr>
        <td>{{ $shipper->id }}</td>
        <td><a href="{{ route('admin.shippers.show', $shipper) }}">{{ $shipper->title }}</a></td>
        <td>{{ $shipper->code_product }} </td>
        <td><a href="{{ $shipper->url != null ? $shipper->url : '#'}}" target="_blank">ссылка</a></td>
        <td>{{ $shipper->number }} </td>
        <td><a href="{{ $shipper->email != null ? 'mailto:'.$shipper->email : '#'}}" target="_blank">{{ $shipper->email != null ? $shipper->email : '-'}}</a></td>

        {{--<td>{{ $shipper->address }} </td>--}}
        <td>
            <form method="POST" action="{{ route('admin.shippers.destroy', $shipper) }}" class="form-inline pull-right">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.shippers.edit', $shipper->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Поставщика?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>

            </form>

        </td>
{{--        <td>{{ count($shipper->comments) }} </td>--}}

    </tr>
    @endforeach

    </tbody>
</table>