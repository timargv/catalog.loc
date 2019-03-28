@extends('admin.layouts.app')

@section('title', __('Добавление Бренд'))

@section('content')
    <form method="POST" action="{{ route('admin.deliveries.store') }}">
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
                            <input id="title" class="form-control" placeholder="" name="title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('cost'))has-error @endif">
                            <label for="cost" class="col-form-label">{{ __('fillable.Cost') }}</label>
                            <input id="cost" class="form-control" placeholder="" name="cost" value="{{ old('cost') }}" required>
                            @if ($errors->has('cost'))
                                <span class="help-block"><strong>{{ $errors->first('cost') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('min_weight'))has-error @endif">
                            <label for="min_weight" class="col-form-label">{{ __('fillable.MinWeight') }}</label>
                            <input id="min_weight" class="form-control" placeholder="" name="min_weight" value="{{ old('min_weight') }}" >
                            @if ($errors->has('min_weight'))
                                <span class="help-block"><strong>{{ $errors->first('min_weight') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('max_weight'))has-error @endif">
                            <label for="max_weight" class="col-form-label">{{ __('fillable.MaxWeight') }}</label>
                            <input id="max_weight" class="form-control" placeholder="" name="max_weight" value="{{ old('max_weight') }}" >
                            @if ($errors->has('max_weight'))
                                <span class="help-block"><strong>{{ $errors->first('max_weight') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('sort'))has-error @endif">
                            <label for="sort" class="col-form-label">{{ __('fillable.Sort') }}</label>
                            <input type="text" id="sort" class="form-control" name="sort" value="{{ old('sort') }}" required>
                            @if ($errors->has('sort'))
                                <span class="help-block"><strong>{{ $errors->first('sort') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
                            <a href="{{ route('admin.deliveries.index') }}" class="btn btn-danger pull-right"><i class="far fa-times pr-2"></i> {{ __('button.Cancel') }}</a>
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