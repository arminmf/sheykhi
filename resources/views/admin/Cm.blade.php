@extends('layouts.admin')
@section('location','نظرات')
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
                <h3 class="box-title">نظرات</h3>
            </div>

            <div class="box-body" style="display: block;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>متن آگهی</th>
                        <th>دسته </th>
                        <th> تاریخ</th>
                        <th style="width:180px;">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i =0; ?>
                        @foreach($cm as $item)
                            <?php $i++ ?>
                            <tr id="<?php echo $item['id'] ?>">
                                <td>{{ $i }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['comment_text'] }}</td>
                                <td>
                                    <?php
                                        if($item['post_type']=="prjct"){
                                    $name = \App\Project::orderBy('id','desc')->where('id',$item->post_id)->get()->toArray();
                                    foreach($name as $item_name){
                                        echo  "<a href='../project/".$item_name['title']."'>".$item_name['title']."</a>";
                                    }}
                                    ?>


                                    <?php
                                    if($item['post_type']=="event"){
                                        $name = \App\Event::orderBy('id','desc')->where('id',$item->post_id)->get()->toArray();
                                        foreach($name as $item_name){
                                            echo $item_name['title'];
                                        }}
                                    ?>

                                    <?php
                                    if($item['post_type']=="video"){
                                        $name = \App\Project::orderBy('id','desc')->where('id',$item->post_id)->get()->toArray();
                                        foreach($name as $item_name){
                                            echo $item_name['title'];
                                        }}
                                    ?>


                                </td>

                                <td>{{ jDate::forge($item->time)->format('%d  %B  %Y',true)  }}
                                </td>
                                <td>

                                    <a class="btn btn-sm btn-danger" onclick="del(<?= $item->id ?>,'<?= $item->title ?>')">حذف</a>

                                    <!-- important button -->

                                    <?php
                                        if($item->accept == 0){

                                    ?>

                                    <a class="btn btn-sm btn-info" id="taeed<?php echo $item->id ?>" onclick="taeed('<?= $item->id ?>',1)">
                                      تایید آگهی
                                                <!-- /end important button -->
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>عنوان</th>
                        <th>کاربر</th>
                        <th>نوع پروژه</th>
                        <th>تاریخ ثبت</th>
                        <th style="width:180px;">عملیات</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('resources/dist/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('resources/dist/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script>
        function taeed(id,action){

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ url('admin/cm/taeed') }}',
                    type:'POST',
                    data:'id='+id,
                    success:function(data){
                        $('#taeed'+id).remove();

                    }
                });
        }
        function del(id,name){
            var del = confirm('آیا '+name+' حذف شود؟');
            if(del == true){
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ url('admin/cm/remove') }}',
                    type:'POST',
                    data:'id='+id+'&name='+name,
                    success:function(data){
                        $('tr#'+id).remove();
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