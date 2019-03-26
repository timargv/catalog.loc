@extends('admin.layouts.app')

@section('title', 'Все Статусы')


@section('content')

    <div class="row">
        <div class="col-xs-9">
            <div class="box box-solid">
                <div class="box-header">
                    <div class="box-title">
                        Статусы
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('admin.order-statuses-lists._list', ['statuses' => $statuses])
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="box box-solid">
                <div class="box-header">
                    <div class="box-title">
                        Добавить статус
                    </div>

                </div>
                <div class="box-body table-responsive no-padding">
                    @include('admin.order-statuses-lists.create')
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
