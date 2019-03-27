<form method="POST" action="{{ route('admin.order-statuses-list.store') }}">
    @csrf
    <div class="col-xs-12">
        <div class="form-group @if($errors->has('title'))has-error @endif">
            <label for="title" class="col-form-label">{{ __('fillable.Title') }}</label>
            <input id="title" class="form-control" placeholder="например: Ожидание" name="title" value="{{ old('title') }}" required>
            @if ($errors->has('title'))
                <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>

        <div class="form-group @if($errors->has('color'))has-error @endif">
            <label for="color" class="col-form-label">{{ __('fillable.Color') }}</label>
            <div class="input-group my-colorpicker">
                <input type="text" id="color" class="form-control" name="color" value="{{ old('color') }}" placeholder="Выберите цвет с права пикером" required>
                <div class="input-group-addon">
                    <i style="background-color: rgb(201, 201, 201);"></i>
                </div>
            </div>
            @if ($errors->has('color'))
                <span class="help-block"><strong>{{ $errors->first('color') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
            <a href="{{ route('admin.order-statuses-list.index') }}" class="btn btn-danger pull-right"><i class="far fa-times pr-2"></i> {{ __('button.Cancel') }}</a>
        </div>
    </div>
</form>