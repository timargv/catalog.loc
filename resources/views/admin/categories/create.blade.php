@extends('admin.layouts.app')

@section('title', __('category.Create'))

@section('content')
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Создание Категорию
                        </div>

                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="form-group @if($errors->has('name'))has-error @endif">
                            <label for="name" class="col-form-label">@if($errors->has('name'))<i class="fa fa-times-circle-o"></i>@endif {{ __('category.Title') }}</label>
                            <input id="name" class="form-control" name="name" value="{{ old('name') }}" >
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('name_original'))has-error @endif">
                            <label for="name_original" class="col-form-label">{{ __('category.Title_Original') }}</label>
                            <input id="name_original" class="form-control" name="name_original" value="{{ old('name_original') }}" required>
                            @if ($errors->has('name_original'))
                                <span class="help-block"><strong>{{ $errors->first('name_original') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('parent'))has-error @endif">
                            <label for="parent" class="col-form-label">{{ __('category.Parent') }}</label>
                            <select id="parent" class="form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" name="parent">
                                <option value=""></option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent') ? ' selected' : '' }}>
                                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                        {{ $parent->name == null ? $parent->name_original : $parent->name }}
                                    </option>
                                @endforeach;
                            </select>
                            @if ($errors->has('parent'))
                                <span class="help-block"><strong>{{ $errors->first('parent') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('slug'))has-error @endif">
                            <label for="slug" class="col-form-label">{{ __('category.Slug') }}</label>
                            <input id="slug" type="text" class="form-control slug" name="slug" value="{{ old('slug') }}" >
                            @if ($errors->has('slug'))
                                <span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('description'))has-error @endif">
                            <label for="description" class="col-form-label">{{ __('category.Description') }}</label>
                            <textarea id="description" class="form-control" name="description" >{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('status'))has-error @endif">
                            <label for="status" class="col-form-label">{{ __('category.Status') }}</label>
                            <select id="status" class="form-control" name="status">
                                <option class="" value="active" >Включить</option>
                                <option class="" value="disabled" >Выключить</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-danger pull-right"><i class="far fa-times pr-2"></i> {{ __('button.Back') }}</a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Мета-данные --}}
            <div class="col-xs-6">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">{{ __('category.Other_Data') }}</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">{{ __('category.Meta_Data') }}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body">
                                <div class="form-group @if($errors->has('code'))has-error @endif">
                                    <label for="code" class="col-form-label">{{ __('category.Code') }}</label>
                                    <input id="code" class="form-control" name="code" value="{{ old('code') }}" >
                                    @if ($errors->has('code'))
                                        <span class="help-block"><strong>{{ $errors->first('code') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('count'))has-error @endif">
                                    <label for="count" class="col-form-label">{{ __('category.Count') }}</label>
                                    <input id="count" class="form-control" name="count" value="{{ old('count') }}" >
                                    @if ($errors->has('count'))
                                        <span class="help-block"><strong>{{ $errors->first('count') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('icon'))has-error @endif">
                                    <label for="icon" class="col-form-label">{{ __('category.Icon') }}</label>
                                    <input id="icon" class="form-control" name="icon" value="{{ old('icon') }}" >
                                    @if ($errors->has('icon'))
                                        <span class="help-block"><strong>{{ $errors->first('icon') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('image'))has-error @endif">
                                    <label for="image" class="col-form-label">{{ __('category.Image') }}</label>
                                    <input id="image" class="form-control" name="image" value="{{ old('image') }}" >
                                    @if ($errors->has('image'))
                                        <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body">
                                <div class="form-group @if($errors->has('name_h1'))has-error @endif">
                                    <label for="name_h1" class="col-form-label">@if($errors->has('name_h1'))<i class="fa fa-times-circle-o"></i>@endif {{ __('category.H1') }}</label>
                                    <input id="name_h1" class="form-control" name="name_h1" value="{{ old('name_h1') }}" >
                                    @if ($errors->has('name_h1'))
                                        <span class="help-block"><strong>{{ $errors->first('name_h1') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('meta_description'))has-error @endif">
                                    <label for="meta_description" class="col-form-label">@if($errors->has('meta_description'))<i class="fa fa-times-circle-o"></i>@endif {{ __('category.Meta_Description') }}</label>
                                    <input id="meta_description" class="form-control" name="meta_description" value="{{ old('meta_description') }}" >
                                    @if ($errors->has('meta_description'))
                                        <span class="help-block"><strong>{{ $errors->first('meta_description') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('meta_title'))has-error @endif">
                                    <label for="meta_title" class="col-form-label">@if($errors->has('meta_title'))<i class="fa fa-times-circle-o"></i>@endif {{ __('category.Meta_Title') }}</label>
                                    <input id="meta_title" class="form-control" name="meta_title" value="{{ old('meta_title') }}" >
                                    @if ($errors->has('meta_title'))
                                        <span class="help-block"><strong>{{ $errors->first('meta_title') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('meta_keywords'))has-error @endif">
                                    <label for="meta_keywords" class="col-form-label">@if($errors->has('meta_keywords'))<i class="fa fa-times-circle-o"></i>@endif {{ __('category.Meta_Keywords') }}</label>
                                    <input id="meta_keywords" class="form-control" name="meta_keywords" value="{{ old('meta_keywords') }}" >
                                    @if ($errors->has('meta_keywords'))
                                        <span class="help-block"><strong>{{ $errors->first('meta_keywords') }}</strong></span>
                                    @endif
                                </div>


                            </div>
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>
    </form>

@endsection