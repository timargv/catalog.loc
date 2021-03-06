@if(count($attributes))
    <table class="table table-hover">
        <tbody>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Название</th>
            <th>Тип</th>
            <th>Группа Атрибута</th>
            <th>URL</th>
            <th style="width: 90px"></th>
        </tr>

        @foreach ($attributes as $attribute)
            <tr>
                <td>{{ $attribute->id }}</td>
                <td>{{ $attribute->name }}</td>
                <td>{{ $attribute->type }}</td>
                <td>{{ $attribute->group == null ? '' : $attribute->group->name }}</td>
                <td>{{ $attribute->slug }}</td>

                <td>
                    <form method="POST" action="{{ route('admin.attributes.destroy', $attribute) }}" class="form-inline pull-right">
                        @csrf
                        @method('DELETE')
                        <div class="btn-group btn-group-xs">
                            <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                            <button onclick="return confirm('Удалить Атирибут?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                        </div>

                    </form>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@else
    <div class="text-center display-2 pb-5">Список Атрибутов пустой</div>
@endif
