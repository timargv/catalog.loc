@extends('admin.layouts.app')

@section('title', $vendor->title)

@section('content')
    <div class="box box-info">
        <div class="box-header ">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.vendors.create') }}" class="btn btn-success mr-1 btn-sm"><i class="far fa-plus pr-1"></i> {{ __('button.Add') }}</a>
                <a href="{{ route('admin.vendors.edit', $vendor) }}" class="btn btn-primary mr-1 btn-sm"><i class="far fa-edit pr-2"></i> {{ __('button.Edit') }}</a>
                <form method="POST" action="{{ route('admin.vendors.destroy', $vendor) }}" class="form-inline pull-right">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="far fa-times pr-2"></i> {{ __('button.Delete') }}</button>
                </form>
            </div>

        </div>
        <!-- /.box-header -->

        <div class="box-body table-responsive no-padding">


            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th width="200px">ID</th><td>{{ $vendor->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Title') }}</th><td>{{ $vendor->title }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Number') }}</th><td>{{ $vendor->number }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Email') }}</th><td><a href="{{ $vendor->email != null ? 'mailto:'.$vendor->email : '#'}}" target="_blank">{{ $vendor->email != null ? $vendor->email : '-'}}</a></td>
                </tr>
                <tr>
                    <th>{{ __('fillable.CodeProduct') }}</th><td>{{ $vendor->code_product }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Address') }}</th><td>{{ $vendor->address }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Url') }}</th><td><a href="{{ $vendor->url != null ? $vendor->url : '#'}}" target="_blank">{{ $vendor->url != null ? $vendor->url : '-'}}</a></td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Slug') }}</th><td>{{ $vendor->slug }}</td>
                </tr>

                <tbody>
                </tbody>
            </table>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.vendors.index') }}" class="btn btn-primary pull-right"> <i class="far fa-arrow-left pr-2"></i> {{ __('button.Back') }}</a>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h1 class="box-title">{{ __('product.Products') }} </h1>
        </div>
        <div class="box-body no-padding">
            @include('admin.products._list', ['products' => $vendor->products])
        </div>
    </div>


@endsection