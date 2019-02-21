@extends('admin.layouts.app')

@section('title', __('Добавление Бренд'))

@section('content')
    <form method="POST" action="{{ route('admin.brands.store') }}">
        @csrf
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Добавление Бренда
                        </div>

                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">


                        <div class="form-group @if($errors->has('title'))has-error @endif">
                            <label for="title" class="col-form-label">{{ __('fillable.Title') }}</label>
                            <input id="title" class="form-control" placeholder="например: BOSCH" name="title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
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
                            <a href="{{ route('admin.brands.index') }}" class="btn btn-danger pull-right"><i class="far fa-times pr-2"></i> {{ __('button.Cancel') }}</a>
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