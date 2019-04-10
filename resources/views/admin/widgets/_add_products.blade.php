<form method="POST" action="{{ route('admin.widgets.item.add', $widget) }}">
    @csrf
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="box-title">
                        Добавление @if($widget->isTypeProduct()) Товара @else Популяраной категории @endif
                    </div>

                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <select @if($widget->isTypeProduct())  id="widgetProduct" @endif name="widgetItemId" class="form-control select2 w-100" data-placeholder="Выберите @if($widget->isTypeProduct()) Товар @else категорию @endif">
                        <option value="">-</option>
                        @if($widget->isTypeCategory())
                            @foreach ($categories as $parent)
                                <option value="{{ $parent->id }}"{{ $parent->id == old('parent') ? ' selected' : '' }}>
                                    @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                    {{ $parent->name == null ? $parent->name_original : $parent->name }}
                                </option>
                            @endforeach;
                        @endif
                    </select>


                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus pr-2"></i> {{ __('button.Add') }}</button>
                    </div>
                </div>

            </div>
        </div>

        {{-- Мета-данные --}}
        <div class="col-xs-6">

        </div>
    </div>
</form>
