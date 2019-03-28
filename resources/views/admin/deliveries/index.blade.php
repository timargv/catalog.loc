@extends('admin.layouts.app')

@section('title', 'Способы Доставок')


@section('content')

    <div class="row">
        <div class="col-xs-9">
            <div class="box box-solid">
                <div class="box-header">
                    <div class="box-title">
                        Способы Доставок
                    </div>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.deliveries.create') }}" class="btn  bg-purple btn-sm"><i class="fal fa-plus mr-1"></i> Добавить</a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('admin.deliveries._list', ['deliveries' => $deliveries])
                    {{--{{ $deliveries->links() }}--}}
                </div>
            </div>
        </div>
    </div>
    <style>
        td .fa:before {
            font-size: 10px!important;
            margin-left: 15px !important;
        }
    </style>
@endsection
