@extends('layouts.admin')
@section('location','پروژه ها')

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ZIWT_7edNeESRoyVkwm2fTfILvNJ5Zk&callback=initialize" type="text/javascript"></script>
<!-- AIzaSyD1ZIWT_7edNeESRoyVkwm2fTfILvNJ5Zk -->
<link type="text/css" href="{{asset('resources/datepicker/jspc-royal_blue.css')}}" rel="stylesheet" />
<script type="text/javascript" src="{{url('resources/datepicker/js-persian-cal.min.js')}}"></script>







@section('content')
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن ایونت</h3>
            </div>
            <div class="box-body" style="display: block;">
                {!! Form::open(array('url' => 'admin/event/store','files' => true)) !!}
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
                        <input type="text" name="fadate" id="pcal5" class="pdate "  >
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
                </div>
                <bR><bR>

                <br><br>
                <div class="col-md-12">
                    <div style="margin-top: 15px;" class="form-group">
                        {!! Form::label('map','نقشه') !!} - برای انتخاب محل ایونت نقطه مورد نظر را روی نقشه علامت گذاری کنید.
                        <div style="height:300px;" id="map_canvas"></div>
                        {!! Form::hidden('lat','35.689197',['id'=>'lat']) !!}
                        {!! Form::hidden('log','51.388974',['id'=>'log']) !!}

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
                    {!! Form::submit('ثبت ',['style'=>'float:left','class'=>'btn btn-success']) !!}





                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARqdpZGqnInJFheslqYVIqR-IoBHFV9dg&callback=initMap"
 type="text/javascript"></script>
 js?key=AIzaSyARqdpZGqnInJFheslqYVIqR-IoBHFV9dg
 -->

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
    <script src="{{ url('resources/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script>
        CKEDITOR.replace('des',{
            language: 'fa'
        });
    </script>
@endsection
