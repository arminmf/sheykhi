@extends('layouts.admin')
@section('location','ویدیوها')
@section('content')
    <?php use App\Cat;?>

    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
            </div>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">ویدیوها <a class="btn btn-success btn-xs" href="{{ url('admin/video/create') }}">افزودن</a></h3>
            </div>

            <div class="box-body" style="display: block;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>عنوان</th>
                        <th>دسته بندی</th>
                        <th style="width:180px;">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach($video as $item)
                        <?php $i++ ?>
                        <tr id="<?php echo $item['id'] ?>">
                            <td>{{ $i }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td><?php
                                $cat = Cat::orderBy('id','desc')->where('id',$item->cat)->get()->toArray();
                                foreach($cat as $item_name){
                                    echo $item_name['name'];
                                }
                                ?></td>
                            <td>
                                <a class="btn btn-sm btn-danger" onclick="del(<?= $item->id ?>,'<?= $item->title ?>')">حذف</a>
                                <a class="btn btn-sm btn-success" href="{{ url("admin/video/$item->id/edit/") }}">ویرایش</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>عنوان</th>
                        <th>دسته بندی</th>
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
        function del(id,name){
            var del = confirm('آیا '+name+' حذف شود؟');
            if(del == true){
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ url('admin/video/remove') }}',
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
