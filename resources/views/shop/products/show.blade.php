@extends('layouts.app')

@section('content')

    <div class="row justify-content-start pt-5">
        <div class="col-12">
            <div class="row" style="min-height: 400px;">
                <div class="col-7">
                    <div class="content-carousel">
                        <div id="gallery" class="row">
                            <div class="col-2">
                                <div class="image-gallery">
                                    <aside class="thumbnails">
                                        @foreach($product->photos as $photo)

                                            <div class="@if ($loop->first) selected @endif thumbnail" data-big="{{ url('/storage/products/large/'.  $photo->file) }}">
                                            <div class="thumbnail-image" style="background-image: url('{{ url('/storage/products/item/'.  $photo->file) }}')"></div>
                                        </div>
                                        @endforeach
                                    </aside>
                                </div>
                            </div>
                            <div class="col-10">
                                @forelse($product->photos as $photo)
                                    <div class="primary" style="background-image: url('{{ url('/storage/products/large/'.  $photo->file) }}');"></div>
                                    @if ($loop->first)
                                        @break
                                    @endif
                                @empty
                                <div class="primary" style="background-image: url('{{ Storage::disk('public')->url('image/no_photo.jpg') }}');"></div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5 pl-5">
                    <div class="title-product-full">
                        <h1 class="text-dark">{{ $product->name ?: $product->name_original  }}</h1>
                        @auth
                            @if(!empty(Auth::user()->isAdmin() || Auth::user()->isModerator()))
                                <div class="card border-0 p-0 mb-0">
                                    <div class="card-body p-0 mb-0">
                                        @if($product->vendor->url)
                                            <h6 class="card-subtitle mt-1 pb-0 mb-0">Поставщик: <a class="pl-2 text-catalog" href="{{ $product->vendor->url }}" target="_blank">{{ $product->vendor->title }}</a></h6>
                                        @endif
                                        @if($product->original_url)
                                            <div class="card-subtitle mt-1 pb-0 mb-0 align-text-top">На сайте поставщик: <a class="pl-0 text-catalog" href="{{ $product->original_url }}" target="_blank">открыть сайт</a>
                                                <br /> #{{ $product->vendor_code }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endauth
                        @guest
                        <div class="card border-0 p-0 mb-0">
                                <div class="card-body p-0 mb-0">
                                    @if($product->vendor_code)
                                        <h6 class="card-subtitle mt-1 pb-0 mb-0"># {{ $product->vendor_code }}</h6>
                                    @endif
                                </div>
                            </div>
                        @endguest

                    </div>
                    <div class="border-bottom border-light-active w-100 mt-4 mb-4"></div>
                    <div class="price-product-full">
                        <div id="price" class="price text-dark">{{ $product->price }} </div>
                    </div>
                    <div class="quantity-product-full mb-2">@if(!empty($product->quantity)) <span class="text-success">В наличии на складе</span> @else <span class="text-danger">Нет на складе</span> @endif  </div>
                    <div class="add-cart-product-full-block mb-4">
                        <div class="row">
                            @auth
                            <div class="col-6 pr-1">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline border-catalog-2 btn-lg text-catalog w-100"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>Быстрый заказ</span></button>
                                </form>
                            </div>
                            <div class="col-6 pl-1">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf

                                        @if(empty($product->checkCartProduct()))
                                            <button class="btn bg-catalog border-catalog-2 btn-lg w-100 text-white"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>В корзину</span></button>
                                        @else
                                            <a href="{{ route('cart.index') }}" class="btn btn-outline border-catalog-2 btn-lg text-catalog w-100"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>В корзине</span></a>
                                        @endif


                                </form>
                            </div>
                            @endauth
                            @guest
                                <div class="col-8">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        @if(empty($product->checkCartProduct()))
                                            <button class="btn bg-catalog border-catalog-2 btn-lg w-100 text-white"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>Добавить в корзину</span></button>
                                        @else
                                            <a href="{{ route('cart.index') }}" class="btn btn-outline border-catalog-2 btn-lg text-catalog w-100"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>В корзине</span></a>
                                        @endif
                                    </form>
                                </div>
                            @endguest
                        </div>
                    </div>
                    @if(!empty($product->brand->title))
                    <div class="brand-product-full-block">
                        <div class=""><span class="h5 pr-2">Бренд: </span> <span class="h5 text-dark">{{ $product->brand->title }}</span></div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row my-5">
                <div class="col-10 pr-0">

                    <div class="spec-product-full-block text-dark">
                        @if ($product->category->allAttributes())
                        <div class="spec-product-full-block-title mb-4">Характеристики и описание</div>
                        @else
                            <div class="spec-product-full-block-title mb-4">Описание</div>
                        @endif

                        <div class="product-full-description mb-5">
                            {{ $product->desc }}
                        </div>

                        @if ($product->category->allAttributes())
                        @foreach($product->getGroup($product->category->allAttributes()) as $key => $groupAttribute)
                        <div class="spec-product-full-title mb-3">
                            {{ $product->getGroupNameAttribute($key)->name }}
                        </div>
                        <div class="mb-5">

                            @foreach($groupAttribute as $attribute)
                            @if($product->getValue($attribute->id) && $attribute->status == 1)
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-6 pr-0">
                                    <div>{{ $attribute->name }}</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-6 pr-0">
                                    @if($attribute->name == 'Ссылка на сертификат')
                                        <a href="{{ $product->getValue($attribute->id) }}" target="_blank">ссылка</a>
                                    @else
                                        {{ $product->getValue($attribute->id) }}
                                    @endif
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


