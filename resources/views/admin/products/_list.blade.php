<table class="table table-condensed">
    <form action="?" method="GET" class="form-inline">
        <thead>

        <tr>
            <th width="5px">ID</th>
            <th width="80px">Код </th>
            <th width="700px">Навание Товара</th>
            <th width="250px">Категории</th>
            <th>Цена</th>
            <th>Цена Пост.</th>
            <th><span data-toggle="tooltip" data-placement="top" title="Статус"><i class="far fa-power-off"></i></span></th>
            <th><span data-toggle="tooltip" data-placement="top" title="Наличие на складе"><i class="fas fa-cubes"></i></span></th>
            {{--<th width="195px">Поставщик</th>--}}
            <th width="150px">Дата обн.</th>
            <th width="102px"></th>
        </tr>

        @if(!empty($categories))
            <tr class="active">
                <th width="80px" colspan="2"><input id="vendor_code" class="form-control input-sm" name="vendor_code" value="{{ request('vendor_code') }}" placeholder="Код товара"></th>
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
                {{--<th></th>--}}
                <th></th>
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
        <td class="align-top">{{ $product->id }}</td>
        <td class="align-top"><a href="{{ $product->original_url }}" target="_blank">{{ $product->vendor_code }}</a></td>
        <td class="align-top">
            <div class="row mb-2">
                <div class="col-xs-1 pr-0 text-right">
                    @foreach($product->photos as $photo)
                        @if($photo->main == 'yeas')
                            <img src="{{ url('/storage/products/item/'. $photo->file) }}" alt="" class=" img-circle  mr-0 pr-0 w-100" style="max-width: 40px !important;">
                            @break
                        @endif
                    @endforeach
                    @if (!count($product->photos))
                        <img src="../img/no_photo_product.jpg" alt="" class="mr-0 pr-0 w-100" style="max-width: 40px !important;">
                    @endif
                </div>
                <div class="col-xs-11">
                    <div class="w-100 mb-1">
                        <a href="{{ route('admin.products.show', $product) }}" target="_blank" class="w-100 d-block">{{ $product->name_original }}</a>
                    </div>
                    <div class="w-100"><small>{{ $product->getVendorTitle() }}</small></div>
                </div>
            </div>
        </td>
        <td class="align-top ">{{ $product->getCategoryTitle() }}</td>

        {{--        <td> {{ $product->getStatusesAvailable() }} </td>--}}
        <td class="align-top">
            @if($product->price > $product->vendor_price)
                <i class="fas fa-angle-up text-success mr-1"></i>
            @elseif($product->price < $product->vendor_price)
                <i class="fas fa-angle-down text-danger mr-1"></i>
            @endif
            <span id="price" >{{ $product->price }}</span>
        </td>
        <td id="price" class="align-top">{{ $product->vendor_price }} </td>
        <td class="small align-top">
             <i class="fas fa-circle {{ $product->available === 'yeas' ? 'text-success' : 'text-warning' }}"></i>
        </td>
        <td class="small align-top">
            <i class="fas fa-circle {{ $product->status === 'active' ? 'text-success' : 'text-danger' }}"></i>
        </td>
{{--        <td class="align-top"><a href="{{ route('admin.vendors.show', $product->getVendorId()) }}" target="_blank">{{ $product->getVendorTitle() }}</a></td>--}}
        <td class="align-top">{{ $product->updated_at }}</td>
        <td class="align-top">
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