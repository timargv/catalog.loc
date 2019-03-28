<table class="table table-hover">

    <tbody>
    <tr>
        <th style="width: 50px">ID</th>
        <th>Название</th>
        <th>URL</th>
        <th style="width: 90px"></th>
    </tr>

    @foreach ($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->title }}</a></td>
        <td>{{ $order->slug }}</td>
        <td>
            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" class="form-inline pull-right">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Поставщика?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>

            </form>

        </td>
    </tr>
    @endforeach

    </tbody>
</table>