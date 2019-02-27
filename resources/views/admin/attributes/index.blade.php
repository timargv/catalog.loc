@extends('admin.layouts.app')

@section('title', 'Все Группы атрибутов')


@section('content')
    <div class="row">
        <div class="col-xs-9">
            <div class="box box-solid mb-5">
                <div class="box-header">
                    <div class="box-title">
                        Группы Атрибутов
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('admin.attributes.groups._list', ['attr_groups' => $attributeGroups])
{{--                    {{ $attributeGroups->links() }}--}}
                </div>
            </div>

            <div class="box  mb-5">
                <div class="box-header pr-2">
                    <div class="box-title">
                        Все Атрибуты
                    </div>
                    <div class="box-tools">
                        <form action="?" method="GET" class="form-inline">
                            <div class="input-group input-group-sm" >
                                <input type="search" name="search_attribute" class="form-control pull-right" placeholder="Название Атрибута" style="width: 150px;" value="{{ old('search_attribute', request('search_attribute')) }}">

                                <div class="input-group-btn">
                                    {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                                    <a href="?" class="btn bg-default text-dark" data-toggle="tooltip" data-placement="top" title="Очистить Поиск"><i class="far fa-redo-alt"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('admin.attributes._list', ['attributes' => $attributes])
                    <div class="px-3">
                        {{ $attributes->appends(Request::only('search_attribute'))->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            {{-- Добавить группа Атрибутов --}}
            @include('admin.attributes.groups.create')
            @include('admin.attributes.create')
        </div>
    </div>
    <style>
        td .fa:before {
            font-size: 10px!important;
            margin-left: 15px !important;
        }
    </style>
@endsection
