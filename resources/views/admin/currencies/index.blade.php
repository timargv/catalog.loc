@extends('admin.layouts.app')

@section('title', 'Все Поставщики')


@section('content')

    <div class="row">
        <div class="col-xs-9">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Все Поставщики
                    </div>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.shippers.create') }}" class="btn  bg-purple btn-sm"><i class="fal fa-plus mr-1"></i> Добавить</a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('admin.shippers._list', ['shippers' => $shippers])
                    {{ $shippers->links() }}
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="box-title">Filter</div>
                </div>
                <div class="box-body">
                    <div class=" mb-3">
                        <form action="?" method="GET">
                            <div class="form-group">
                                <label for="code_product" class="col-form-label">Код Поставщика</label>
                                <input id="code_product" class="form-control" name="code_product" value="{{ request('code_product') }}">
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-form-label">Название</label>
                                <input id="title" class="form-control" name="title" value="{{ request('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('button.Search') }}</button>
                                <a href="?" class="btn btn-outline-secondary">{{ __('button.Clear') }}</a>
                            </div>
                        </form>
                    </div>
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
