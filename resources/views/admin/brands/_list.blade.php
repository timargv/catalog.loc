<table class="table table-hover">

    <tbody>
    <tr>
        <th style="width: 50px">ID</th>
        <th>Название</th>
        <th>URL</th>
        <th style="width: 90px"></th>
    </tr>

    @foreach ($brands as $brand)
    <tr>
        <td>{{ $brand->id }}</td>
        <td><a href="{{ route('admin.brands.show', $brand) }}">{{ $brand->title }}</a></td>
        <td>{{ $brand->slug }}</td>
        <td>
            <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}" class="form-inline pull-right">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Поставщика?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>

            </form>

        </td>
    </tr>
    @endforeach

    </tbody>
</table>