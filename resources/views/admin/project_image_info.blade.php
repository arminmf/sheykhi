@extends('layouts.admin')
@section('location','پروژه ها')
@section('content')
    <?php
    use App\User;
    use App\Cat;
    ?>
    {!! Form::open(array('action' => 'ProjectController@img_update','files' => true)) !!}
<?php $i=0; ?>

<div class="row ">
    <div class="col-md-12">
        <div class="box box-widget">
            <div class="box-body">


                با کلیک بر روی دکمه کنار توضیحات عکس، تصویر اصلی پروژه را انتخاب کنید.


                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {!! Form::label('myfile','آپلود تصاویر پروژه') !!}
                {!! Form::file('images[]', array('multiple'=>true,'style'=>'display:inline;')) !!}
            </div>

        </div>
    </div>
</div>


    @foreach ($image as $item)
<?php $i++; if ($i%2==0) echo "<div class='row'>"; ?>




            <div class="col-md-6" id="img{{$item->id}}">
                <!-- Box Comment -->

                <div class="box box-widget">
                    <i class="fa fa-times" onclick="del('{{$item->id}}')" style=" font-size: 20px;color:darkred;     margin-right: 5px;"></i>
                    <!-- /.box-header -->
                    <div class="box-body" style="    padding-top: 0px;">
                        <img class="img-responsive pad" width="100%" src="../../../resources/upload/images/{{$item->img_name}}" alt="Photo">
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box-footer -->
                    <div class="box-footer">
                        {!! Form::label('توضیحات پروژه') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <div class="iradio_minimal checked" aria-checked="true" aria-disabled="false" style="position: relative;">{!! Form::radio('asli', "$item->id",$item->main) !!}</div>
                            </span>
                            {!! Form::text("$item->id" ,$item->det,['class'=>'form-control input-sm','value'=> "$item->det",'placeholder'=> 'توضیحات تصویر را وارد کنید' ]) !!}
                        </div>

                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
<?php if ($i%2==0) echo "</div>";  ?>




    @endforeach

    {{ Form::hidden('pid', $pid) }}
<div class="row"> <div class="col-md-12">
    {!! Form::submit('ثبت تغیرات ',['style'=>'float:left;margin: 10px;','class'=>'btn btn-success']) !!}
</div></div>
    {!! Form::close() !!}
@endsection
@section('js')
    <script src="{{ url('resources/dist/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('resources/dist/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script>
        function del(id){
            var del = confirm('آیا تصویر حذف شود؟');
            if(del == true){
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ url('admin/project/image/remove') }}',
                    type:'POST',
                    data:'id='+id,
                    success:function(data){
                        $('#img'+id).remove();
                    }
                });
            }
        }
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