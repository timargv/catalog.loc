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

    @foreach ($vendors as $vendor)
    <tr>
        <td>{{ $vendor->id }}</td>
        <td><a href="{{ route('admin.vendors.show', $vendor) }}">{{ $vendor->title }}</a></td>
        <td>{{ $vendor->code_product }} </td>
        <td><a href="{{ $vendor->url != null ? $vendor->url : '#'}}" target="_blank">ссылка</a></td>
        <td>{{ $vendor->number }} </td>
        <td><a href="{{ $vendor->email != null ? 'mailto:'.$vendor->email : '#'}}" target="_blank">{{ $vendor->email != null ? $vendor->email : '-'}}</a></td>

        {{--<td>{{ $vendor->address }} </td>--}}
        <td>
            <form method="POST" action="{{ route('admin.vendors.destroy', $vendor) }}" class="form-inline pull-right">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Поставщика?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>

            </form>

        </td>
{{--        <td>{{ count($vendor->comments) }} </td>--}}

    </tr>
    @endforeach

    </tbody>
</table>