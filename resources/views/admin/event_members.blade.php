@extends('layouts.admin')
@section('location','پروژه ها')
@section('content')
    <?php
    use App\User;
    use App\Cat;




    ?>


    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
            </div>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"> ایونت ها

                    </h3>
            </div>

            <div class="box-body" style="display: block;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th> ایمیل</th>
                        <th style="width:180px;">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i =0; ?>
<?php
                    foreach ($members as $item) {
                    $user_id = $item->user_id;
                    $member_id = $item->id;

                    $users_info = DB::table('users')->where('id', $user_id)->get();

                    ?>
                    @foreach($users_info as $item)
                        <?php $i++;  ?>
                        <tr id="<?php echo $member_id ?>">
                            <td>{{ $i }}</td>

                            <tD><?php echo $item->name ?></td>
                            <td><?php echo $item->fname ?> </td>
                            <td><?php echo $item->email ?></td>
                            <td><a class="btn btn-sm btn-danger" onclick="del(<?=  $member_id ?>,'<?= $item->name ?> <?= $item->fname ?>')">حذف</a></td>

                          </tr>
                    @endforeach
                    <?php }?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th> ایمیل</th>
                        <th style="width:180px;">عملیات</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">  اطلاع رسانی

                </h3>
            </div>
            {!! Form::open(array('url' => 'admin/event/create/member/sendsm','files' => true)) !!}
            <div class="box-body" style="display: block;">
<div class="row">
        <div class="col-md-6">


        {!! Form::textarea('des',null,['class'=>'form-control']) !!}
                    </div>

</div>

               <div class="row"><br>
                <div class="col-md-6">
                    {!! Form::submit('ارسال اس ام اس',['style'=>'float:left; margin-right:15px;','class'=>'btn btn-success', 'name'=>'sendsms']) !!}
                    {!! Form::submit('ارسال ایمیل',['style'=>'float:left;','class'=>'btn btn-success' , 'name'=>'sendmail']) !!}
                </div>
                   </div>
        </div>

            {!! Form::close() !!}
    </div>

@endsection
@section('js')
    <script src="{{ url('resources/dist/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('resources/dist/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script>
        function del(id,name){
            var del = confirm('آیا '+id+' حذف شود؟');
            if(del == true){
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ url('admin/event/members/rem') }}',
                    type:'POST',
                    data:'id='+id+'&name='+name,
                    success:function(data){
                        $("#"+id).remove();
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