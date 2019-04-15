@extends('layouts.app')

@section('content')
    <div class=" mb-3 pb-3 border-light-active border-bottom">
        <h1 class="text-dark pt-0" style="font-weight: 500">{{ $category->name }}</h1>
    </div>
    <div class="row justify-content-start">
        <div class="col-3"></div>
        <div class="col-9">
            <div class="row"></div>
            <div class="row">
                @include('shop.products._item', ['products' => $products])

                <div class="w-100 clearfix py-5 px-3">{{ $products->appends(request()->query())->links() }}</div>

            </div>
        </div>
    </div>
@endsection
