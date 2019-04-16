@extends('layouts.app')

@section('content')

    <div class="row justify-content-start pt-5">
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <div class="content-carousel">
                        <div id="gallery" class="row">
                            <div class="col-2">
                                <div class="image-gallery">
                                    <aside class="thumbnails">
                                        @foreach($product->photos as $photo)
                                        <div class="@if ($loop->first) selected @endif thumbnail" data-big="{{ Storage::disk('public')->url('products/medium/'.  $photo->file) }}">
                                            <div class="thumbnail-image" style="background-image: url('{{ Storage::disk('public')->url('products/item/'.  $photo->file) }}')"></div>
                                        </div>
                                        @endforeach
                                    </aside>
                                </div>
                            </div>
                            <div class="col-10">
                                @foreach($product->photos as $photo)
                                <div class="primary" style="background-image: url('{{ Storage::disk('public')->url('products/medium/'.  $photo->file) }}');"></div>
                                    @if ($loop->first)
                                        @break
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        {{--<div class="owl-carousel owl-carousel_product_image owl-theme owl-loaded">--}}
                            {{--<div class="owl-stage-outer">--}}
                                {{--<div class="owl-stage">--}}
                                    {{--@foreach($product->photos as $photo)--}}
                                        {{--<div class="owl-item"><img src="{{ Storage::disk('public')->url('products/medium/'.  $photo->file) }}" alt="" style="width: 200px;"></div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button></div>--}}
                        {{--</div>--}}
                    </div>

                </div>
                <div class="col-6 pl-5">
                    <div class="title-product-full">
                        <h1 class="text-dark">{{ $product->name ?: $product->name_original  }}</h1>
                    </div>
                    <div class="border-bottom border-light-active w-100 mt-4 mb-4"></div>
                    <div class="price-product-full">
                        <div id="price" class="price text-dark">{{ $product->price }} </div>
                    </div>
                    <div class="quantity-product-full mb-4">@if(!empty($product->quantity)) <span class="text-success">В наличии на складе</span> @else <span class="text-danger">Нет на складе</span> @endif  </div>
                    <div class="add-cart-product-full-block mb-4">
                        <div class="row">
                            <div class="col-6 pr-1">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline border-catalog-2 btn-lg text-catalog w-100"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>Быстрый заказ</span></button>
                                </form>
                            </div>
                            <div class="col-6 pl-1">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="btn bg-catalog border-catalog-2 btn-lg w-100 text-white"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>В корзину</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="brand-product-full-block">
                        <div class=""><span class="h5 pr-2">Бренд: </span> <span class="h5 text-dark">{{ $product->brand->title }}</span></div>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-6 pr-0">
                    <div class="spec-product-full-block text-dark">
                        <div class="spec-product-full-block-title mb-4">Характеристики</div>
                        <div class="spec-product-full-title mb-4">
                            Общие характеристики
                        </div>
                        <div class="mb-4">
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                        </div>
                        <div class="spec-product-full-title mb-4">
                            Общие характеристики
                        </div>
                        <div class="mb-4">
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-5 pr-0">
                                    <div>Тип</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-7 pr-0">
                                    электромеханический
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 pl-5">
                    <div class="spec-product-full-block text-dark">
                        <div class="spec-product-full-block-title text-dark mb-4">Описание товара</div>
                        <div class="product-full-description">
                            {{ $product->desc }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
