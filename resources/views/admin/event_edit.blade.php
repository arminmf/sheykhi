@extends('layouts.admin')
@section('location','ویرایش پروژه')
@section('content')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ZIWT_7edNeESRoyVkwm2fTfILvNJ5Zk&callback=initialize" type="text/javascript"></script>

    <link type="text/css" href="{{asset('resources/datepicker/jspc-royal_blue.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{url('resources/datepicker/js-persian-cal.min.js')}}"></script>



    <div class="col-md-12">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">ویرایش ایونت</h3>
        </div>
        <div class="box-body" style="display: block;">
            {!! Form::model($model,['method'=>'PATCH','route'=>['admin.event.update',$model->id]]) !!}
            <div class="col-md-8">
                {!! Form::label('title','عنوان ایونت') !!}
                @if ($errors->has('title'))
                <span style="float: left;color:red">{{ $errors->first('title') }}</span>
                @endif
                {!! Form::text('title',null,['class'=>'form-control']) !!}
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





                <div class="col-md-6">
                    {!! Form::label('myfile','آپلود تصویر ایونت') !!}
                    {!! Form::file('myfile') !!}
                </div>

                <div class="col-md-3">
                    {!! Form::label('','تاریخ برگذاری') !!}
                    <br>
                    <input type="text" id="pcal5" class="pdate "  value="{{$model->fadate}}">
                    <input type="hidden" name="tarikh" id="extra" class="pdate wide">

                </div>
                <bR><bR>

            </div>


            <div class="col-md-12">
                <div class="col-md-3">
                    <br>
                    {!! Form::label('title','محل برگذاری ') !!}

                    {!! Form::text('location',null,['class'=>'form-control']) !!}





                </div>

                <div class="col-md-12">
                    <div style="margin-top: 15px;" class="form-group">
                        {!! Form::label('map','نقشه') !!} - برای انتخاب محل ایونت نقطه مورد نظر را روی نقشه علامت گذاری کنید.
                        <div style="height:300px;" id="map_canvas"></div>
                        {!! Form::hidden('lat', $model->lat,['id'=>'lat']) !!}
                        {!! Form::hidden('log', $model->lag,['id'=>'log']) !!}

                    </div>
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

                    {!! Form::submit('ثبت تغییرات',['style'=>'float:left','class'=>'btn btn-success']) !!}

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('js')

    <script type="text/javascript">
        var lat = null;
        var lng = null;
        var map = null;
        var geocoder = null;
        var marker = null;
        var myListener = null;

        jQuery(document).ready(function() {
            lat = jQuery('#lat').val();
            lng = jQuery('#log').val();
            jQuery('#pasar').click(function() {
                codeAddress();
                return false;
            });
            initialize();
        });

        function initialize() {

            geocoder = new google.maps.Geocoder();

            if (lat != '' && lng != '') {
                var latLng = new google.maps.LatLng(lat, lng);
            } else {
                var latLng = new google.maps.LatLng(11.027113, -63.862023);
            }
            var myOptions = {
                center: latLng,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            marker = new google.maps.Marker({
                map: map,
                position: latLng,
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function() {
                updatePosition(marker.getPosition());
            });
            updatePosition(latLng);
            google.maps.event.addListener(map, 'click', function(event) {
                if (marker) {
                    marker.setPosition(event.latLng)
                } else {
                    marker = new google.maps.Marker({
                        map: map,
                        position: event.latLng,
                        draggable: true
                    });
                }
                updatePosition(event.latLng);
            });

        }

        function codeAddress() {

            var address = document.getElementById("direccion").value;
            geocoder.geocode({
                'address': address
            }, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    updatePosition(results[0].geometry.location);

                    google.maps.event.addListener(marker, 'dragend', function() {
                        updatePosition(marker.getPosition());
                    });
                } else {
                    alert("No podemos encontrar la direccion, error: " + status);
                }
            });
        }

        function updatePosition(latLng) {
            jQuery('#lat').val(latLng.lat());
            jQuery('#log').val(latLng.lng());
        }
    </script>


    <script type="text/javascript">

        var objCal5 = new AMIB.persianCalendar( 'pcal5', {
                    extraInputID: 'extra',
                    extraInputFormat: 'JD'
                }
        );
    </script>
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