@extends('layouts.admin')
@section('location','دسته ها')
@section('content')
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن دسته</h3>
            </div>
            <div class="box-body" style="display: block;">
                {!! Form::open(array('url' => 'admin/cat/store','files' => true)) !!}
                <div class="col-md-4 ">
                    {!! Form::label('name','عنوان دسته') !!}
                    @if ($errors->has('name'))
                        <span style="float: left;color:red">{{ $errors->first('name') }}</span>
                    @endif
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('parent','مادر دسته') !!}
                    @if ($errors->has('parent'))
                        <span style="float: left;color:red">{{ $errors->first('parent') }}</span>
                    @endif
                    <select class="form-control" id="parent" name="parent">
                        <option value="">دسته مادر است</option>
                        <?php
                        foreach($cat_parent as $item){?>
                        <option value="<?= $item['id'] ?>"><?= ' '.$item['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    {!! Form::label('post_type','برای بخش') !!}
                    @if ($errors->has('post_type'))
                        <span style="float: left;color:red">{{ $errors->first('post_type') }}</span>
                    @endif
                    <select class="form-control" id="parent" name="post_type">
                        <option value="prjct">آگهی ها</option>

                    </select>
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="col-md-12">
                        {!! Form::submit('افزودن دسته',['style'=>'float:left','class'=>'btn btn-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('resources/dist/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('resources/dist/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('resources/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script>
        CKEDITOR.replace('des',{
            language: 'fa'
        });
        $(function () {
            $("#example1").DataTable({
                "language": {
                    "sProcessing":   "درحال پردازش...",
                    "sLengthMenu":   "نمایش  _MENU_ رکورد",
                    "sZeroRecords":  "رکورد یافت نشد",
                    "sInfo":         "نمایش _START_ تا _END_ رکورد از مجموع _TOTAL_",
                    "sInfoEmpty":    "خالی",
                    "sInfoFiltered": "(فیلتر شده از مجموع _MAX_ رکورد)",
                    "sInfoPostFix":  "",
                    "sSearch":       "جستجو:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "ابتدا",
                        "sPrevious": "قبلی",
                        "sNext":     "بعدی",
                        "sLast":     "انتها"
                    }
                }
            });
        });
    </script>
@endsection