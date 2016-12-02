@extends('layouts.admin')
@section('location','ویدیوها')
@section('content')
<?php use App\Cat; ?>
<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">افزودن ویدیو</h3>
        </div>
        <div class="box-body" style="display: block;">
            {!! Form::open(array('url' => 'admin/video/store','files' => true)) !!}
            <div class="col-md-6">
                {!! Form::label('title','عنوان ویدیو') !!}
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
                    $cat = Cat::orderBy('id','desc')->where('post_type','video')->get()->toArray();
                    foreach($cat as $item_name){ ?>
                        <option value="{{ $item_name['id'] }}">{{ $item_name['name'] }}</option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <br><br>
            <br><br>
            @if ($errors->has('des'))
                <span style="float: left;color:red">{{ $errors->first('des') }}</span>
            @endif
            <div class="col-md-12">
                {!! Form::textarea('des',null,['class'=>'form-control']) !!}
            </div>

            <div class="col-md-6">
                {!! Form::label('link_video','لینک مستقیم ویدیو کیفیت ۱') !!}
                @if ($errors->has('link_video'))
                    <span style="float: left;color:red">{{ $errors->first('link_video') }}</span>
                @endif
                {!! Form::text('link_video',null,['class'=>'form-control']) !!}
            </div>

            <div class="col-md-6">
                {!! Form::label('link_video',' لینک مستقیم ویدیو کیفیت ۲') !!}
                @if ($errors->has('link_video'))
                    <span style="float: left;color:red">{{ $errors->first('link_video') }}</span>
                @endif
                {!! Form::text('link_video2',null,['class'=>'form-control']) !!}
            </div>

            <div class="col-md-6">
                {!! Form::label('link_video','لینک مستقیم ویدیو  کیفیت ۳') !!}
                @if ($errors->has('link_video'))
                    <span style="float: left;color:red">{{ $errors->first('link_video') }}</span>
                @endif
                {!! Form::text('link_video3',null,['class'=>'form-control']) !!}
            </div>



<div class="col-md-12">
            <div class="col-md-6">
                <br>
                @if ($errors->has('link_video'))
                    <span style="float: left;color:red">{{ $errors->first('link_video') }}</span>
                @endif
                {!! Form::label('link_video','آپلود ویدیو ۱') !!}
                {!! Form::file('link_video') !!}
            </div>



            <div class="col-md-6">
                <br>
                @if ($errors->has('link_video2'))
                    <span style="float: left;color:red">{{ $errors->first('link_video2') }}</span>
                @endif
                {!! Form::label('link_video2','آپلود ویدیو ۲') !!}
                {!! Form::file('link_video2') !!}
            </div>
</div>


            <div class="col-md-12">

            <div class="col-md-6">
                <br>
                @if ($errors->has('link_video3'))
                    <span style="float: left;color:red">{{ $errors->first('link_video3') }}</span>
                @endif
                {!! Form::label('link_video3','آپلود ویدیو ۳') !!}
                {!! Form::file('link_video3') !!}
            </div>






            <div class="col-md-6">
                <br>
                @if ($errors->has('img'))
                    <span style="float: left;color:red">{{ $errors->first('img') }}</span>
                @endif
                {!! Form::label('img','آپلود عکس اصلی ویدیو') !!}
                {!! Form::file('img') !!}
            </div>

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
                    {!! Form::submit('افزودن ویدیو',['style'=>'float:left','class'=>'btn btn-success']) !!}
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
