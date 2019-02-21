@extends('admin.layouts.app')

@section('title', 'Все Категории')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <span class="mr-3 small">
                            <i class="fas fa-circle text-warning"></i>
                            <span>нет в наличии</span>
                        </span>
                    <span class="mr-3 small">
                            <i class="fas fa-circle text-danger"></i>
                            <span>Отключен</span>
                        </span>
                    <h3 class="box-title"></h3>
                    <div class="box-tools">

                        <a href="{{ route('admin.products.create') }}" class="btn bg-light text-dark btn-sm"><i class="far fa-plus mr-1"></i> {{ __('button.Add') }} {{ __('product.Product') }}</a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding ">
                    @include('admin.products._list', ['products' => $products])

                    <div class="px-3">{{ $products->links() }}</div>
                </div>
            </div>
        </div>
        {{--<div class="col-xs-2">--}}
            {{--<div class="box box-solid">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<div class="box-title">Filter</div>--}}
                {{--</div>--}}
                {{--<div class="box-body">--}}
                    {{--<div class=" mb-3">--}}
                        {{--<form action="?" method="GET">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="vendor_code" class="col-form-label">Код Товара</label>--}}
                                {{--<input id="vendor_code" class="form-control" name="vendor_code" value="{{ request('vendor_code') }}">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="name" class="col-form-label">Навание Товара</label>--}}
                                {{--<input id="name" class="form-control" name="name" value="{{ request('name') }}">--}}
                            {{--</div>--}}

                            {{--<div class="form-group @if($errors->has('category'))has-error @endif">--}}
                                {{--<label for="category" class="col-form-label">{{ __('category.Category') }}</label>--}}
                                {{--<select id="category" class="form-control select2 w-100 {{ $errors->has('category') ? ' is-invalid' : '' }}" name="category">--}}
                                    {{--<option value=""></option>--}}
                                    {{--@foreach ($categories as $parent)--}}
                                        {{--<option value="{{ $parent->id }}"{{ $parent->id == old('parent', request('category')) ? ' selected' : '' }}>--}}
                                            {{--@for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor--}}
                                            {{--{{ $parent->name == null ? $parent->name_original : $parent->name }}--}}
                                        {{--</option>--}}
                                    {{--@endforeach;--}}
                                {{--</select>--}}
                                {{--@if ($errors->has('category'))--}}
                                    {{--<span class="help-block"><strong>{{ $errors->first('category') }}</strong></span>--}}
                                {{--@endif--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<button type="submit" class="btn btn-primary">{{ __('button.Search') }}</button>--}}
                                {{--<a href="?" class="btn btn-outline-secondary">{{ __('button.Clear') }}</a>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

@endsection
