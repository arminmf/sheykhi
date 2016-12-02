@extends('layouts.admin')
@section('location','پروژه ها')
@section('content')
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن پروژه</h3>
            </div>
            <div class="box-body" style="display: block;">
                {!! Form::open(array('url' => 'admin/project/store','files' => true)) !!}
                <div class="col-md-8">
                    {!! Form::label('title','عنوان پروژه') !!}
                    @if ($errors->has('title'))
                        <span style="float: left;color:red">{{ $errors->first('title') }}</span>
                    @endif
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('cat','موضوع پروژه') !!}
                    @if ($errors->has('cat'))
                        <span style="float: left;color:red">{{ $errors->first('cat') }}</span>
                    @endif


                    <select name="cat" id="cat" class="form-control">
                        @foreach($cat as $item)
                            <option @if ($cat = $item['id']) selected @endif value="<?= $item['id']; ?>">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <br>
                    {!! Form::label('des','توضیحات') !!}<br>
                    @if ($errors->has('des'))
                        <span style="float: left;color:red">{{ $errors->first('des') }}</span>
                    @endif
                    {!! Form::textarea('des',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="col-md-12">
                        {!! Form::label('addon','امکانات فیلتر') !!}
                    </div>



                    <ul class="filtering">

                        <div class="col-md-4">
                            <br> <li class="filter_order">موقعیت پروژه : </li>
                        <li> <input type="checkbox" name="filter36"  class="iran" onchange="filter('iran',false)"> ایران</li>
                        <li> <input type="checkbox" name="filter37" class="asia" onchange="filter('asia',false)"> آسیا</li>
                        <li> <input type="checkbox" name="filter38" onchange="filter('euro')"> اروپا</li>
                        <li> <input type="checkbox" name="filter39" onchange="filter('africa')"> آفریقا</li>
                        <li> <input type="checkbox" name="filter40" onchange="filter('usa')"> آمریکا</li>

                            <br><li class="filter_order">حوضه  : </li>
                        <li> <input type="checkbox" name="filter1" onchange=""> معماری</li>
                        <li> <input type="checkbox" name="filter2" onchange=""> طراحی صنعتی</li>
                        <li> <input type="checkbox" name="filter3" onchange=""> طراحی داخلی</li>
                        <li> <input type="checkbox" name="filter4" onchange=""> بسته بندی</li>
                        <li> <input type="checkbox" name="filter5" onchange=""> منظر  و فضای سبز</li>
                        <li> <input type="checkbox" name="filter6" onchange=""> طراحی شهری</li>
                        <li> <input type="checkbox" name="filter7" onchange=""> مبلمان</li>



                          <br>  <li class="filter_order">کاربری  : </li>

                            <li> <input type="checkbox" name="filter26" onchange=""> مسکونی</li>
                            <li> <input type="checkbox" name="filter27" onchange=""> اداری</li>
                            <li> <input type="checkbox" name="filter28" onchange=""> تجاری</li>
                            <li> <input type="checkbox" name="filter29" onchange=""> آموزشی</li>
                            <li> <input type="checkbox" name="filter30" onchange=""> مراکز تفریحی</li>
                            <li> <input type="checkbox" name="filter31" onchange=""> مراکز درمانی</li>
                            <li>  خدمات:</li>
                            <li> <input type="checkbox" name="filter32" onchange=""> هتل</li>
                            <li> <input type="checkbox" name="filter33" onchange=""> رستوران</li>

                        </div>

                        <div class="col-md-4">
                            <br><li class="filter_order">خصوصیت  : </li>
                        <li> <input type="checkbox" name="filter15" onchange=""> پایداری</li>
                        <li> <input type="checkbox" name="filter16" onchange=""> سبز</li>
                        <li> <input type="checkbox" name="filter17" onchange=""> شهری</li>
                        <li> <input type="checkbox" name="filter18" onchange=""> خلاقانه</li>
                        <li> <input type="checkbox" name="filter19" onchange=""> هوشمند</li>
                        <li> <input type="checkbox" name="filter20" onchange=""> آینده</li>
                        <li> <input type="checkbox" name="filter21" onchange=""> ایکس</li>
                        <li> <input type="checkbox" name="filter22" onchange=""> پلان</li>
                        <li> <input type="checkbox" name="filter23" onchange=""> محصولات</li>
                        <li> <input type="checkbox" name="filter24" onchange=""> لوکس</li>
                        <li> <input type="checkbox" name="filter25" onchange=""> کوچک</li>




                            <br><li class="filter_order">نوع نوشتار  : </li>
                            <li> <input type="checkbox" name="filter58" onchange=""> مقاله</li>
                            <li> <input type="checkbox" name="filter59" onchange=""> پروژه</li>
                            <li> <input type="checkbox" name="filter60" onchange=""> گزارش</li>
                            <li> <input type="checkbox" name="filter61" onchange=""> اخبار</li>

</div>

                        <div class="col-md-4">
                            <br> <li class="filter_order">سبک پروژه : </li>
                                <li> <input type="checkbox" name="filter41" onchange=""> مدرن</li>
                                <li> <input type="checkbox" name="filter42" onchange=""> کلاسیک</li>
                                <li> <input type="checkbox" name="filter45" onchange=""> بومی</li>
                                <li> <input type="checkbox" name="filter46" onchange=""> پایدار</li>
                                <li> <input type="checkbox" name="filter43" onchange=""> نئوکلاسیک</li>
                                <li> <input type="checkbox" name="filter44" onchange=""> گوتیک</li>
                                <li> <input type="checkbox" name="filter47" onchange=""> فولرنیگ</li>
                                <li> <input type="checkbox" name="filter48" onchange=""> ارگانیک</li>
                                <li> <input type="checkbox" name="filter49" onchange=""> اسلامی</li>
                                <li> <input type="checkbox" name="filter50" onchange=""> معماری دیجیتال</li>
                                <li> <input type="checkbox" name="filter51" onchange=""> معماری بیونیک</li>
                                <li> <input type="checkbox" name="filter52" onchange=""> اکوتک</li>
                                <li> <input type="checkbox" name="filter53" onchange=""> دینامیک</li>
                                <li> <input type="checkbox" name="filter54" onchange=""> دیکانستراکشن</li>
                                <li>  ایرانی:</li>
                                <li> <input type="checkbox" name="filter55" onchange=""> خراسانی</li>
                                <li> <input type="checkbox" name="filter56" onchange=""> آذری</li>
                                <li> <input type="checkbox" name="filter57" onchange=""> اصفهانی</li>
                         </div>





                    </ul>





<div class="col-md-12">
    <br><br>
                    <div class="col-md-6">
                        {!! Form::label('myfile','آپلود تصاویر پروژه') !!}
                        {!! Form::file('images[]', array('multiple'=>true)) !!}
                    </div>

                            <div class="col-md-6">
                                {!! Form::label('voice','موسیقی') !!}
                                @if ($errors->has('voice'))
                                    <span style="float: left;color:red">{{ $errors->first('voice') }}</span>
                                @endif
                                {!! Form::file('voice') !!}


                    </div>


                    <div class="col-md-6">
                        {!! Form::label('keywords','کلمات کلیدی ( با , جدا شوند)') !!}
                        @if ($errors->has('keywords'))
                            <span style="float: left;color:red">{{ $errors->first('keywords') }}</span>
                        @endif
                        {!! Form::text('keywords',null,['class'=>'form-control']) !!}


                    </div>

                    <div class="col-md-12">
                        <br>

                        {!! Form::submit('ثبت پروژه',['style'=>'float:left','class'=>'btn btn-success']) !!}
                    </div>


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