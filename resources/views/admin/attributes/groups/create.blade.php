<form method="POST" action="{{ route('admin.attribute-groups.store') }}">
    @csrf
    <div class="box box-solid">
        <div class="box-header">
            <div class="box-title">
                Добавить группы Атрибутов
            </div>
        </div>
        <div class="box-body table-responsive">
            <div class="form-group @if($errors->has('name'))has-error @endif">
                <label for="title" class="col-form-label">{{ __('fillable.Title') }}</label>
                <input id="title" class="form-control" placeholder="Основное" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="form-group @if($errors->has('slug'))has-error @endif">
                <label for="slug" class="col-form-label">{{ __('fillable.Slug') }}</label>
                <input type="text" id="slug" class="form-control" name="slug" value="{{ old('slug') }}" required>
                @if ($errors->has('slug'))
                    <span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
            </div>
        </div>
    </div>
</form>