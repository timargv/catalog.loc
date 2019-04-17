@extends('admin.layouts.app')

@section('title', $category->name == null ? 'Категория '. $category->name_original : 'Категория '. $category->name)

@section('content')
    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Edit Категорию
                        </div>
                        <span data-id="{{ $category->id }}" id="btn-toggle" class="btn btn-lg btn-toggle {{ $category->status == 'active' ? 'active' : '' }} pull-right" data-toggle="button" aria-pressed="{{ $category->status == 'active' ? 'true' : 'false' }}" autocomplete="off">
                            <div class="handle"></div>
                        </span>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="form-group @if($errors->has('name'))has-error @endif">
                            <label for="name" class="col-form-label">@if($errors->has('name'))<i class="fa fa-times-circle-o"></i>@endif Name</label>
                            <input id="name" class="form-control" name="name" value="{{ old('name', $category->name) }}" >
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('name_original'))has-error @endif">
                            <label for="name_original" class="col-form-label">Name Original</label>
                            <input id="name_original" class="form-control" name="name_original" value="{{ old('name_original', $category->name_original) }}" required>
                            @if ($errors->has('name_original'))
                                <span class="help-block"><strong>{{ $errors->first('name_original') }}</strong></span>
                            @endif
                        </div>


                        <div class="form-group @if($errors->has('description'))has-error @endif">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea id="description" class="form-control" name="description" >{{ old('description', $category->description) }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>

                        {{--<div class="form-group @if($errors->has('status'))has-error @endif">--}}
                        {{--<label for="status" class="col-form-label">Status <span class="label label-{{ $category->status == 'active' ? 'success' : 'danger' }}">{{ $category->status == 'active' ? 'Включен' : 'Выключено' }}</span></label>--}}
                        {{--<select id="status" class="form-control" name="status">--}}
                        {{--<option class="" value="active" {{ $category->status == 'active' ? ' selected' : '' }}>Включить</option>--}}
                        {{--<option class="" value="disabled" {{ $category->status == 'disabled' ? ' selected' : '' }}>Выключить</option>--}}
                        {{--</select>--}}
                        {{--@if ($errors->has('status'))--}}
                        {{--<span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>--}}
                        {{--@endif--}}
                        {{--</div>--}}

                        <div class="form-group @if($errors->has('code'))has-error @endif">
                            <label for="code" class="col-form-label">Code</label>
                            <input id="code" class="form-control" name="code" value="{{ old('code', $category->code) }}" >
                            @if ($errors->has('code'))
                                <span class="help-block"><strong>{{ $errors->first('code') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('count'))has-error @endif">
                            <label for="count" class="col-form-label">Count</label>
                            <input id="count" class="form-control" name="count" value="{{ old('count', $category->count) }}" >
                            @if ($errors->has('count'))
                                <span class="help-block"><strong>{{ $errors->first('count') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('slug'))has-error @endif">
                            <label for="slug" class="col-form-label">Slug</label>
                            <input id="slug" type="text" class="form-control slug" name="slug" value="{{ old('slug', $category->slug == null ? str_slug($category->name_original) : $category->slug ) }}" required>
                            @if ($errors->has('slug'))
                                <span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('parent'))has-error @endif">
                            <label for="parent" class="col-form-label">Parent</label>
                            <select id="parent" class="form-control select2" name="parent">
                                <option value="" class="">-</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent', $category->parent_id) ? ' selected' : '' }}>
                                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                        {{ $parent->name == null ? $parent->name_original : $parent->name }}
                                    </option>
                                @endforeach;
                            </select>
                            @if ($errors->has('parent'))
                                <span class="help-block"><strong>{{ $errors->first('parent') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save pr-2"></i> {{ __('button.Save') }}</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-danger pull-right"><i class="far fa-arrow-left pr-2"></i> {{ __('button.Back') }}</a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Мета-данные --}}
            <div class="col-xs-6">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Картинка
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="col-xs-4">
                            <ul class="mailbox-attachments clearfix">
                                <li>
                                    <span class="mailbox-attachment-icon has-img"><img src="{{ $category->image == null ? url('/storage/image/no_photo.jpg') : url('/storage/category/medium/'.  $category->image) }}" alt="Attachment"></span>

                                    <div class="mailbox-attachment-info">
                                        <a href="{{ $category->image == null ? url('/storage/image/no_photo.jpg') : url('/storage/category/medium/'.  $category->image) }}" target="_blank" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{ $category->image }}</a>
                                        <span class="mailbox-attachment-size">
                                                {{--{{ $category->getSize() }}--}}
                                                {{--<div class="bnt-group ">--}}
                                                  {{--<a href="#" class="btn btn-default btn-xs "><i class="fa fa-cloud-download"></i></a>--}}
                                                  {{--<a href="#" data-url="{{ route('admin.products.photos.main', [$product, $photo->id]) }}" id="main-photo-product" data-id="{{ $photo->id }}" class="btn btn-{{ $photo->main == 'yeas' ? 'success disabled' : 'default' }} btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="Сделать Главным"><i class="fas fa-check-circle"></i></a>--}}
                                                  {{--<a href="#" data-url="{{ route('admin.products.photos.delete', [$product, $photo->id]) }}" id="delete-photo-product" data-id="{{ $photo->id }}" class="btn btn-default btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="Удалить"><i class="fas fa-trash"></i></a>--}}
                                              {{--</div>--}}
                                            </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="far fa-paperclip"></i> Добавить картинки
                                    <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" >
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Иконка
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="col-xs-2">
                            <ul class="mailbox-attachments clearfix">
                                <li style="width: 110px;">
                                    <span class="mailbox-attachment-icon has-img"><img src="{{ $category->icon == null ? Storage::disk('public')->url('image/no_photo.jpg') : Storage::disk('public')->url('category/icon/medium/'.  $category->icon) }}" alt="Attachment"></span>

                                    <div class="mailbox-attachment-info">
                                        <a style="font-size: 11px" href="{{ $category->icon == null ? Storage::disk('public')->url('image/no_photo.jpg') : Storage::disk('public')->url('category/icon/medium/'.  $category->icon) }}" target="_blank" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{ $category->icon }}</a>
                                        <span class="mailbox-attachment-size">
                                                {{--{{ $category->getSize() }}--}}
                                            {{--<div class="bnt-group ">--}}
                                            {{--<a href="#" class="btn btn-default btn-xs "><i class="fa fa-cloud-download"></i></a>--}}
                                            {{--<a href="#" data-url="{{ route('admin.products.photos.main', [$product, $photo->id]) }}" id="main-photo-product" data-id="{{ $photo->id }}" class="btn btn-{{ $photo->main == 'yeas' ? 'success disabled' : 'default' }} btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="Сделать Главным"><i class="fas fa-check-circle"></i></a>--}}
                                            {{--<a href="#" data-url="{{ route('admin.products.photos.delete', [$product, $photo->id]) }}" id="delete-photo-product" data-id="{{ $photo->id }}" class="btn btn-default btn-xs " data-toggle="tooltip" data-placement="top" title="" data-original-title="Удалить"><i class="fas fa-trash"></i></a>--}}
                                            {{--</div>--}}
                                            </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="far fa-paperclip"></i> Добавить инконку
                                    <input id="icon" type="file" class="form-control{{ $errors->has('icon') ? ' is-invalid' : '' }}" name="icon" >
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="box-title">
                            Мета-данные
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="form-group @if($errors->has('name_h1'))has-error @endif">
                            <label for="name_h1" class="col-form-label">H1</label>
                            <input id="name_h1" class="form-control" name="name_h1" value="{{ old('name_h1', $category->name_h1) }}" >
                            @if ($errors->has('name_h1'))
                                <span class="help-block"><strong>{{ $errors->first('name_h1') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('meta_description'))has-error @endif">
                            <label for="meta_description" class="col-form-label">@if($errors->has('meta_description'))<i class="fa fa-times-circle-o"></i>@endif Meta Description
                            </label>
                            <input id="meta_description" class="form-control" name="meta_description" value="{{ old('meta_description', $category->meta_description) }}" >
                            @if ($errors->has('meta_description'))
                                <span class="help-block"><strong>{{ $errors->first('meta_description') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('meta_title'))has-error @endif">
                            <label for="meta_title" class="col-form-label">@if($errors->has('meta_title'))<i class="fa fa-times-circle-o"></i>@endif Meta Title
                            </label>
                            <input id="meta_title" class="form-control" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}" >
                            @if ($errors->has('meta_title'))
                                <span class="help-block"><strong>{{ $errors->first('meta_title') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('meta_keywords'))has-error @endif">
                            <label for="meta_title" class="col-form-label">@if($errors->has('meta_keywords'))<i class="fa fa-times-circle-o"></i>@endif Meta Keywords
                            </label>
                            <input id="meta_keywords" class="form-control" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords) }}" >
                            @if ($errors->has('meta_keywords'))
                                <span class="help-block"><strong>{{ $errors->first('meta_keywords') }}</strong></span>
                            @endif
                        </div>



                    </div>

                </div>

            </div>
    </div>
    </form>

@endsection
