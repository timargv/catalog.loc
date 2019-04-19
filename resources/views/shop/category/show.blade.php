@extends('layouts.app')

@section('content')
    <div class=" mb-3 pb-3 border-light-active border-bottom">
        <h1 class="text-dark pt-0" style="font-weight: 500">{{ $category->name }}</h1>
    </div>
    <div class="row justify-content-start pt-5">
        <div class="col-3">
             <nav class="nav flex-column category-show-left-menu mb-5">
                @foreach($categories as $category)
                    <a class="nav-link active pl-0 text-dark py-1" href="{{ route('categories.show', $category->slug?:$category->id) }}">{{ $category->name }}</a>
                @endforeach

                {{-- {{  dd($category->products()->pluck('id')) }} --}}



                @if(empty($categories))
                    <form action="?" method="GET">
                        @if ($category->allAttributes())
                        @foreach($category->getValuesFilter() as $key => $attribute)
                            @if(!empty($category->getNameAttributeValue($key)))
                            <div class="h5">{{ $category->getNameAttributeValue($key)->name  }}</div>
                            @php
                                $name = $category->getNameAttributeValue($key)->slug
                            @endphp

                            <div class="form-group">
                        
                                @foreach($category->getFilterValueUniqArray($attribute) as $key => $value)
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="{{ $name }}_{{ $key }}"  name="{{ $name }}" value="{{ $key }}" {{ request($name) == $key ? 'checked' : '' }}>
                                  <label class="custom-control-label" for="{{ $name }}_{{ $key }}">{{ $key }}</label>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        @endforeach
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Search') }}</button>
                        </div>
                    </form>
                @endif
            </nav>
        </div>
        <div class="col-9">
            <div class="row"></div>
            <div class="row">
                @include('shop.products._item', ['products' => $products])
                <div class="w-100 clearfix py-5 px-3">{{ $products->appends(request()->query())->links() }}</div>
            </div>
        </div>
    </div>
@endsection
