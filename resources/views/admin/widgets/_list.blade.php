<table class="table table-hover">

    <tbody>
    <tr>
        <th style="width: 50px">ID</th>
        <th>Название</th>
        <th style="width: 90px"></th>
    </tr>

    @foreach ($widgets as $widget)
    <tr>
        <td>{{ $widget->id }}</td>
        <td><a href="{{ route('admin.widgets.show', $widget) }}">{{ $widget->title }}</a></td>
        <td>
            <form method="POST" action="{{ route('admin.widgets.destroy', $widget) }}" class="form-inline pull-right">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.widgets.edit', $widget->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Виджет?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>

            </form>

        </td>
    </tr>
    @endforeach

    </tbody>
</table>
