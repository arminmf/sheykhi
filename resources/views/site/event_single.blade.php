@extends('layouts.site')
@section('location','رویدادها')
@section('content')
<div class="row">
    <div class="large-10 small-12 columns right">
        <hr id="hr1">
        <ul class="topics">
            <li>پروژه های : </li>
            <li>معماری و معماری داخلی</li>
            <li>طراحی شهری</li>
            <li>طراحی صنعتی</li>
            <li>تکنولوژی</li>
        </ul>
        <div class="part_icon2">رویدادهای مرکز</div>
        <hr class="hr3">
    </div>
    <div class="large-2 small-12 columns left center">
        <ul class="medias">
            <li><a class="socials sms_" href="#"></a></li>
            <li><a class="socials twitter_" href="#"></a></li>
            <li><a class="socials telegram_" href="#"></a></li>
            <li><a class="socials instagram_" href="#"></a></li>
        </ul>

        <div class="login_pic mini_pic left center">
            <?php
            if(Auth::check()){
                $user = Auth::user();
            }else{
                $user = null;
            }
            ?>
            @if(!Auth::check())
                <a href='{{ url('login') }}'> ورود </a>
                <br>
                <a href='{{ url('register') }}'> عضویت </a>
            @else
                <a href='{{ url('admin') }}'>  پنل کاربری</a>
                    <br>
                    <a href='{{ url('logout') }}'> خروج</a>
            @endif
        </div>
        <div class="center">
            @if(Session::has('msg'))
                {{ Session::get('msg') }}
            @endif
            <form action="{{ url('newsletter/save') }}" method="get">
                <input name="email" type="email" placeholder="ایمیل خود را وارد کنید" class="input">
                <input name="submit" type="submit" style="display: block;width:100%; font-size: 1.1em!important;" class="button btn-block" style="font-size:1.2em;" value="عضویت در خبرنامه">
            </form>
        </div>
    </div>
</div>



<div class="row">
    <div class="large-2 small-12 columns left center">
        <img src="{{ asset('resources/dist-front/images/baner.jpg') }}" class="baner left center clear">
        <img src="{{ asset('resources/dist-front/images/Untitled3.png') }}" class="prj_3rd_row center clear"/>
        <img src="{{ asset('resources/dist-front/images/Untitled4.png') }}" class="prj_3rd_row center clear"/>
        <img src="{{ asset('resources/dist-front/images/Untitled3.png') }}" class="prj_3rd_row center clear"/>
        <img src="{{ asset('resources/dist-front/images/Untitled5.png') }}" style="height:400px;">

        <hr id='hr5'>
        <ul class="medias centered">
            <li><a class="socials sms_" href="#"></a></li>
            <li><a class="socials twitter_" href="#"></a></li>
            <li><a class="socials telegram_" href="#"></a></li>
            <li><a class="socials instagram_" href="#"></a></li>
        </ul>
    </div>

    <div class="large-10 small-12 columns right">

        @foreach($event as $item)
