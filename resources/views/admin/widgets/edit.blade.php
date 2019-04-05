@extends('admin.layouts.app')

@section('title', 'Brands')

@section('content')
    <form method="POST" action="{{ route('admin.widgets.update', $widget) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Edit Brand
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <div class="form-group @if($errors->has('title'))has-error @endif">
                            <label for="title" class="col-form-label">{{ __('fillable.Title') }}</label>
                            <input id="title" class="form-control" placeholder="например: Часто покупают" name="title" value="{{ old('title', $widget->title) }}" required>
                            @if ($errors->has('title'))
                                <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
                            <a href="{{ route('admin.widgets.index') }}" class="btn btn-danger pull-right"><i class="far fa-times pr-2"></i> {{ __('button.Cancel') }}</a>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </form>

@endsection
