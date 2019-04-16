@extends('layouts.app')

@section('content')

    <div class="row justify-content-start pt-5">
        <div class="col-12">
            <div class="row" style="min-height: 400px;">
                <div class="col-6">
                    <div class="content-carousel">
                        <div id="gallery" class="row">
                            <div class="col-2">
                                <div class="image-gallery">
                                    <aside class="thumbnails">
                                        @foreach($product->photos as $photo)
                                        <div class="@if ($loop->first) selected @endif thumbnail" data-big="{{ Storage::disk('public')->url('products/large/'.  $photo->file) }}">
                                            <div class="thumbnail-image" style="background-image: url('{{ Storage::disk('public')->url('products/item/'.  $photo->file) }}')"></div>
                                        </div>
                                        @endforeach
                                    </aside>
                                </div>
                            </div>
                            <div class="col-10">
                                @forelse($product->photos as $photo)
                                <div class="primary" style="background-image: url('{{ Storage::disk('public')->url('products/large/'.  $photo->file) }}');"></div>
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
                <div class="col-6 pl-5">
                    <div class="title-product-full">
                        <h1 class="text-dark">{{ $product->name ?: $product->name_original  }}</h1>
                    </div>
                    <div class="border-bottom border-light-active w-100 mt-4 mb-4"></div>
                    <div class="price-product-full">
                        <div id="price" class="price text-dark">{{ $product->price }} </div>
                    </div>
                    <div class="quantity-product-full mb-2">@if(!empty($product->quantity)) <span class="text-success">В наличии на складе</span> @else <span class="text-danger">Нет на складе</span> @endif  </div>
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
                                    @if(empty(auth()->user()->checkCartProduct($product->id)))
                                        <button class="btn bg-catalog border-catalog-2 btn-lg w-100 text-white"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>В корзину</span></button>
                                    @else
                                        <a href="{{ route('cart.index') }}" class="btn btn-outline border-catalog-2 btn-lg text-catalog w-100"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>В корзине</span></a>
                                    @endif
                                </form>
                            </div>
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
                    @if ($product->category->allAttributes())
                    <div class="spec-product-full-block text-dark">
                        <div class="spec-product-full-block-title mb-4">Характеристики и описание</div>


                        <div class="product-full-description mb-5">
                            {{ $product->desc }}
                        </div>


                        @foreach($product->getGroup($product->category->allAttributes()) as $key => $groupAttribute)
                        <div class="spec-product-full-title mb-3">
                            {{ $product->getGroupNameAttribute($key)->name }}
                        </div>
                        <div class="mb-5">

                            @foreach($groupAttribute as $attribute)
                            @if($product->getValue($attribute->id) && $attribute->status == 1)
                            <div class="spec-product-full mb-3 row">
                                <div class="spec-product-full-left col-7 pr-0">
                                    <div>{{ $attribute->name }}</div>
                                    <div class="spec-product-full-left-bef"></div>
                                </div>
                                <div class="spec-product-full-value col-5 pr-0">
                                    {{ $product->getValue($attribute->id) }}
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>
                        @endforeach
                         
                    </div>
                    @endif

                </div>
                
            </div>
        </div>
    </div>
@endsection