<?php $title=$item->title; $iid =$item->id;  ?>
        <div class="post_wrap">
            <?php
            $img = \App\Image::where('event_id',$item->id)->get();
            foreach ($img as $it) {
                $img_addr=$it->img_name;
            }
            ?>
            <div class="post_pic"><img src="{{ asset('resources/upload/images/'.$img_addr) }}"></div>
            <div class="post_titel">{{ $item->title }}</div>
                {!! $item->des !!}
                <br>

                @if(!Auth::check())
                   جهت عضویت در رویداد باید عضو سایت باشید.
                @else
                    <a href="#" onclick="ozviat('{{$user->id}}','{{$item->id}}');"  id="ozviatid" class="button" style="font-size: 1em">عضویت در رویداد</a>
                @endif



                <br>
                تاریخ رویداد :‌ {{ $item->fadate }}
                <br>
                محل برگذاری :‌ {{ $item->location }}
                <br>
                نقشه: (محل برگذاری بصورت دقیق روی نفشه مشخص شده است)
                <br>
                <div style="height:300px;" id="map_canvas"></div>
                {!! Form::hidden('lat',$item->lat,['id'=>'lat']) !!}
                {!! Form::hidden('log',$item->log,['id'=>'log']) !!}
            <?php $img_addr=""; ?>
        </div>
        @endforeach
        <div class="post_wrap">
            <span class="comment_title">نظرات</span>
            <br>
            @foreach($comments as $item)


            <ul class="comment_wrap">
                <li class="avatar_">
                    <img src="{{ url('resources/dist-front/images/avatar.jpg') }}">
                    <div class="vote-plus" onclick="vote({{$item->id}},'pos',false)">+ <span class="show_vote_p_{{$item->id}}">{{$item->pos}}</span></div>
                    <div class="vote-negetive" onclick="vote({{$item->id}},'neg',false)">- <span class="show_vote_n_{{$item->id}}">{{$item->neg}}</span></div>
                </li>

                <li class="comments">
                    <h4>{{ $item->name }}</h4>

                    <h5>{{ $item->comment_text }}</h5>
                    <span onclick="answer('{{$item->id}}','{{$item->name}}','{{$item->post_id}}')">پاسخ</span>
                </li>
            </ul>

            <?php

            $cmrep = \App\Cm::where("replay_to",$item->id)->get();
            foreach ($cmrep as $critem){

            ?>


            <ul class="comment_wrap" style="margin-right: 19%; width: 81%">
                <li class="avatar_">
                    <img src="{{ url('resources/dist-front/images/avatar.jpg') }}">
                    <div class="vote-plus" onclick="vote({{$critem->id}},'pos',false)">+ <span class="show_vote_p_{{$critem->id}}">{{$critem->pos}}</span></div>
                    <div class="vote-negetive" onclick="vote({{$critem->id}},'neg',false)">- <span class="show_vote_n_{{$critem->id}}">{{$critem->neg}}</span></div>
                </li>

                <li class="comments">
                    <h4>{{ $critem->name }}</h4>

                    <h5>{{ $critem->comment_text }}</h5>


                </li>
            </ul>


            <?php } ?>
            @endforeach




        </div>

            {!! Form::open(array('url' => 'project/addcm','files' => true,'id'=>'cm_rep')) !!}

            <div class="post_wrap">
                <span class="cm_rep_text"></span>
                <div class="row">
                    <div class="large-3 columns right center">
                        <span class="comment_title">نام:</span>

                        {!! Form::text('name',null,['class'=>'text_input1']) !!}

                        <span class="comment_title">ایمیل:</span>
                        {!! Form::text('email',null,['class'=>'text_input1']) !!}


                    </div>
                    <div class="large-9 columns left center">
                        <span class="comment_title">پیام:</span>
                        {!! Form::textarea('cm',null,['class'=>'text_input2']) !!}
                        {{ Form::hidden('id', $iid) }}

                        {{ Form::hidden('onvan', $title) }}
                        {{ Form::hidden('project_type', 'event') }}
                        {{ Form::hidden('replay_to', '',['class'=>'rep_d']) }}
                    </div>
                    <div class="large-12 columns right center">
                        {!! Form::submit('ارسال نظر ',['style'=>'float:left','class'=>'button left']) !!}

                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        <div class="post_wrap">
          <br>
          <span class="comment_title">ویدیو های دیگر</span>
          <br><br>

          <div class="owl-carousel5" style="direction:ltr;">
              @foreach($all_event as $item2)
                  <div class="item">
                    <?php
                    $img = \App\Image::where('event_id',$item2->id)->get();
                    foreach ( $img as $it) {
                        $img_addr=$it->img_name;
                    }
                    ?>
                      <a href="{{ url("project/$item2->title") }}">
                          <img src="{{ asset('resources/upload/images/'.$img_addr) }}">
                          <a href="{{ url("project/$item2->title") }}">

                              <h4>{{ $item2->title }}</h4>
                              <h5>{!!  mb_substr($item2->des, 0, 200) !!}...</h5>
                          </a>
                  </div>
                    <?php $img_addr=""; ?>
              @endforeach
          </div>
            <hr id="hr1" style="margin-top:30px;">
        </div>
    </div>

 @endsection
    @section('js')
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ZIWT_7edNeESRoyVkwm2fTfILvNJ5Zk&callback=initialize" type="text/javascript"></script>
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

            function ozviat(uid,eid){
                var del = confirm('آیا می خواهید عضو این رویداد شوید؟');
                if(del == true){
                    $.ajaxSetup({
                        headers:{
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'{{ url('/event/reg') }}',
                        type:'GET',
                        data:'uid='+uid+'&eid='+eid,
                        success:function(data){
                            $('.ozviatid').text('در این رویداد عضو هستید');
                        }
                    });
                }
            }

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
                    draggable: false
                });
                google.maps.event.addListener(marker, 'dragend', function() {
                    updatePosition(marker.getPosition());
                });
                updatePosition(latLng);

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


            function answer(cm_id,name,post_id){
                $('html, body').animate({
                    scrollTop: ($('#cm_rep').offset().top)-200
                }, 'veryfast');
                $('.cm_rep_text').text('درحال ارسال پاسخ به '+name);
                $('.rep_d').val(cm_id);
            }
            function vote(cm_id,vote,sts){
                if(vote === 'pos' && sts == false){
                    //ajax req
                    $.ajaxSetup({
                        headers:{
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'{{ url('cm/vote') }}',
                        type:'POST',
                        data:'cm_id='+cm_id+'&vote='+vote,
                        success:function(data){
                            $('.show_vote_p_'+cm_id).text(data);
                            $('.vote-plus').attr('onclick','vote('+cm_id+',pos,true)')
                        }
                    });
                }else if(vote == 'neg' && sts == false){
                    $.ajaxSetup({
                        headers:{
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'{{ url('cm/vote') }}',
                        type:'POST',
                        data:'cm_id='+cm_id+'&vote='+vote,
                        success:function(data){
                            $('.show_vote_n_'+cm_id).text(data);
                            $('.vote-negetive').attr('onclick','vote('+cm_id+',neg,true)')
                        }
                    });
                }
            }
        </script>
@endsection
