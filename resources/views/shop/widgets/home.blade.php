<div class="container wm-1140 position-relative mb-5">
    @if($widgetHome->isTypeProduct())
    <div class="@if(count($widgetHome->widgetProductItems) > 5) owl-carousel owl-theme @else d-flex row @endif">
        @foreach ($widgetHome->widgetProductItems as $product)
            <div  class=" mb-4 sh-product" style="@if(count($widgetHome->widgetProductItems) < 6) width:20%; padding: 0 15px; @endif">
                <a class="card p-0 border-0 rounded-0 sh-product" href="{{ $product->id }}">
                    <div class="image p-0">
                        @foreach($product->product->photos as $photo)
                            @if($photo->main == 'yeas')
                                <img src="{{ url('storage\products\medium\\'). $photo->file }}" alt="" class=" img-circle  mr-0 pr-0 w-100" >
                                @break
                            @endif
                        @endforeach
                        @if (!count($product->product->photos))
                            <img src="img/no_photo_product.jpg" alt="" class="mr-0 pr-0 w-100" >
                        @endif
                    </div>
                    <div class="card-body px-0 mb-0 pb-0">

                        <div class="price-block">
                            <strong>
                                <span id="price" >{{ $product->product->price }}</span>
                            </strong>
                            @if($product->product->price > $product->product->vendor_price)
                                <i class="fas fa-angle-up text-success mr-1"></i>
                            @elseif($product->product->price < $product->product->vendor_price)
                                <i class="fas fa-angle-down text-danger mr-1"></i>
                            @endif
                        </div>

                        <div class="mb-3 title">
                            {{ $product->product->name }}
                        </div>

                        <div class="small mb-3">{{ $product->vendor_code }}</div>

                        <div class="btn_group">
                            <form action="{{ route('cart.add', $product->product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm text-white"><span class="hidden-xs hidden-sm hidden-md">В корзину</span></button>
                            </form>
                        </div>

                    </div>

                </a>
            </div>
        @endforeach
    </div>
    @elseif($widgetHome->isTypeCategory())
        <div class="row">
            @foreach ($widgetHome->widgetCategoryItems as $widget)
                <div  class="col-2 mb-5 sh-product text-center">
                    <a class="text-muted text-decoration-none" href="{{ $widget->category->id }}" style="font-size: 17px">
                    <div class="image mb-3">
                        <img class="w-100 rounded-circle" src="{{ $widget->category->image == null ? Storage::disk('public')->url('image/no_photo.jpg') : Storage::disk('public')->url('category/thumbnail_category/'.  $widget->category->image) }}" alt="">
                    </div>
                    {{ $widget->category->name }}</a>
                </div>
            @endforeach
        </div>
    @endif
</div>





{{--<div class="mb-4 rounded overflow-hidden">--}}
    {{--<div id="widget_{{$widget_id}}" class="carousel slide" data-ride="carousel">--}}

        {{--<ol class="carousel-indicators">--}}
            {{--<li data-target="#widget_{{$widget_id}}" data-slide-to="0" class="active"></li>--}}
            {{--<li data-target="#widget_{{$widget_id}}" data-slide-to="1"></li>--}}
        {{--</ol>--}}

        {{--<div class="carousel-inner">--}}
            {{--@foreach  ($widgetProductItems->chunk(6) as $chunk)--}}
                {{--<div class="carousel-item @if($loop->first) active @endif  wm-1140 ">--}}
                    {{--<div class="d-flex">--}}
                        {{--@foreach ($chunk as $product)--}}
                            {{--<div style="width: 16.66%" class=" mb-4">--}}
                                {{--<a class="card p-0 border-0 rounded-0 sh-product" href="{{ $product->id }}">--}}
                                    {{--<div class="image p-0">--}}
                                        {{--@foreach($product->product->photos as $photo)--}}
                                            {{--@if($photo->main == 'yeas')--}}
                                                {{--<img src="storage/products/medium/{{ $photo->file }}" alt="" class=" img-circle  mr-0 pr-0 w-100" >--}}
                                                {{--@break--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                        {{--@if (!count($product->product->photos))--}}
                                            {{--<img src="img/no_photo.jpg" alt="" class="mr-0 pr-0 w-100" >--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                    {{--<div class="card-body px-0 mb-3">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-12">--}}
                                                {{--<strong>--}}
                                                    {{--<span id="price" >{{ $product->product->price }}</span>--}}
                                                {{--</strong>--}}
                                                {{--@if($product->product->price > $product->product->vendor_price)--}}
                                                    {{--<i class="fas fa-angle-up text-success mr-1"></i>--}}
                                                {{--@elseif($product->product->price < $product->product->vendor_price)--}}
                                                    {{--<i class="fas fa-angle-down text-danger mr-1"></i>--}}
                                                {{--@endif--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div class="w-100 mb-3 title">--}}
                                            {{--{{ $product->product->name }}--}}
                                            {{--                                    <a href="{{ $product->original_url }}" target="_blank" class="w-100 d-block">На сайте Мир Инструммента</a>--}}
                                        {{--</div>--}}

                                        {{--<div class="small mb-3">{{ $product->vendor_code }}</div>--}}
                                        {{--<div class="col-xs-12">--}}
                                            {{--<form action="{{ route('cart.add', $product->product->id) }}" method="POST">--}}
                                                {{--@csrf--}}
                                                {{--<button class="btn btn-sm text-white"><span class="hidden-xs hidden-sm hidden-md">В корзину</span></button>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}

        {{--<a class="carousel-control-prev" href="#widget_{{$widget_id}}" role="button" data-slide="prev">--}}
            {{--<span class="far fa-chevron-left rounded-circle fa-2x" style="background-color: #484646;padding: 10px 18px 10px 16px" aria-hidden="true"></span>--}}
            {{--<span class="sr-only">Previous</span>--}}
        {{--</a>--}}
        {{--<a class="carousel-control-next" href="#widget_{{$widget_id}}" role="button" data-slide="next">--}}
            {{--<span class="far fa-chevron-right rounded-circle fa-2x" style="background-color: #484646;padding: 10px 18px;" aria-hidden="true"></span>--}}
            {{--<span class="sr-only">Next</span>--}}
        {{--</a>--}}
    {{--</div>--}}
{{--</div>--}}

