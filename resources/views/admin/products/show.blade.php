@extends('admin.layouts.app')

@section('title', $product->name)

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="btn-group-sm">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-default">{{ __('button.Back') }}</a>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success float-right">{{ __('button.Add') }}</a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning float-right mr-2">{{ __('button.Edit') }}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-9">
            <div class="row">
                <div class="col-xs-4">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="form-group @if($errors->has('categories'))has-error @endif">
                                <label for="parent" class="col-form-label">{{ __('category.Category') }}</label>
                                <select id="categories" class="form-control select2 w-100 {{ $errors->has('categories') ? ' is-invalid' : '' }}" name="categories">
                                    <option value="">&mdash; Выберите категорию</option>
                                    @foreach ($categories as $parent)
                                        <option value="{{ $parent->id }}"{{ $parent->id == old('parent', $product->category_id) ? ' selected' : '' }}>
                                            @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                            {{ $parent->name == null ? $parent->name_original : $parent->name }}
                                        </option>
                                    @endforeach;
                                </select>
                                @if ($errors->has('categories'))
                                    <span class="help-block"><strong>{{ $errors->first('categories') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="form-group @if($errors->has('vendor'))has-error @endif">
                                <label for="vendor" class="col-form-label">{{ __('fillable.Vendor') }}</label>
                                <select id="vendor" class="form-control select2 w-100 {{ $errors->has('vendor') ? ' is-invalid' : '' }}" name="vendor">
                                    <option value="" class="text-muted">&mdash; Выберите Поставщика</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"{{ $vendor == old('vendor', $product->vendor) ? ' selected' : '' }}>{{ $vendor->title }}</option>
                                    @endforeach;
                                </select>
                                @if ($errors->has('vendor'))
                                    <span class="help-block"><strong>{{ $errors->first('vendor') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="form-group @if($errors->has('brand'))has-error @endif">
                                <label for="brand" class="col-form-label">{{ __('brand.Brand') }}</label>
                                <select id="brand" class="form-control select2 w-100 {{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand">
                                    <option value="" class="text-muted">&mdash; Выберите Бренд</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"{{ $brand == old('brand', $product->brand) ? ' selected' : '' }}>{{ $brand->title }}</option>
                                    @endforeach;
                                </select>
                                @if ($errors->has('brand'))
                                    <span class="help-block"><strong>{{ $errors->first('brand') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="form-group @if($errors->has('name'))has-error @endif">
                                <label for="title" class="col-form-label">{{ __('fillable.Name') }}</label>
                                <input id="title" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group @if($errors->has('name_original'))has-error @endif">
                                <label for="name_original" class="col-form-label">{{ __('fillable.NameOriginal') }}</label>
                                <input id="name_original" class="form-control" name="name_original" value="{{ old('name_original', $product->name_original) }}">
                                @if ($errors->has('name_original'))
                                    <span class="help-block"><strong>{{ $errors->first('name_original') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="form-group @if($errors->has('sh_desc'))has-error @endif">
                                <label for="sh_desc" class="col-form-label">{{ __('fillable.ShDesc') }}</label>
                                <textarea rows="3" id="sh_desc" type="text" class="form-control{{ $errors->has('sh_desc') ? ' is-invalid' : '' }}" name="sh_desc">{{ old('sh_desc', $product->sh_desc) }}</textarea>
                                @if ($errors->has('sh_desc'))
                                    <span class="help-block"><strong>{{ $errors->first('sh_desc') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Характеристики</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Описание</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Инструкции</a></li>
                            <li><a href="#tab_4" data-toggle="tab">Видео</a></li>
                            <li><a href="#tab_5" data-toggle="tab">Примеры фото</a></li>
                            <li><a href="#tab_6" data-toggle="tab">Мета</a></li>
                            <li><a href="#tab_7" data-toggle="tab">Модификации</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane pt-3" id="tab_2">
                                <div class="form-group @if($errors->has('desc'))has-error @endif">
                                    <label for="desc" class="col-form-label">{{ __('fillable.Description') }}</label>
                                    <textarea rows="10" id="desc" type="text" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" name="desc">{{ old('desc', $product->desc) }}</textarea>
                                    @if ($errors->has('desc'))
                                        <span class="help-block"><strong>{{ $errors->first('desc') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_4">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_5">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_6">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_7">

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="box box-solid mb-4">
                <div class="box-header with-border">
                    <div class="box-title">
                        Фотографии
                    </div>
                </div>
                <div class="box-body ">
                   {{--<div class="mb-4">--}}
                       {{--<img class="img-responsive border" src="{{ $product->picture }}" >--}}
                   {{--</div>--}}
                    <div class="row">
                        <ul class="row list-unstyled pr-3 mr-2">
                            <li class="col-xs-3 pr-0 mb-3">
                                <img class="img-responsive border" src="{{ $product->picture }}" >
                            </li>
                            <li class="col-xs-3 pr-0 mb-3">
                                <img class="img-responsive border" src="{{ $product->picture }}" >
                            </li>
                            <li class="col-xs-3 pr-0 mb-3">
                                <img class="img-responsive border" src="{{ $product->picture }}" >
                            </li>
                            <li class="col-xs-3 pr-0 mb-3">
                                <img class="img-responsive border" src="{{ $product->picture }}" >
                            </li>
                            <li class="col-xs-3 pr-0 mb-3">
                                <img class="img-responsive border" src="{{ $product->picture }}" >
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box box-solid mb-4">
                <div class="box-header with-border">
                    <div class="box-title">
                        Цены
                    </div>
                </div>
                <div class="box-body ">
                    <div class="form-group @if($errors->has('price'))has-error @endif">
                        <label for="price" class="col-form-label">Базовая стоимость</label>
                        <input type="text" id="price" class="form-control" name="price" value="{{ old('price', $product->price) }}" >
                        @if ($errors->has('price'))
                            <span class="help-block"><strong>{{ $errors->first('price') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('vendor_price'))has-error @endif">
                        <label for="vendor_price" class="col-form-label">{{ __('fillable.VendorPrice') }}</label>
                        <input type="text" id="vendor_price" class="form-control" name="vendor_price" value="{{ old('vendor_price', $product->vendor_price) }}" >
                        @if ($errors->has('vendor_price'))
                            <span class="help-block"><strong>{{ $errors->first('vendor_price') }}</strong></span>
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box box-solid mb-4">
                <div class="box-header with-border">
                    <div class="box-title">
                        Основные параметры
                    </div>
                </div>
                <div class="box-body ">
                    <div class="box-body">


                        <div class="form-group @if($errors->has('type_packaging'))has-error @endif">
                            <label for="type_packaging" class="col-form-label">{{ __('Тип упаковки') }}</label>
                            <input type="text" id="type_packaging" class="form-control" name="type_packaging" value="{{ old('type_packaging', $product->type_packaging) }}" >
                            @if ($errors->has('type_packaging'))
                                <span class="help-block"><strong>{{ $errors->first('type_packaging') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('packing_dimensions'))has-error @endif">
                            <label for="packing_dimensions" class="col-form-label">{{ __('Габариты в упаковке, мм') }}</label>
                            <input type="text" id="packing_dimensions" class="form-control" name="packing_dimensions" value="{{ old('packing_dimensions', $product->packing_dimensions) }}" >
                            @if ($errors->has('packing_dimensions'))
                                <span class="help-block"><strong>{{ $errors->first('packing_dimensions') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('length'))has-error @endif">
                            <label for="length" class="col-form-label">{{ __('Длина в упаковке, мм') }}</label>
                            <input type="text" id="length" class="form-control" name="length" value="{{ old('length', $product->length) }}" >
                            @if ($errors->has('length'))
                                <span class="help-block"><strong>{{ $errors->first('length') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('width'))has-error @endif">
                            <label for="width" class="col-form-label">{{ __('Ширина в упаковке, мм') }}</label>
                            <input type="text" id="width" class="form-control" name="width" value="{{ old('width', $product->width) }}" >
                            @if ($errors->has('width'))
                                <span class="help-block"><strong>{{ $errors->first('width') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('height'))has-error @endif">
                            <label for="height" class="col-form-label">{{ __('Высота в упаковке, мм') }}</label>
                            <input type="text" id="height" class="form-control" name="height" value="{{ old('height', $product->height) }}" >
                            @if ($errors->has('height'))
                                <span class="help-block"><strong>{{ $errors->first('height') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('weight'))has-error @endif">
                            <label for="weight" class="col-form-label">{{ __('fillable.Weight') }}, мм</label>
                            <input type="text" id="weight" class="form-control" name="weight" value="{{ old('weight', $product->weight) }}" >
                            @if ($errors->has('weight'))
                                <span class="help-block"><strong>{{ $errors->first('weight') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('barcode'))has-error @endif">
                            <label for="barcode" class="col-form-label">{{ __('fillable.Barcode') }}</label>
                            <input type="text" id="barcode" class="form-control" name="barcode" value="{{ old('barcode', $product->barcode) }}" >
                            @if ($errors->has('barcode'))
                                <span class="help-block"><strong>{{ $errors->first('barcode') }}</strong></span>
                            @endif
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection