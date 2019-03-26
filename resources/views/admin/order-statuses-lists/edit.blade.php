@extends('admin.layouts.app')

@section('title', 'Status')

@section('content')
    <form method="POST" action="{{ route('admin.order-statuses-list.update', $statusOrderList) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Edit Status
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">


                        <div class="form-group @if($errors->has('title'))has-error @endif">
                            <label for="title" class="col-form-label">{{ __('fillable.Title') }}</label>
                            <input id="title" class="form-control" placeholder="" name="title" value="{{ old('title', $status->title) }}" required>
                            @if ($errors->has('title'))
                                <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('color'))has-error @endif">
                            <label for="color" class="col-form-label">{{ __('fillable.Color') }}</label>
                            <input type="text" id="color" class="form-control" name="color" value="{{ old('slug', $status->color) }}" required>
                            @if ($errors->has('color'))
                                <span class="help-block"><strong>{{ $errors->first('color') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
                            <a href="{{ route('admin.order-statuses-list.index') }}" class="btn btn-danger pull-right"><i class="far fa-times pr-2"></i> {{ __('button.Cancel') }}</a>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </form>

@endsection