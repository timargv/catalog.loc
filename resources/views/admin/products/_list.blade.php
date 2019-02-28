<table class="table table-condensed">
    <form action="?" method="GET" class="form-inline">
        <thead>

        <tr>
            <th width="5px">ID</th>
            <th width="80px">Код </th>
            <th width="500px">Навание Товара</th>
            <th width="300px">Категории</th>
            <th>Цена</th>
            <th>Цена Пост.</th>
            <th><span data-toggle="tooltip" data-placement="top" title="Статус"><i class="far fa-power-off"></i></span></th>
            <th><span data-toggle="tooltip" data-placement="top" title="Наличие на складе"><i class="fas fa-cubes"></i></span></th>
            <th>Поставщик</th>
            <th></th>
        </tr>

        @if(!empty($categories))
            <tr class="active">
                <th width="5px"></th>
                <th width="80px"><input id="vendor_code" class="form-control input-sm" name="vendor_code" value="{{ request('vendor_code') }}" placeholder=""></th>
                <th><input id="name" class="form-control input-sm" name="name" value="{{ request('name') }}" placeholder=""></th>
                <th>
                    <select id="category" class="form-control select2 w-100 {{ $errors->has('category') ? ' is-invalid' : '' }} input-sm" name="category">
                        <option value="">Все</option>
                        @foreach ($categories as $parent)
                            <option value="{{ $parent->id }}"{{ $parent->id == old('parent', request('category')) ? ' selected' : '' }}>
                                @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                {{ $parent->name == null ? $parent->name_original : $parent->name }}
                            </option>
                        @endforeach;
                    </select>
                </th>
                <th><input class="form-control input-sm" name="price" value="{{ request('price') }}" placeholder=""></th>
                <th><input class="form-control input-sm" name="vendor_price" value="{{ request('vendor_price') }}" placeholder=""></th>
                <th></th>
                <th></th>
                <th>
                </th>
                <th class="text-right">
                    <button type="submit" class="btn btn-outline-primary btn-sm">{{ __('button.Search') }}</button>
                    <a href="?" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Очистить Поиск"><i class="far fa-times"></i></a>
                </th>
            </tr>
        @endif
        </thead>
    </form>
    <tbody>

    @foreach ($products as $product)
    <tr>
        <td class="align-middle">{{ $product->id }}</td>
        <td class="align-middle"><a href="{{ $product->original_url }}" target="_blank">{{ $product->vendor_code }}</a></td>
        <td class="">
            @foreach($product->photos as $photo)
                @if($photo->main == 'yeas')
                    <img src="{{ Storage::disk('public')->url('products/item/'. $photo->file) }}" alt="" class=" img-circle  mr-2 float-left" style="width: 30px;">
                    @break
                @endif
            @endforeach
            <a href="{{ route('admin.products.show', $product) }}" target="_blank" class="float-left" style="width: 90%">{{ $product->name_original }}</a>
        </td>
        <td class="align-middle">{{ $product->getCategoryTitle() }}</td>

        {{--        <td> {{ $product->getStatusesAvailable() }} </td>--}}
        <td id="price" class="align-middle">{{ $product->price }}</td>
        <td id="price" class="align-middle">{{ $product->vendor_price }} </td>
        <td class="small align-middle">
             <i class="fas fa-circle {{ $product->available === 'yeas' ? 'text-success' : 'text-warning' }}"></i>
        </td>
        <td class="small align-middle">
            <i class="fas fa-circle {{ $product->status === 'active' ? 'text-success' : 'text-danger' }}"></i>
        </td>
        <td class="align-middle"><a href="{{ route('admin.vendors.show', $product->getVendorId()) }}" target="_blank">{{ $product->getVendorTitle() }}</a></td>
        <td class="align-middle">
            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="form-inline pull-right align-middle">
                @csrf
                @method('DELETE')
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-default"><i class="fal fa-edit"></i></a>
                    <button onclick="return confirm('Удалить Товар?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                </div>

            </form>

        </td>

        {{--<td>--}}
            {{--@if ($advert->isDraft())--}}
            {{--<span class="badge badge-secondary">Draft</span>--}}
            {{--@elseif ($advert->isOnModeration())--}}
            {{--<span class="badge badge-primary">Moderation</span>--}}
            {{--@elseif ($advert->isActive())--}}
            {{--<span class="badge badge-primary">Active</span>--}}
            {{--@elseif ($advert->isClosed())--}}
            {{--<span class="badge badge-secondary">Closed</span>--}}
            {{--@endif--}}
        {{--</td>--}}
    </tr>
    @endforeach

    </tbody>
</table>

<style>
    .select2-selection.select2-selection--single {
        height: 30px !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        margin-top: -6px !important;
        font-size: 13px;
    }
</style>