@extends('layouts.admin')
@section('location','ویرایش کاربر')
@section('content')
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش اطلاعات کاربر</h3>
            </div>
            <div class="box-body" style="display: block;">
                {!! Form::model($model,['method'=>'PATCH','route'=>['admin.users.update',$model->id]]) !!}
                <div class="col-md-4 ">
                    {!! Form::label('name','نام و نام خانوادگی') !!}
                    @if ($errors->has('name'))
                        <span style="float: left;color:red">{{ $errors->first('name') }}</span>
                    @endif
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('role','سمت') !!}
                    @if ($errors->has('role'))
                        <span style="float: left;color:red">{{ $errors->first('role') }}</span>
                    @endif
                    <select class="form-control" id="role" name="role">
                        <option value="admin">مدیر</option>
                        <option value="kargozar">کارگذار</option>
                        <option value="user">کاربرعادی</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="col-md-12">
                        {!! Form::submit('ویرایش دسته',['style'=>'float:left','class'=>'btn btn-success']) !!}
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