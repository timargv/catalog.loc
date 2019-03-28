<table class="table table-hover">
    <tbody>
    <tr>
        <th style="width: 50px">ID</th>
        <th>{{ __('fillable.Title') }}</th>
        <th>{{ __('fillable.Cost') }}</th>
        <th>{{ __('fillable.MinWeight') }}</th>
        <th>{{ __('fillable.MaxWeight') }}</th>
        <th>{{ __('fillable.Sort') }}</th>
        <th style="width: 90px"></th>
    </tr>

    @foreach ($deliveries as $delivery)
    <tr>
        <td>{{ $delivery->id }}</td>
        <td><a href="{{ route('admin.deliveries.show', $delivery) }}">{{ $delivery->title }}</a></td>
        <td>{{ $delivery->cost }}</td>
        <td>{{ $delivery->min_weight }}</td>
        <td>{{ $delivery->max_weight }}</td>
        <td>{{ $delivery->sort }}</td>
        <td>
            <form method="POST" action="{{ route('admin.deliveries.destroy', $delivery) }}" class="form-inline pull-right">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.deliveries.edit', $delivery->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Поставщика?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>
            </form>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>