@extends('admin.layouts.app')

@section('title', $vendor->title)

@section('content')
    <form method="POST" action="{{ route('admin.vendors.update', $vendor) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Edit Поставщика
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">


                        <div class="form-group @if($errors->has('title'))has-error @endif">
                            <label for="title" class="col-form-label">{{ __('fillable.Title') }}</label>
                            <input id="title" class="form-control" placeholder="например: ООО АТИС" name="title" value="{{ old('title', $vendor->title) }}" required>
                            @if ($errors->has('title'))
                                <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('number'))has-error @endif">
                            <label for="number" class="col-form-label">{{ __('fillable.Number') }}</label>
                            <input type="text" id="number" class="form-control" name="number" value="{{ old('number', $vendor->number) }}">
                            @if ($errors->has('number'))
                                <span class="help-block"><strong>{{ $errors->first('number') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('email'))has-error @endif">
                            <label for="email" class="col-form-label">{{ __('fillable.Email') }}</label>
                            <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $vendor->email) }}">
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('code_product'))has-error @endif">
                            <label for="code_product" class="col-form-label">{{ __('fillable.CodeShipper') }}</label>
                            <input type="text" id="code_product" class="form-control" name="code_product" value="{{ old('code_product', $vendor->code_product) }}" required>
                            @if ($errors->has('code_product'))
                                <span class="help-block"><strong>{{ $errors->first('code_product') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('address'))has-error @endif">
                            <label for="address" class="col-form-label">{{ __('fillable.Address') }}</label>
                            <input type="text" id="address" class="form-control" name="address" value="{{ old('address', $vendor->address) }}">
                            @if ($errors->has('address'))
                                <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('url'))has-error @endif">
                            <label for="url" class="col-form-label">{{ __('fillable.Url') }}</label>
                            <input type="url" id="url" class="form-control" placeholder="Пример: http://atis36.ru" name="url" value="{{ old('url', $vendor->url) }}">
                            @if ($errors->has('url'))
                                <span class="help-block"><strong>{{ $errors->first('url') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('slug'))has-error @endif">
                            <label for="slug" class="col-form-label">{{ __('fillable.Slug') }}</label>
                            <input type="text" id="slug" class="form-control" name="slug" value="{{ old('slug', $vendor->slug) }}" required>
                            @if ($errors->has('slug'))
                                <span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
                            <a href="{{ route('admin.vendors.index') }}" class="btn btn-danger pull-right"><i class="far fa-times pr-2"></i> {{ __('button.Cancel') }}</a>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </form>

@endsection