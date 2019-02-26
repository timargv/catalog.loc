@extends('admin.layouts.app')

@section('title', 'Edit')

@section('content')


        <div class="row">
            <div class="col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="btn-group" data-toggle="buttons">
                            <a href="#product" data-toggle="tab" class="btn btn-default active border-0">
                                <input type="radio" name="options" id="option1" checked> Товар
                            </a>
                            <a href="#addPhoto" data-toggle="tab" class="btn btn-default border-0">
                                <input type="radio" name="options" id="option2"> Изображения
                            </a>
                        </div>
                        <div class="btn-group float-right">
                            <a href="{{ route('admin.products.index') }}" class="btn bg-light text-dark">{{ __('button.Back') }}</a>
                            <a class="btn btn-success" onclick="event.preventDefault(); document.getElementById('edit-product-form').submit();">{{ __('button.Save') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-content">

            <div class="tab-pane active" id="product">
                <form id="edit-product-form" method="POST" action="{{ route('admin.products.update', $product) }}">
                    @csrf
                    @method('PUT')
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

                                            <div class="form-group @if($errors->has('slug'))has-error @endif">
                                                <label for="slug" class="col-form-label">{{ __('fillable.Slug') }}</label>
                                                <input type="text" id="slug" class="form-control" name="slug" value="{{ old('slug', $product->slug) }}" required>
                                                @if ($errors->has('slug'))
                                                    <span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
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
                                {{-- Атрибуты --}}
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
                                            <li class="pull-right"><a href="#tab_8" data-toggle="tab">Настройки</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="row">
                                                    @foreach (array_chunk($product->category->allAttributes(), 2) as $chunk)
                                                        <div class="col-xs-6">
                                                            @foreach ($chunk as $attribute)
                                                                <div class="form-group">
                                                                    <label for=attribute_{{ $attribute->id }}" class="col-form-label">{{ $attribute->name }}</label>
                                                                    @if ($attribute->isSelect())
                                                                        <select id="attribute_{{ $attribute->id }}" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]">
                                                                            <option value=""></option>
                                                                            @foreach ($attribute->variants as $variant)
                                                                                <option value="{{ $variant }}"{{ $variant == old('attributes.' . $attribute->id, $product->getValue($attribute->id)) ? ' selected' : '' }}>
                                                                                    {{ $variant }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    @elseif ($attribute->isNumber())
                                                                        <input id="attribute_{{ $attribute->id }}" type="number" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]" value="{{ old('attributes.' . $attribute->id, $product->getValue($attribute->id)) }}">
                                                                    @else
                                                                        <input id="attribute_{{ $attribute->id }}" type="text" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]" value="{{ old('attributes.' . $attribute->id, $product->getValue($attribute->id)) }}">
                                                                    @endif
                                                                    @if ($errors->has('parent'))
                                                                        <span class="invalid-feedback"><strong>{{ $errors->first('attributes.' . $attribute->id) }}</strong></span>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
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
                                            <div class="tab-pane" id="tab_8">

                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- nav-tabs-custom -->
                                </div>
                                <div class="col-xs-12">
                                    <div class="box box-solid">
                                        <div class="box-body">

                                            <div class="form-group @if($errors->has('original_url'))has-error @endif">
                                                <label for="original_url" class="col-form-label">{{ __('fillable.OriginalUrl') }}</label>
                                                <input id="original_url" class="form-control" name="original_url" value="{{ old('original_url', $product->original_url) }}">
                                                @if ($errors->has('original_url'))
                                                    <span class="help-block"><strong>{{ $errors->first('original_url') }}</strong></span>
                                                @endif
                                            </div>

                                            <div class="form-group @if($errors->has('original_id'))has-error @endif">
                                                <label for="original_id" class="col-form-label">{{ __('fillable.OriginalId') }}</label>
                                                <input id="original_id" class="form-control" name="original_id" value="{{ old('original_id', $product->original_id) }}">
                                                @if ($errors->has('original_id'))
                                                    <span class="help-block"><strong>{{ $errors->first('original_id') }}</strong></span>
                                                @endif
                                            </div>

                                            <div class="form-group @if($errors->has('vendor_code_original'))has-error @endif">
                                                <label for="vendor_code_original" class="col-form-label">{{ __('fillable.VendorCodeOriginal') }}</label>
                                                <input type="text" id="vendor_code_original" class="form-control" name="vendor_code_original" value="{{ old('vendor_code_original', $product->vendor_code_original) }}">
                                                @if ($errors->has('vendor_code_original'))
                                                    <span class="help-block"><strong>{{ $errors->first('vendor_code_original') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="box box-solid mb-4">

                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group @if($errors->has('status'))has-error @endif">
                                                <label for="status" class="col-form-label">{{ __('fillable.Status') }}</label>
                                                <select id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                                                    @foreach ($statuses as $status => $label)
                                                        <option value="{{ $status }}"{{ $status == old('status', $product->status) ? ' selected' : '' }}>{{ $label }}</option>
                                                    @endforeach;
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group @if($errors->has('available'))has-error @endif">
                                                <label for="available" class="col-form-label">{{ __('fillable.Available') }}</label>
                                                <select id="available" class="form-control{{ $errors->has('available') ? ' is-invalid' : '' }}" name="available">
                                                    @foreach ($statusAvailable as $available => $label)
                                                        <option value="{{ $available }}"{{ $available == old('available', $product->available) ? ' selected' : '' }}>{{ $label }}</option>
                                                    @endforeach;
                                                </select>
                                                @if ($errors->has('available'))
                                                    <span class="help-block"><strong>{{ $errors->first('available') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <div id="box-photo" class="box box-solid mb-4">
                                <div class="box-header with-border">
                                    <div class="box-title">
                                        Фотографии
                                    </div>
                                    <div class="box-tools">
                                        <a id="deletes-photo-product" data-url="{{ route('admin.products.photos.deletes', $product) }}" href="#" class="btn bg-light text-dark btn-sm"><i class="far fa-trash mr-1"></i> Удалить все</a>
                                    </div>
                                </div>

                                <div class="box-body ">
                                    {{--<div class="mb-4">--}}
                                    {{--<img class="img-responsive border" src="{{ $product->picture }}" >--}}
                                    {{--</div>--}}

                                    <div class="row">

                                        <div class="col-xs-6 pr-0">
                                            @foreach($product->photos as $photo)
                                                <div class="position-relative">
                                                    @if($photo->main == 'yeas')
                                                        <img class="img-responsive border w-100 " src="{{ Storage::disk('public')->url('products/original/'. $photo->file) }}" >
                                                    @endif

                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-xs-6 pl-0">
                                            <ul id="photo-list" class="row list-unstyled pr-3 mr-2">
                                                @foreach($product->photos as $photo)
                                                    @if($photo->main == 'no')
                                                        <li class="col-xs-6 pr-0 mb-3">
                                                            <div class="position-relative">
                                                                <img class="img-responsive border " src="{{ Storage::disk('public')->url('products/thumbnail/'. $photo->file) }}" >
                                                                <div class="btn-group position-absolute fixed-bottom">
                                                                    <a href="#" data-url="{{ route('admin.products.photos.delete', [$product, $photo->id]) }}" id="delete-photo-product" data-id="{{ $photo->id }}" class="fas fa-trash btn btn-xs btn-flat bg-transparent text-danger  py-2 float-left" data-toggle="tooltip" data-placement="top" title="" data-original-title="Удалить"></a>
                                                                    <a href="#" data-url="{{ route('admin.products.photos.main', [$product, $photo->id]) }}" id="main-photo-product" data-id="{{ $photo->id }}" class="fas fa-check-circle btn btn-xs btn-flat bg-transparent text-info py-2 float-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Сделать Главным"></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach


                                            </ul>
                                        </div>

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
                                        <label for="price" class="col-form-label">{{ __('fillable.VendorPrice') }}</label>
                                        <input type="text" id="price" class="form-control" name="vendor_price" value="{{ old('vendor_price', $product->vendor_price) }}" >
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
                                <div class="box-body">
                                    <div class="form-group @if($errors->has('vendor_code'))has-error @endif">
                                        <label for="vendor_code" class="col-form-label">{{ __('fillable.VendorCode') }}</label>
                                        <input type="text" id="vendor_code" class="form-control" name="vendor_code" value="{{ old('vendor_code', $product->vendor_code) }}" required>
                                        @if ($errors->has('vendor_code'))
                                            <span class="help-block"><strong>{{ $errors->first('vendor_code') }}</strong></span>
                                        @endif
                                    </div>

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
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </form>
                <form id="product-photos-action" method="POST" action="">
                    @csrf
                </form>


            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="addPhoto">
                <div class="row">
                    <div class="col-xs-9">
                        <div class="box box-solid">
                            <div class="box-body">
                                <ul class="mailbox-attachments clearfix">
                                    @foreach($product->photos as $photo)
                                        <li>
                                            <span class="mailbox-attachment-icon has-img"><img src="{{ Storage::disk('public')->url('products/original/'. $photo->file) }}" alt="Attachment"></span>

                                            <div class="mailbox-attachment-info">
                                                <a href="{{ Storage::disk('public')->url('products/original/'. $photo->file) }}" target="_blank" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{ $photo->file }}</a>
                                                <span class="mailbox-attachment-size">
                                                {{ $photo->getSize() }}
                                              <div class="bnt-group ">
                                                  <a href="#" class="btn btn-default btn-xs "><i class="fa fa-cloud-download"></i></a>
                                                  <a href="#" data-url="{{ route('admin.products.photos.main', [$product, $photo->id]) }}" id="main-photo-product" data-id="{{ $photo->id }}" class="btn btn-{{ $photo->main == 'yeas' ? 'success disabled' : 'default' }} btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="Сделать Главным"><i class="fas fa-check-circle"></i></a>
                                                  <a href="#" data-url="{{ route('admin.products.photos.delete', [$product, $photo->id]) }}" id="delete-photo-product" data-id="{{ $photo->id }}" class="btn btn-default btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="Удалить"><i class="fas fa-trash"></i></a>
                                              </div>
                                            </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                @include('admin.products.photo._create', $product)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    <!-- /.tab-pane -->
@endsection
