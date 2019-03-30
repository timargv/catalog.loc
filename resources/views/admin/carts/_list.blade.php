<div class="row">
    @foreach ($cartItems->groupBy('user_id') as $key => $items)
        <div class="col-md-6">
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-light">
                    <div class="widget-user-image">
                        <img class="" src="../img/no_photo_product.jpg" alt="User Avatar" width="128px">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $cart->getUser($key)->last_name }}</h3>
                    <h5 class="widget-user-desc">{{ $cart->getUser($key)->email }}</h5>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @php
                            $count = 0;
                            $user = $cart->getUser($key);
                        @endphp

                        @if ($countItems = count($items) > 3)
                            @php $count = count($items) - 3 @endphp
                        @endif
                        @foreach($items->sortBy('update_at') as $key => $item)
                            @break($key == 3)
                            <li class="item">
                                <div class="product-img" width="128px">
                                    @foreach($item->product->photos as $photo)
                                        @if($photo->main == 'yeas')
                                            <img src="../storage/products/medium/{{ $photo->file }}" alt="" class="   mr-0 pr-0" width="128px">
                                            @break
                                        @endif
                                    @endforeach
                                    @if (!count($item->product->photos))
                                        <img src="../img/no_photo_product.jpg" alt="" class="mr-0 pr-0" width="128px">
                                    @endif
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('admin.products.edit', $item->product->id) }}" class="product-title" target="_blank"> {{ $item->product->name }}
                                        <span id="price" class="label label-warning pull-right">{{ $item->product->price }}</span></a>
                                    <span class="product-description">
                                      {{ $item->product->name }}.
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>


                @if ($count != 0)
                    <div class="box-footer text-center">
                        <a href="{{ route('admin.carts.show', $user) }}" class="d-block">Еще ({{ $count }})</a>
                    </div>
                @endif
            </div>

        </div>
    @endforeach

</div>
