@extends('layouts.admin')
@section('location','ویرایش صفحه جانبی')
@section('content')
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش صفحه جانبی</h3>
            </div>
            <div class="box-body" style="display: block;">
                {!! Form::model($model,['method'=>'PATCH','route'=>['admin.pages.update',$model->id]]) !!}
                <div class="col-md-6">
                    {!! Form::label('title','نام صفحه') !!}
                    @if ($errors->has('title'))
                        <span style="float: left;color:red">{{ $errors->first('title') }}</span>
                    @endif
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-6">
                  {!! Form::label('eng_name','نام انگلیسی صفحه') !!}
                  @if ($errors->has('eng_name'))
                      <span style="float: left;color:red">{{ $errors->first('eng_name') }}</span>
                  @endif
                  {!! Form::text('eng_name',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-12">
                    <br>
                    @if ($errors->has('des'))
                        <span style="float: left;color:red">{{ $errors->first('des') }}</span>
                    @endif
                    {!! Form::label('des','توضیحات') !!}<br>

                    {!! Form::textarea('des',null,['class'=>'form-control']) !!}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <br>
                            {!! Form::label('keywords','کلمات کلیدی ( با , جدا شوند)') !!}
                            @if ($errors->has('keywords'))
                                <span style="float: left;color:red">{{ $errors->first('keywords') }}</span>
                            @endif
                            {!! Form::text('keywords',null,['class'=>'form-control']) !!}
                        </div>

                    </div>



                </div>

                <div class="col-md-12">
                    <br>

                    <div class="col-md-12">
                        {!! Form::submit('ثبت',['style'=>'float:left','class'=>'btn btn-success']) !!}
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
