@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.products.photos.add', $product) }}" enctype="multipart/form-data">
    @csrf

    {{--<div class="form-group">--}}
        {{--<label for="photos" class="col-form-label">Title</label>--}}
        {{--<input id="photos" type="file" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="files[]" multiple required>--}}
    {{--</div>--}}

    <div class="form-group">
        <div class="btn btn-default btn-file">
            <i class="far fa-paperclip"></i> Добавить картинки
            <input id="photos" type="file" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="files[]" multiple required>
        </div>
        <p class="help-block">Max. 32MB</p>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Загрузить</button>
    </div>
</form>