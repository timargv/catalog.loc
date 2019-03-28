@extends('admin.layouts.app')

@section('title', $delivery->title)

@section('content')
    <div class="box box-info">
        <div class="box-header ">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.deliveries.create') }}" class="btn btn-success mr-1 btn-sm"><i class="far fa-plus pr-1"></i> {{ __('button.Add') }}</a>
                <a href="{{ route('admin.deliveries.edit', $delivery) }}" class="btn btn-primary mr-1 btn-sm"><i class="far fa-edit pr-2"></i> {{ __('button.Edit') }}</a>
                <form method="POST" action="{{ route('admin.deliveries.destroy', $delivery) }}" class="form-inline pull-right">
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
                    <th width="200px">ID</th><td>{{ $delivery->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Title') }}</th><td>{{ $delivery->title }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Cost') }}</th><td>{{ $delivery->cost }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.MinWeight') }}</th><td>{{ $delivery->min_weight }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.MaxWeight') }}</th><td>{{ $delivery->max_weight }}</td>
                </tr>

                <tr>
                    <th>{{ __('fillable.Sort') }}</th><td>{{ $delivery->sort }}</td>
                </tr>

                <tbody>
                </tbody>
            </table>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.deliveries.index') }}" class="btn btn-primary pull-right"> <i class="far fa-arrow-left pr-2"></i> {{ __('button.Back') }}</a>
            </div>
        </div>
    </div>




@endsection