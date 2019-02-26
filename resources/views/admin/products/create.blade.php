@extends('admin.layouts.app')

@section('title', 'Добавление Товара')

@section('content')


    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-body">

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
            <form id="edit-product-form" method="POST" action="{{ route('admin.products.store') }}">
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
                                                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent') ? ' selected' : '' }}>
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
                                                    <option value="{{ $vendor->id }}"{{ $vendor == old('vendor') ? ' selected' : '' }}>{{ $vendor->title }}</option>
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
                                                    <option value="{{ $brand->id }}"{{ $brand == old('brand') ? ' selected' : '' }}>{{ $brand->title }}</option>
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
                                            <input id="title" class="form-control" name="name" value="{{ old('name') }}" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>


                                        <div class="form-group @if($errors->has('name_original'))has-error @endif">
                                            <label for="name_original" class="col-form-label">{{ __('fillable.NameOriginal') }}</label>
                                            <input id="name_original" class="form-control" name="name_original" value="{{ old('name_original') }}">
                                            @if ($errors->has('name_original'))
                                                <span class="help-block"><strong>{{ $errors->first('name_original') }}</strong></span>
                                            @endif
                                        </div>

                                        <div class="form-group @if($errors->has('slug'))has-error @endif">
                                            <label for="slug" class="col-form-label">{{ __('fillable.Slug') }}</label>
                                            <input type="text" id="slug" class="form-control" name="slug" value="{{ old('slug') }}" required>
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
                                            <textarea rows="3" id="sh_desc" type="text" class="form-control{{ $errors->has('sh_desc') ? ' is-invalid' : '' }}" name="sh_desc">{{ old('sh_desc') }}</textarea>
                                            @if ($errors->has('sh_desc'))
                                                <span class="help-block"><strong>{{ $errors->first('sh_desc') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="box box-solid">
                                    <div class="box-body">
                                        <div class="form-group @if($errors->has('desc'))has-error @endif">
                                            <label for="desc" class="col-form-label">{{ __('fillable.Description') }}</label>
                                            <textarea rows="7" id="desc" type="text" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" name="desc">{{ old('desc') }}</textarea>
                                            @if ($errors->has('desc'))
                                                <span class="help-block"><strong>{{ $errors->first('desc') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xs-12">
                                <div class="box box-solid">
                                    <div class="box-body">
                                        <div class="form-group @if($errors->has('original_url'))has-error @endif">
                                            <label for="original_url" class="col-form-label">{{ __('fillable.OriginalUrl') }}</label>
                                            <input id="original_url" class="form-control" name="original_url" value="{{ old('original_url') }}">
                                            @if ($errors->has('original_url'))
                                                <span class="help-block"><strong>{{ $errors->first('original_url') }}</strong></span>
                                            @endif
                                        </div>

                                        <div class="form-group @if($errors->has('original_id'))has-error @endif">
                                            <label for="original_id" class="col-form-label">{{ __('fillable.OriginalId') }}</label>
                                            <input id="original_id" class="form-control" name="original_id" value="{{ old('original_id') }}">
                                            @if ($errors->has('original_id'))
                                                <span class="help-block"><strong>{{ $errors->first('original_id') }}</strong></span>
                                            @endif
                                        </div>

                                        <div class="form-group @if($errors->has('vendor_code_original'))has-error @endif">
                                            <label for="vendor_code_original" class="col-form-label">{{ __('fillable.VendorCodeOriginal') }}</label>
                                            <input type="text" id="vendor_code_original" class="form-control" name="vendor_code_original" value="{{ old('vendor_code_original') }}">
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
                                                    <option value="{{ $status }}"{{ $status == old('status') ? ' selected' : '' }}>{{ $label }}</option>
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
                                                    <option value="{{ $available }}"{{ $available == old('available') ? ' selected' : '' }}>{{ $label }}</option>
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

                        <div class="box box-solid mb-4">
                            <div class="box-header with-border">
                                <div class="box-title">
                                    Цены
                                </div>
                            </div>
                            <div class="box-body ">
                                <div class="form-group @if($errors->has('price'))has-error @endif">
                                    <label for="price" class="col-form-label">Базовая стоимость</label>
                                    <input type="text" id="price" class="form-control" name="price" value="{{ old('price') }}" >
                                    @if ($errors->has('price'))
                                        <span class="help-block"><strong>{{ $errors->first('price') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->has('vendor_price'))has-error @endif">
                                    <label for="price" class="col-form-label">{{ __('fillable.VendorPrice') }}</label>
                                    <input type="text" id="price" class="form-control" name="vendor_price" value="{{ old('vendor_price') }}" >
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
                                <div class="form-group @if($errors->has('vendor_code'))has-error @endif">
                                    <label for="vendor_code" class="col-form-label">{{ __('fillable.VendorCode') }}</label>
                                    <input type="text" id="vendor_code" class="form-control" name="vendor_code" value="{{ old('vendor_code') }}" required>
                                    @if ($errors->has('vendor_code'))
                                        <span class="help-block"><strong>{{ $errors->first('vendor_code') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('type_packaging'))has-error @endif">
                                    <label for="type_packaging" class="col-form-label">{{ __('Тип упаковки') }}</label>
                                    <input type="text" id="type_packaging" class="form-control" name="type_packaging" value="{{ old('type_packaging') }}" >
                                    @if ($errors->has('type_packaging'))
                                        <span class="help-block"><strong>{{ $errors->first('type_packaging') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('packing_dimensions'))has-error @endif">
                                    <label for="packing_dimensions" class="col-form-label">{{ __('Габариты в упаковке, мм') }}</label>
                                    <input type="text" id="packing_dimensions" class="form-control" name="packing_dimensions" value="{{ old('packing_dimensions') }}" >
                                    @if ($errors->has('packing_dimensions'))
                                        <span class="help-block"><strong>{{ $errors->first('packing_dimensions') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('length'))has-error @endif">
                                    <label for="length" class="col-form-label">{{ __('Длина в упаковке, мм') }}</label>
                                    <input type="text" id="length" class="form-control" name="length" value="{{ old('length') }}" >
                                    @if ($errors->has('length'))
                                        <span class="help-block"><strong>{{ $errors->first('length') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('width'))has-error @endif">
                                    <label for="width" class="col-form-label">{{ __('Ширина в упаковке, мм') }}</label>
                                    <input type="text" id="width" class="form-control" name="width" value="{{ old('width') }}" >
                                    @if ($errors->has('width'))
                                        <span class="help-block"><strong>{{ $errors->first('width') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('height'))has-error @endif">
                                    <label for="height" class="col-form-label">{{ __('Высота в упаковке, мм') }}</label>
                                    <input type="text" id="height" class="form-control" name="height" value="{{ old('height') }}" >
                                    @if ($errors->has('height'))
                                        <span class="help-block"><strong>{{ $errors->first('height') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('weight'))has-error @endif">
                                    <label for="weight" class="col-form-label">{{ __('fillable.Weight') }}, мм</label>
                                    <input type="text" id="weight" class="form-control" name="weight" value="{{ old('weight') }}" >
                                    @if ($errors->has('weight'))
                                        <span class="help-block"><strong>{{ $errors->first('weight') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('barcode'))has-error @endif">
                                    <label for="barcode" class="col-form-label">{{ __('fillable.Barcode') }}</label>
                                    <input type="text" id="barcode" class="form-control" name="barcode" value="{{ old('barcode') }}" >
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



        </div>
        <!-- /.tab-pane -->


    </div>


    <!-- /.tab-pane -->
@endsection
