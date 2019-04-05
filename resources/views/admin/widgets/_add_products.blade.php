<form method="POST" action="{{ route('admin.widgets.product.add', $widget) }}">
    @csrf
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="box-title">
                        Добавление Товара
                    </div>

                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <select id="widgetProduct" name="products[]" class="form-control select2 w-100" data-placeholder="Выберите Товары">
                        <option value="">-</option>
                        {{--@foreach ($products as $product)--}}
                            {{--<option value="{{ $product->id }}" {{ $product->id == old('products') ? ' selected' : '' }}>--}}
                                {{--{{ $product->name == null ? $product->name_original : $product->name }}--}}
                            {{--</option>--}}
                        {{--@endforeach;--}}
                    </select>


                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
                    </div>
                </div>

            </div>
        </div>

        {{-- Мета-данные --}}
        <div class="col-xs-6">

        </div>
    </div>
</form>
