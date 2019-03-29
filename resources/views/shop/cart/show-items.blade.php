@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            @foreach($cartItems as $i => $item)
                <div class="row">
                    <div class="col-3">
                        @foreach($item['product']->photos as $photo)
                            @if($photo->main == 'yeas')
                                <img src="storage/products/medium/{{ $photo->file }}" alt="" class=" img-circle  mr-0 pr-0 w-100" style="height:200px;">
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="col-6">
                        {{ $item['product']->name }}
                    </div>
                    <div class="col-2">
                        {{ $item['quantity'] }}
                    </div>
                    <div class="col-1">
                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                            @csrf
                            <button><i class="fal fa-trash"></i> <span class="hidden-xs hidden-sm hidden-md">Удалить</span></button>
                        </form>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
