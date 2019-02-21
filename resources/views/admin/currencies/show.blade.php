@extends('admin.layouts.app')

@section('title', $shipper->title)

@section('content')
    <div class="box box-info">
        <div class="box-header ">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.shippers.create') }}" class="btn btn-success mr-1 btn-sm"><i class="far fa-plus pr-1"></i> {{ __('button.Add') }}</a>
                <a href="{{ route('admin.shippers.edit', $shipper) }}" class="btn btn-primary mr-1 btn-sm"><i class="far fa-edit pr-2"></i> {{ __('button.Edit') }}</a>
                <form method="POST" action="{{ route('admin.shippers.destroy', $shipper) }}" class="form-inline pull-right">
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
                    <th width="200px">ID</th><td>{{ $shipper->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Title') }}</th><td>{{ $shipper->title }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Number') }}</th><td>{{ $shipper->number }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Email') }}</th><td><a href="{{ $shipper->email != null ? 'mailto:'.$shipper->email : '#'}}" target="_blank">{{ $shipper->email != null ? $shipper->email : '-'}}</a></td>
                </tr>
                <tr>
                    <th>{{ __('fillable.CodeProduct') }}</th><td>{{ $shipper->code_product }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Address') }}</th><td>{{ $shipper->address }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Url') }}</th><td><a href="{{ $shipper->url != null ? $shipper->url : '#'}}" target="_blank">{{ $shipper->url != null ? $shipper->url : '-'}}</a></td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Slug') }}</th><td>{{ $shipper->slug }}</td>
                </tr>

                <tbody>
                </tbody>
            </table>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.shippers.index') }}" class="btn btn-primary pull-right"> <i class="far fa-arrow-left pr-2"></i> {{ __('button.Back') }}</a>
            </div>
        </div>
    </div>




@endsection