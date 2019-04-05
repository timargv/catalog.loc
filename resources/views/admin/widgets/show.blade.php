@extends('admin.layouts.app')

@section('title', $widget->title)

@section('content')
    <div class="box box-info">
        <div class="box-header ">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.widgets.create') }}" class="btn btn-success mr-1 btn-sm"><i class="far fa-plus pr-1"></i> {{ __('button.Add') }}</a>
                <a href="{{ route('admin.widgets.edit', $widget) }}" class="btn btn-primary mr-1 btn-sm"><i class="far fa-edit pr-2"></i> {{ __('button.Edit') }}</a>
                <form method="POST" action="{{ route('admin.widgets.destroy', $widget) }}" class="form-inline pull-right">
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
                    <th width="200px">ID</th><td>{{ $widget->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('fillable.Title') }}</th><td>{{ $widget->title }}</td>
                </tr>

                <tbody>
                </tbody>
            </table>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.widgets.index') }}" class="btn btn-primary pull-right mr-2"> <i class="far fa-arrow-left pr-2"></i> {{ __('button.Back') }}</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-8">
            <div class="box box-info">
                <div class="box-header">
                    <div class="box-title">Товары</div>
                </div>
                <!-- /.box-header -->

                @if (count($widgetItems) > 0)
                <div class="box-body table-responsive no-padding">


                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th width="20px">ID</th>
                                <th width="200px">{{ __('fillable.Title') }}</th>
                                <th width="40px">{{ __('fillable.Price') }}</th>
                                <th width="40px">{{ __('fillable.Status') }}</th>

                            </tr>
                            @foreach($widgetItems as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td><span id="price">{{ $item->price }}</span></td>
                                <td>
                                    <form method="POST" action="{{ route('admin.widgets.product.delete', [$widget, $item->id]) }}" class="form-inline pull-right">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group btn-group-xs">
                                            <button onclick="return confirm('Удалить Товар из виджета?')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                                        </div>

                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        <tbody>
                        </tbody>
                    </table>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <div class="d-flex flex-row mb-3">
                        {{ $widgetItems->links() }}
                    </div>
                </div>
                @else
                    <div class="box-body table-responsive no-padding">
                        <div class="h4 font-weight-light text-muted text-center py-5">
                            Товаров нет
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <div class="col-xs-4">
            @include('admin.widgets._add_products', [$widget, $products])
        </div>
    </div>


@endsection
