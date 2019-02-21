@extends('admin.layouts.app')

@section('title', 'Import')

@section('content')

    <div class="row">
        <div class="col-xs-9">
            <div class="nav-tabs-custom">
                @include('admin.import-export._nav')
            </div>
            <div class="row">
                <div class="col-xs-6">
                    @include('admin.import-export.category.xml.mir-isntrument-import')
                </div>
                <div class="col-xs-6">
                    <div class="box box-solid">
                        <div class="box-header with-border mb-4">
                            <div class="box-title">Импорт Товаров </div>
                            <div class="box-tools">Формат: <span class="label bg-red">.xslx</span></div>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <form class="form-inline" method="post" action="?" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group mb-3">
                                    <input type="file" name="file" id="exampleInputFile" class="input-group">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn bg-danger text-white btn-sm mr-2"><i class="fas fa-cloud-upload"></i> Import</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-3">
            <div class="box box-solid">
                <div class="box-header with-border mb-4">
                    <div class="box-title">Поля для Импорта</div>
                    <div class="box-tools">Формат: <span class="label bg-red">.xslx</span></div>
                </div>
                <!-- /.box-header -->

                <div class="box-body no-padding">


                    <table class="table table-striped">
                        <tr>
                            <th class="text-red">name</th>
                            <td class="small">Название продукта</td>
                        </tr>
                        <tr>
                            <th class="text-red">vendor_code</th>
                            <td class="small">Артикул</td>
                        </tr>

                        <tr>
                            <th>name_original</th>
                            <td class="small">Оригинальное Название От поставщика</td>
                        </tr>
                        <tr>
                            <th>status</th>
                            <td class="small">Статус (<b>active</b> или <b>disabled</b>)</td>
                        </tr>
                        <tr>
                            <th>available</th>
                            <td class="small">В наличии (<b>yeas</b> или <b>no</b>)</td>
                        </tr>

                        <tr>
                            <th>original_id</th>
                            <td class="small">ID в прайсе поставщика (<b>1</b>)</td>
                        </tr>

                        <tr>
                            <th>shipper</th>
                            <td class="small">Поставщик прайса (Мир Инструмента)</td>
                        </tr>

                        <tr>
                            <th>original_url</th>
                            <td class="small">Ссылка на сайт поставщика</td>
                        </tr>

                        <tr>
                            <th>price</th>
                            <td class="small">Цена</td>
                        </tr>

                        <tr>
                            <th>shipper_price</th>
                            <td class="small">Цена поставщика</td>
                        </tr>

                        <tr>
                            <th>currency_id</th>
                            <td class="small">Валюта (<b>RUB</b>)</td>
                        </tr>

                        <tr>
                            <th>category_id</th>
                            <td class="small">Категория ID</td>
                        </tr>

                        <tr>
                            <th>picture</th>
                            <td class="small">Главная Картинка</td>
                        </tr>

                        <tr>
                            <th>sh_desc</th>
                            <td class="small">Крат. Описание</td>
                        </tr>

                        <tr>
                            <th>desc</th>
                            <td class="small">Полное описание</td>
                        </tr>

                        <tr>
                            <th>barcode</th>
                            <td class="small">Штрих Код</td>
                        </tr>

                        <tr>
                            <th>weight</th>
                            <td class="small">Ширина</td>
                        </tr>

                    </table>
                </div>
                <!-- /.box-body -->


                <div class="box-footer">
                    <span class=" small text-red">* Красные поля объязательны</span>
                </div>
            </div>
        </div>
    </div>

@endsection