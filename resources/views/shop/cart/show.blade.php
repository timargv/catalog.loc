@extends('layouts.app')

@php
   $cartValue = __('В корзине '). count($countCartItems).  __(' товара');
@endphp

@section('breadcrumbs', '')

@section('content')
        <h1 class="text-dark font-weight-bold">{{ $cartValue }}</h1>
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="py-3">
                @if (count($countCartItems))<a class="btn btn-danger btn-sm" href="{{ route('cart.clear') }}"><i class="fal fa-trash"></i> Очистить корзину</a> @endif
                </div>


                @if (count($countCartItems))
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th width="50px">Image</th>
                            <th>{{ __('fillable.Title') }}</th>
                            <th width="150px">Amount</th>
                            <th>{{ __('fillable.Price') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $price = 0; @endphp
                        @foreach($cartItems as $i => $item)
                            @php
                                $price += $item['product']->price * $item['quantity']
                            @endphp
                            <tr>
                                <td>{{ $item['product']->id }}</td>
                                <td>
                                    @foreach($item['product']->photos as $photo)
                                        @if($photo->main == 'yeas')
                                            <img src="storage/products/medium/{{ $photo->file }}" alt="" class=" img-circle  mr-0 pr-0 w-100" >
                                            @break
                                        @endif
                                    @endforeach
                                        @if (!count($item['product']->photos))
                                            <img src="img/no_photo_product.jpg" alt="" class="mr-0 pr-0 w-100" >
                                        @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $item['product']->name }}</strong>
                                    </div>
                                    <small>{{ $item['product']->vendor_code }}</small>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">

                                        <div class="form-inline input-group-sm">
                                            <form action="{{ route('cart.update.quantity', $item['product']->id) }}" method="POST" class="form-inline">
                                                @csrf
                                                <input name="minus" value="delete" hidden>

                                                <div class="input-group-prepend">
                                                    <button class="btn btn-sm btn-outline-secondary bg-light-active border-light-active text-dark  rounded-left" style="border-radius: 0;"  @if($item['quantity'] < 2) disabled @endif><i class="far fa-minus"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-inline input-group-sm" >
                                            <form action="{{ route('cart.update.quantity', $item['product']->id) }}" method="POST" class="form-inline">
                                                @csrf
                                                <input name="quantity" style="width: 40px;height: 28px;" type="text" class="form-control form-control-sm text-center border-light-active px-1 rounded-0 m-0 outline" placeholder="0" value="{{ $item['quantity'] }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-outline-secondary bg-light-active border-light-active text-dark rounded-0" data-toggle="tooltip" data-placement="top" title="Обновить количество"><i class="far fa-sync"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-inline input-group-sm">
                                            <form action="{{ route('cart.add', $item['product']->id) }}" method="POST" class="form-inline">
                                                @csrf
                                                <input name="plus" value="plus" hidden>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-outline-secondary bg-light-active border-light-active text-dark rounded-right" style="border-radius: 0;"><i class="far fa-plus"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item['product']->price * $item['quantity'] }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm bg-transparent text-dark text-muted"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2">
                                <div ><strong>Итого: </strong> <span id="price" >{{ $price }}</span></div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                @else
                    Корзина пуста
                @endif

            </div>
            <div class="col-md-4">
                asdsa
            </div>
        </div>
@endsection
