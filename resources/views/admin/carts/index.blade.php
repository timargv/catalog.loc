@extends('admin.layouts.app')

@section('title', 'Все Корзины')


@section('content')

    <div class="row">
        <div class="col-xs-9">
            @include('admin.carts._list', ['cartItems' => $cartItems])


        </div>
    </div>
    <style>
        td .fa:before {
            font-size: 10px!important;
            margin-left: 15px !important;
        }
    </style>
@endsection
