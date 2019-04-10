@extends('layouts.app')


@section('content')
<div class="d-flex row">
    @foreach($products as $product)
        <div  class="mb-5 sh-product col-2" >
                <a class="card p-0 border-0 rounded-0 sh-product" href="#{{ $product->id }}">
                    <div class="image p-0">
                        @foreach($product->photos() as $photo)
                            @if($photo->main == 'yeas')
                                <img src="storage/products/medium/{{ $photo->file }}" alt="" class=" img-circle  mr-0 pr-0 w-100" >
                                @break
                            @endif
                        @endforeach
                        @if (!count($product->photos))
                            <img src="../img/no_photo_product.jpg" alt="" class="mr-0 pr-0 w-100" >
                        @endif
                    </div>
                    <div class="card-body px-0 mb-0 pb-0">

                        <div class="price-block">
                            <strong>
                                <span id="price" >{{ $product->price }}</span>
                            </strong>
                            @if($product->price > $product->vendor_price)
                                <i class="fas fa-angle-up text-success mr-1"></i>
                            @elseif($product->price < $product->vendor_price)
                                <i class="fas fa-angle-down text-danger mr-1"></i>
                            @endif
                        </div>

                        <div class="mb-3 title" style="min-height: 40px; max-height: 40px;">
                            {{ $product->name }}
                        </div>

                        <div class="small mb-3">{{ $product->vendor_code }}</div>

                        <div class="btn_group">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm text-white"><span class="hidden-xs hidden-sm hidden-md">В корзину</span></button>
                            </form>
                        </div>

                    </div>

                </a>
            </div>
    @endforeach
    </div>
@stop
