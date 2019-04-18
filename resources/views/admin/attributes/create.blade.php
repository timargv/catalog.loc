<form method="POST" action="{{ route('admin.attributes.store') }}">
    @csrf
    <div class="box box-solid">
        <div class="box-header">
            <div class="box-title">
                Добавление Атрибута
            </div>

        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <div class="form-group @if($errors->has('name'))has-error @endif">
                <label for="title" class="col-form-label">{{ __('fillable.Title') }}</label>
                <input id="title" class="form-control" placeholder="Основное" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="sort" class="col-form-label">{{ __('fillable.Sort') }}</label>
                <input id="sort" type="text" class="form-control{{ $errors->has('sort') ? ' is-invalid' : '' }}" name="sort" value="{{ old('sort', 1) }}" >
                @if ($errors->has('sort'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('sort') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="type" class="col-form-label">{{ __('fillable.Type') }}</label>
                <select id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                    @foreach ($types as $type => $label)
                        <option value="{{ $type }}"{{ $type == old('type') ? ' selected' : '' }}>{{ $label }}</option>
                    @endforeach;
                </select>
                @if ($errors->has('type'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('type') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="attributeGroup" class="col-form-label">{{ __('fillable.AttributeGroup') }}</label>
                <select id="attributeGroup" class="form-control{{ $errors->has('attributeGroup') ? ' is-invalid' : '' }}" name="attributeGroup">
                    @foreach ($attributeGroups as $attributeGroup)
                        <option value="{{ $attributeGroup->id }}"{{ $attributeGroup == old('attributeGroup') ? ' selected' : '' }}>{{ $attributeGroup->name }}</option>
                    @endforeach;
                </select>
                @if ($errors->has('attributeGroup'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('attributeGroup') }}</strong></span>
                @endif
            </div>

            <div class="form-group @if($errors->has('categories'))has-error @endif">
                <label for="categories" class="col-form-label w-100">{{ __('category.Category') }}
                    <span class="float-right">
                        <input type="checkbox" id="all_categories"> Выбрать все
                    </span>
                </label>
                <select id="categories" class="form-control select2 w-100 {{ $errors->has('categories') ? ' is-invalid' : '' }}" name="categories[]"  multiple="multiple" data-placeholder="Выберите Категорию">
                    @foreach ($categories as $parent)
                        <option value="{{ $parent->id }}" {{ $parent->id == old('parent') ? ' selected' : '' }}>
                            @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                            {{ $parent->name == null ? $parent->name_original : $parent->name }}
                        </option>
                    @endforeach;
                </select>


                @if ($errors->has('categories'))
                    <span class="help-block"><strong>{{ $errors->first('categories') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="variants" class="col-form-label">{{ __('fillable.Variants') }}</label>
                <textarea id="variants" type="text" class="form-control{{ $errors->has('sort') ? ' is-invalid' : '' }}" name="variants" placeholder="Каждый Вариант с новой строки">{{ old('variants') }}</textarea>
                @if ($errors->has('variants'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('variants') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <input type="hidden" name="required" value="0">
                <div class="checkbox">
                    <label class="col-form-label pl-0">
                        <input id="checkbox-blue" type="checkbox" name="required" {{ old('required') ? 'checked' : '' }}>
                        Объязательно
                    </label>
                </div>
                @if ($errors->has('required'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('required') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <input type="hidden" name="visibility" value="0">
                <div class="checkbox">
                    <label class="col-form-label pl-0">
                        <input id="checkbox-blue" type="checkbox" name="visibility" {{ old('visibility') ? 'checked' : '' }}>
                        Показать на сайте
                    </label>
                </div>
                @if ($errors->has('visibility'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('visibility') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <input type="hidden" name="is_filter" value="0">
                <div class="checkbox">
                    <label class="col-form-label pl-0">
                        <input id="checkbox-blue" type="checkbox" name="is_filter" {{ old('is_filter') ? 'checked' : '' }}>
                        Показать в фильтре
                    </label>
                </div>
                @if ($errors->has('is_filter'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('is_filter') }}</strong></span>
                @endif
            </div>


            <div class="form-group">
                <input type="hidden" name="status" value="0">
                <div class="checkbox">
                    <label class="col-form-label pl-0">
                        <input id="checkbox-blue" type="checkbox" name="status" {{ old('status') ? 'checked' : '' }}>
                        Включить
                    </label>
                </div>
                @if ($errors->has('status'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('status') }}</strong></span>
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