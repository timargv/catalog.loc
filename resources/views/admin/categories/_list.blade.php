<div class="table-responsive">

    @if(count($categories) != null)
    <table class="table table-hover ">
        <form action="?" method="GET" class="form-inline">
        <thead>
        <tr>
            <th>ID</th>
            <th style="min-width: 150px;">
                <label for="stk" class="col-form-label" style="margin: 0; cursor: pointer;">{{ __('category.Title') }}</label>
                <button style="padding: 0;" type="submit" id="stk" class="btn btn-xs btn-box-tool" name="name" value="{{ request('name') === 'desc' ? 'asc' : 'desc' }}"><i class="fa fa-sort-alpha-{{ request('name') === 'desc' ? 'desc' : 'asc' }}" aria-hidden="true"></i></button>
            </th>
            <th>ParentID</th>
            <th>{{ __('category.Title_Original') }}</th>
            <th>{{ __('category.Slug') }}</th>
            <th width="120px">Position</th>
            <th class="text-right pr-5"><span class="pr-4">{{ __('category.Status') }}</span></th>
            <th class="text-center"><i class="far fa-cogss"></i></th>
        </tr>
        </thead>
        </form>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>
                    @if($category->name)
                    @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a>
                    @endif
                </td>
                <td>{{ $category->parent_id }}</td>
                <td><a href="{{ route('admin.categories.show', $category) }}">{{ $category->name_original }}</a></td>
                <td><span class="text-muted">{{ $category->slug }}</span></td>
                <td>
                    <div class="" style="margin: 0 -5px;">
                        <form class="float-left ml-2" method="POST" action="{{ route('admin.categories.first', $category) }}">
                            @csrf
                            <button class="btn btn-xs bg-gray color-palette"><i class="far fa-angle-double-up"></i></button>
                        </form>
                        <form class="float-left ml-2" method="POST" action="{{ route('admin.categories.up', $category) }}">
                            @csrf
                            <button class="btn btn-xs bg-gray color-palette"><i class="far fa-angle-up"></i></button>
                        </form>
                        <form class="float-left ml-2" method="POST" action="{{ route('admin.categories.down', $category) }}">
                            @csrf
                            <button class="btn btn-xs bg-gray color-palette"><i class="far fa-angle-down"></i></button>
                        </form>
                        <form class="float-left ml-2" method="POST" action="{{ route('admin.categories.last', $category) }}">
                            @csrf
                            <button class="btn btn-xs bg-gray color-palette"><i class="far fa-angle-double-down"></i></button>
                        </form>
                    </div>
                </td>
                <td>
                    <button data-id="{{ $category->id }}" id="btn-toggle" class="btn btn-md btn-toggle {{ $category->status == 'active' ? 'active' : '' }} pull-right" data-toggle="button" aria-pressed="{{ $category->status == 'active' ? 'true' : 'false' }}" autocomplete="off">
                        <div class="handle"></div>
                    </button>
                </td>

                <td>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="form-inline pull-right">
                        @csrf
                        @method('DELETE')
                        <div class="btn-group btn-group-xs">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-default "><i class="fal fa-edit"></i></a>
                            <button onclick="return confirm('Удалить Категорию?')" class="btn btn-default "><i class="fas fa-trash"></i></button>
                        </div>

                    </form>

                </td>
            </tr>
        @endforeach



        </tbody>
    </table>

    @else
        <div class="text-center">
            <h1 class="text-muted" style="padding-bottom: 40px">
                Пусто
            </h1>
        </div>
    @endif

</div>
<!-- /.table-responsive -->
