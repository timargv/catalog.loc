@extends('layouts.app')

@section('breadcrumbs', '')

@section('slide')
    @include('layouts.slider.slide')
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row pr-2">
                @foreach($widgetsHome as $widgetHome)
                    <div class="col-12 text-center mb-4 pb-2">
                        <div class="w-100 h1 text-dark font-weight-bold title_font_block">{{ $widgetHome->title }}</div>
                    </div>
                    <div class="mb-4 row pl-1">
                        @include('shop.widgets.home', ['widgetHome' => $widgetHome, 'type' => $widgetHome])
                    </div>
                @endforeach

                {{--@foreach ($products as $product)--}}
                    {{--<div class="col-3 col-md-3 col-lg-2 pr-2 mb-4">--}}
                        {{--<a class="card p-0 border-0 rounded-0 sh-product" href="{{ $product->id }}">--}}
                            {{--<div class="image p-0">--}}
                                {{--@foreach($product->photos as $photo)--}}
                                    {{--@if($photo->main == 'yeas')--}}
                                        {{--<img src="storage/products/medium/{{ $photo->file }}" alt="" class=" img-circle  mr-0 pr-0 w-100" >--}}
                                        {{--@break--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                                {{--@if (!count($product->photos))--}}
                                    {{--<img src="img/no_photo.jpg" alt="" class="mr-0 pr-0 w-100" >--}}
                                {{--@endif--}}
                            {{--</div>--}}
                            {{--<div class="card-body px-0 mb-3">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-12">--}}
                                        {{--<strong>--}}
                                            {{--<span id="price" >{{ $product->price }}</span>--}}
                                        {{--</strong>--}}
                                        {{--@if($product->price > $product->vendor_price)--}}
                                            {{--<i class="fas fa-angle-up text-success mr-1"></i>--}}
                                        {{--@elseif($product->price < $product->vendor_price)--}}
                                            {{--<i class="fas fa-angle-down text-danger mr-1"></i>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="w-100 mb-3 title">--}}
                                    {{--{{ $product->name }}--}}
{{--                                    <a href="{{ $product->original_url }}" target="_blank" class="w-100 d-block">На сайте Мир Инструммента</a>--}}
                                {{--</div>--}}

                                {{--<div class="small mb-3">{{ $product->vendor_code }}</div>--}}
                                {{--<div class="col-xs-12">--}}
                                    {{--<form action="{{ route('cart.add', $product->id) }}" method="POST">--}}
                                        {{--@csrf--}}
                                        {{--<button class="btn btn-sm text-white"><span class="hidden-xs hidden-sm hidden-md">В корзину</span></button>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                        {{--</a>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            </div>
{{--            <div class="px-0">{{ $products->appends(request()->query())->links() }}</div>--}}
        </div>
    </div>
@endsection
