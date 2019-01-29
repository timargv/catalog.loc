@extends('admin.layouts.app')

@section('title', $category->name == null ? 'Категория '. $category->name_original : 'Категория '. $category->name)

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">

            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary mr-1 btn-sm"><i class="far fa-edit pr-2"></i> {{ __('button.Edit') }}</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="form-inline pull-right">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="far fa-times pr-2"></i> {{ __('button.Delete') }}</button>
                </form>
            </div>

        </div>
        <!-- /.box-header -->

        <div class="box-body">


            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th width="200px">ID</th><td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('category.Title') }}</th><td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('category.Title_Original') }}</th><td>{{ $category->name_original }}</td>
                </tr>
                <tr>
                    <th>{{ __('category.Description') }}</th><td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <th>{{ __('category.Status') }}</th>
                    <td>
                        <button data-id="{{ $category->id }}" id="btn-toggle" class="btn btn-md btn-toggle {{ $category->status == 'active' ? 'active' : '' }} " data-toggle="button" aria-pressed="{{ $category->status == 'active' ? 'true' : 'false' }}" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                        {{--<span class="label label-{{ $category->status == 'active' ? 'success' : 'danger' }}">{{ $category->status == 'active' ? 'Active' : 'Выключено' }}</span>--}}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('category.Code') }}</th><td>{{ $category->code }}</td>
                </tr>
                <tr>
                    <th>{{ __('category.Count') }}</th><td>{{ $category->count }}</td>
                </tr>
                <tr>
                    <th>{{ __('category.Image') }}</th><td>{{ $category->image }}</td>
                </tr>
                <tr>
                    <th>{{ __('category.Icon') }}</th><td>{{ $category->icon }}</td>
                </tr>

                <tr>
                    <th>{{ __('category.Slug') }}</th><td>{{ $category->slug }}</td>
                </tr>

                <tbody>
                </tbody>
            </table>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary pull-right"> <i class="far fa-arrow-left pr-2"></i> {{ __('button.Back') }}</a>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h1 class="box-title">{{ __('category.Parental') }} {{ __('category.Category') }} -
                @if(count($categories) == null) Нет @else <strong>{{ $category->name == null ? $category->name_original : $category->name }}</strong> @endif </h1>
        </div>
        <div class="box-body">
             @include('admin.categories._list', ['categories' => $categories])
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
{{--            <h1 class="box-title">Продукты - @if(count($categories) == null) Нет @else <strong>{{ $category->name_original }}</strong> @endif </h1>--}}
        </div>
        <div class="box-body">
{{--            @include('admin.products._list', ['products' => $products])--}}
{{--            {{ $products->links() }}--}}
        </div>
    </div>


@endsection