@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($cartItems as $item)
                    <img src="{{ $item->product->photos[0]->file }}" alt="">
                    {{ $item->product->name }}
                    {{ $item->quantity }}
                @endforeach
            </div>
        </div>
    </div>
@endsection
