@extends('admin.layouts.app')

@section('title', 'Import Excel Category')

@section('content')

    <div class="row">
        <div class="col-xs-9">
            <div class="nav-tabs-custom">
                @include('admin.import-export._nav')
                <div class="tab-content">
                        <form class="form-inline" method="post" action="?" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group mb-3">
                                <input type="file" name="file" id="exampleInputFile" class="input-group">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn bg-danger text-white btn-sm mr-2"><i class="fas fa-cloud-upload"></i> Import</button>
                                <a class="btn btn-primary btn-sm" href="#" ><i class="fas fa-cloud-download-alt"></i> Export</a>
                            </div>


                            @if ($errors->any())
                                <div class="alert alert-danger border-0 rounded-0">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </form>
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>

@endsection

