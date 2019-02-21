<table class="table table-hover">

    <tbody>
    <tr>
        <th style="width: 50px">ID</th>
        <th>Название</th>
        <th>URL</th>
        <th style="width: 90px"></th>
    </tr>

    @foreach ($attributeGroups as $attributeGroup)
    <tr>
        <td>{{ $attributeGroup->id }}</td>
        <td><a href="{{ route('admin.attribute-groups.show', $attributeGroup) }}">{{ $attributeGroup->name }}</a></td>
        <td>{{ $attributeGroup->slug }}</td>
        <td>
            <form method="POST" action="{{ route('admin.attribute-groups.destroy', $attributeGroup) }}" class="form-inline pull-right">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.attribute-groups.edit', $attributeGroup->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Группу Атрибутов?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>
            </form>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>

