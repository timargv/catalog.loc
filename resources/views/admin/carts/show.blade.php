@extends('admin.layouts.app')

@section('title', $user->last_name)

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-light">
                    <div class="widget-user-image">
                        <img class="" src="../../../../img/no_photo_product.jpg" alt="User Avatar" width="128px">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $user->last_name }}</h3>
                    <h5 class="widget-user-desc">{{ $user->email }}</h5>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">

                        @foreach($cartItems as $key => $item)
                            <li class="item">
                                <div class="product-img" width="128px">
                                    @foreach($item->product->photos as $photo)
                                        @if($photo->main == 'yeas')
                                            <img src="{{ Storage::disk('public')->url('products/medium/'. $photo->file) }}" alt="" class="   mr-0 pr-0" width="128px">
                                            @break
                                        @endif
                                    @endforeach
                                    @if (!count($item->product->photos))
                                        <img src="../../../../img/no_photo_product.jpg" alt="" class="mr-0 pr-0" width="128px">
                                    @endif
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('admin.products.edit', $item->product->id) }}" class="product-title" target="_blank"> {{ $item->product->name }}
                                        <span id="price" class="label label-warning pull-right">{{ $item->product->price }}</span></a>
                                    <span class="product-description">
                                        {{ $item->product->vendor['title']}} &nbsp;
                                        Количество: {{ $item->quantity }}
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>

                <div class="box-footer">
                    <div class="">{{ $cartItems->links() }}</div>
                </div>

            </div>

        </div>
    </div>

@endsection
