@extends('admin.layouts.app')

@section('title', __('Добавление Виджета'))

@section('content')
    <form method="POST" action="{{ route('admin.widgets.store') }}">
        @csrf
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Добавление Виджета
                        </div>

                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="form-group @if($errors->has('title'))has-error @endif">
                            <label for="title" class="col-form-label">{{ __('fillable.Title') }}</label>
                            <input id="title" class="form-control" placeholder="например: Часто покупают" name="title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">{{ __('fillable.Status') }}</label>
                            <select id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                                @foreach ($statuses as $status => $label)
                                    <option value="{{ $status }}"{{ $status == old('status') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                            @if ($errors->has('status'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('status') }}</strong></span>
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
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
                            <a href="{{ route('admin.widgets.index') }}" class="btn btn-danger pull-right"><i class="far fa-times pr-2"></i> {{ __('button.Cancel') }}</a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Мета-данные --}}
            <div class="col-xs-6">

            </div>
        </div>
    </form>


@endsection
