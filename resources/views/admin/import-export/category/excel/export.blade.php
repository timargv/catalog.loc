@extends('admin.layouts.app')

@section('title', 'Export')

@section('content')

    <div class="row">
        <div class="col-xs-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="box-title">Все Категории </div>
                    <div class="box-tools pull-right">
                        <button type="button" class="invisible btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                        <a href="{{ route('admin.categories.create') }}" class="btn  bg-purple btn-xs"><i class="fal fa-plus"></i> Добавить</a>
                    </div>

                </div>
                <!-- /.box-header -->

                <div class="box-body">

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                </div>

            </div>
        </div>

    </div>

@endsection