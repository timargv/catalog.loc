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
                    {{ $attributeGroups->links() }}
                </div>
            </div>

            <div class="box box-solid mb-5">
                <div class="box-header">
                    <div class="box-title">
                        Все Атрибуты
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('admin.attributes._list', ['attributes' => $attributes])
                    {{ $attributes->links() }}
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
