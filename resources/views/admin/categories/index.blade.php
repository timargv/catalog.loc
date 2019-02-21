@extends('admin.layouts.app')

@section('title', 'Все Категории')

@section('content')

    <div class="row">
        <div class="col-xs-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="box-title">Все Категории </div>
                    <div class="box-tools pull-right">
                        <button type="button" class="invisible btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus mr-2"></i></button>

                        <a href="{{ route('admin.categories.fix') }}" class="btn  bg-red btn-xs mr-3"><i class="fal fa-sync-alt mr-1"></i> Fix</a>
                        <a href="{{ route('admin.categories.create') }}" class="btn  bg-purple btn-xs"><i class="fal fa-plus"></i> Добавить</a>
                    </div>

                </div>
                <!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                    @include('admin.categories._list', ['categories' => $categories])
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    {{ $categories->links() }}
                </div>

            </div>
        </div>
        <div class="col-xs-3">

            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="box-title"><i class="fa fa-search"></i> <small>Поиск Категории</small></div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <form action="?" method="GET">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="search" class="form-control" name="name_original" value="{{ request('name_original') }}" placeholder="Название категории">
                            </div>
                            <div class="form-group">
                                <input type="search" class="form-control" name="category_id" value="{{ request('category_id') }}" placeholder="id категории">
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('button.Search') }}</button>
                                <a href="?" class="btn bg-navy">{{ __('button.Clear') }}</a>
                            </div>

                        </div>
                    </form>

                </div>

            </div>

            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="box-title"><small>Добавить Категорию</small></div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-form-label">{{ __('category.Title') }}</label>
                                <input id="name" type="text" name="name" class="form-control" placeholder="{{ __('category.Title') }}">
                            </div>
                            <div class="form-group">
                                <label for="name_original" class="col-form-label">{{ __('category.Title_Original') }}</label>
                                <input id="name_original" type="text" name="name_original" class="form-control" placeholder="{{ __('category.Title_Original') }}">
                            </div>
                            <div class="form-group">
                                <label for="slug" class="col-form-label">Slug</label>
                                <input id="slug" type="text" class="form-control slug" name="slug" value="{{ old('slug') }}" placeholder="slug">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection