@if(request()->all())
<a href="?" class="btn bg-catalog text-white btn-sm" data-toggle="tooltip" data-placement="top" title="Очистить Поиск"><i class="far fa-redo-alt"></i> Сбросить фильтр</a>
<div class="clearfix w-100 d-block mb-4"></div>
@endif

@forelse (array_chunk($products->items(), 4) as $chunk)
    @forelse ($chunk as $product)

            <div  class="mb-0 sh-product col-3">
                <a class="card p-0 border-0 rounded-0 sh-product" href="{{ route('product.show', $product->slug?:$product->id) }}">
                    <div class="image p-0">
                        @foreach($product->photos as $photo)
                            @if($photo->main == 'yeas')
                                <img src="{{ $photo->file == null ? url('/storage/image/no_photo.jpg') : url('/storage/products/thumbnail/'.  $photo->file) }}" alt="" class=" img-circle  mr-0 pr-0 w-100" >
                                @break
                            @endif
                        @endforeach
                        @if (!count($product->photos))
                            <img src="{{ url('/storage/image/no_photo.jpg') }}" alt="" class="mr-0 pr-0 w-100" >
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

                        <div class="mb-3 title">
                            {{ $product->name }}
                        </div>

                        {{--<div class="small mb-3">{{ $product->vendor_code }}</div>--}}

                        <div class="btn_group">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm text-white"><span class="hidden-xs hidden-sm hidden-md" @if(!$product->quantity) disabled @endif>В корзину</span></button>
                            </form>
                        </div>

                    </div>

                </a>
            </div>
    @empty
        <p>No products</p>
    @endforelse

    @if (!$loop->last)
        <div class="w-100 clearfix border-bottom mx-3 mt-3 py-3 mb-5"></div>
    @endif

@empty
    <p>No products</p>
@endforelse
