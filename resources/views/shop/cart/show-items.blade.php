@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            @if ($cartItems)
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th width="50px">Image</th>
                            <th>{{ __('fillable.Title') }}</th>
                            <th>Amount</th>
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
                                            <img src="storage/products/medium/{{ $photo->file }}" alt="" class=" img-circle  mr-0 pr-0 w-100" style="height:200px;">
                                            @break
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $item['product']->name }}</strong>
                                    </div>
                                    <small>{{ $item['product']->vendor_code }}</small>
                                </td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ $item['product']->price * $item['quantity'] }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                        @csrf
                                        <button><i class="fal fa-trash"></i> <span class="hidden-xs hidden-sm hidden-md">Удалить</span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="2">
                                    <div id="price" ><strong>Итого: </strong> {{ $price }}</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @else
                Корзина пуста
                @endif

            </div>
        </div>
    </div>
@endsection
