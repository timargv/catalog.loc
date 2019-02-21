@extends('admin.layouts.app')

@section('title', 'Все Поставщики')


@section('content')

    <div class="row">
        <div class="col-xs-9">
            <div class="box box-solid">
                <div class="box-header">
                    <div class="box-title">
                        Бренды
                    </div>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.brands.create') }}" class="btn  bg-purple btn-sm"><i class="fal fa-plus mr-1"></i> Добавить</a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('admin.brands._list', ['brands' => $brands])
                    {{ $brands->links() }}
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
