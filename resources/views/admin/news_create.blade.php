@extends('layouts.admin')
@section('location','دسته ها')
@section('content')
    <?php use App\Cat; ?>
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن خبر</h3>
            </div>
            <div class="box-body" style="display: block;">
                {!! Form::open(array('url' => 'admin/news/store','files' => true)) !!}
                <div class="col-md-6">
                    {!! Form::label('title','عنوان خبر') !!}
                    @if ($errors->has('title'))
                        <span style="float: left;color:red">{{ $errors->first('title') }}</span>
                    @endif
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>

                <div class="col-md-6">
                    {!! Form::label('cat','دسته ') !!}
                    @if ($errors->has('cat'))
                        <span style="float: left;color:red">{{ $errors->first('cat') }}</span>
                    @endif
                    <select class="form-control" id="cat" name="cat">
                        <?php
                        $cat = Cat::orderBy('id','desc')->where('post_type','news')->get()->toArray();
                        foreach($cat as $item_name){ ?>
                            <option value="{{ $item_name['id'] }}">{{ $item_name['name'] }}</option>
                        <?php } ?>
                    </select>
                </div>
                <br>
                <br><br>
                <br><br>
                <div class="col-md-12">
                    @if ($errors->has('des'))
                        <span style="float: left;color:red">{{ $errors->first('des') }}</span>
                    @endif
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
                        <div class="col-md-6">
                            <br>
                            {!! Form::label('myfile','آپلود تصویر ') !!}
                            {!! Form::file('myfile') !!}
                        </div>
                    </div>

                </div>


                <div class="col-md-12">
                    <br>
                    <div class="col-md-12">
                        {!! Form::submit('افزودن خبر',['style'=>'float:left','class'=>'btn btn-success']) !!}
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
