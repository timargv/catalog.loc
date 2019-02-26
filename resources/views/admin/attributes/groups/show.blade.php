@extends('admin.layouts.app')

@section('title', $attributeGroup->name)

@section('content')
    <div class="box box-info">
        <div class="box-header ">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.attribute-groups.index') }}" class="btn btn-success mr-1 btn-sm"><i class="far fa-plus pr-1"></i> {{ __('button.Add') }}</a>
                <a href="{{ route('admin.attribute-groups.edit', $attributeGroup) }}" class="btn btn-primary mr-1 btn-sm"><i class="far fa-edit pr-2"></i> {{ __('button.Edit') }}</a>
                <form method="POST" action="{{ route('admin.attribute-groups.destroy', $attributeGroup) }}" class="form-inline pull-right">
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
                    <th width="200px">ID</th><td>{{ $attributeGroup->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Title') }}</th><td>{{ $attributeGroup->name }}</td>
                </tr>

                <tr>
                    <th>{{ __('fillable.Slug') }}</th><td>{{ $attributeGroup->slug }}</td>
                </tr>

                <tbody>
                </tbody>
            </table>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.attribute-groups.index') }}" class="btn btn-primary pull-right"> <i class="far fa-arrow-left pr-2"></i> {{ __('button.Back') }}</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-9">
            <div class="box box-solid">
                <div class="box-header">
                    <div class="box-title">Атрибуты</div>
                </div>
                <div class="box-body">
                    @include('admin.attributes._list', $attributes)
                    <div class="px-3">
                        {{ $attributes->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            @include('admin.attributes.create', ['attributeGroups' => $attributeGroups])
        </div>
    </div>


@endsection