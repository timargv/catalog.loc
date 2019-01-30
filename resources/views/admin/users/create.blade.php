@extends('admin.layouts.app')

@section('title', __('user.Create'))

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="box-title">
                        Создание Пользователя
                    </div>

                </div>
                <!-- /.box-header -->

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputName">Login</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="login">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Name</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Enter email">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection