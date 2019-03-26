<table class="table table-hover">

    <tbody>
    <tr>
        <th style="width: 50px">ID</th>
        <th>Название</th>
        <th>URL</th>
        <th style="width: 90px"></th>
    </tr>

    @foreach ($statuses as $status)
    <tr>
        <td>{{ $status->id }}</td>
        <td><a href="{{ route('admin.order-statuses-list.show', $status) }}">{{ $status->title }}</a></td>
        <td>{{ $status->slug }}</td>
        <td>
            <form method="POST" action="{{ route('admin.order-statuses-list.destroy', $statusOrderList) }}" class="form-inline pull-right">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.order-statuses-list.edit', $status->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Статус?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>

            </form>

        </td>
    </tr>
    @endforeach

    </tbody>
</table>