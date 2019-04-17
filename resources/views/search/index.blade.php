@extends('layouts.app')


@section('content')
    <h1 class="text-dark font-weight-bold mb-5" style="font-weight: 500">Товаров найдено {{ count($products) }}</h1>

    <div class="d-flex row">

    @include('shop.products._item', ['products' => $products])
    <div class="w-100 clearfix py-5 px-3">{{ $products->appends(request()->query())->links() }}</div>
    </div>
@stop
