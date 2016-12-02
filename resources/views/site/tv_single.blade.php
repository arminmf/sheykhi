@extends('layouts.site')
@section('location','تلویزیون اینترنتی')
@section('content')
<div class="row">
    <div class="large-10 small-12 columns right">
        <hr id="hr1">
        <div class="row">
            <div class="large-8 small-12 columns right">

                <ul class="topics_tv">
                    <li>پروژه های : </li>
                    <li>مسکونی - ویلا</li>
                    <li>اداری</li>
                    <li>تجاری</li>
                    <li>عمومی</li>
                </ul>
                <br><br>
            </div>
            <div class="large-4 small-8 columns left">

                <div class="logo3"></div>
            </div>
        </div>
        <div class="part_icon">تلوزیون اینرنتی</div>
        <hr class="hr2">



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

        @foreach($video as $item)
            <?php $title= $item['title']; $iid =$item['id'];  ?>

            <div class="nav_bar">خانه - پروژه ها و تازه های - معماری و معماری داخلی</div>

        <div class="post_wrap">
            <div class="post_pic"><img src="{{ asset('resources/upload/images/'.$item['img']) }}"></div>
            <div class="post_titel">{{ $item['title'] }}</div>
            {!! $item['des'] !!}
            <br><br>
            @if(!empty($item['link_video']))
            <div>
                ویدیو شماره یک <br>
                <video width="100%" height="240" controls>
                    <source src="{{ url('resources/upload/images/'.$item['link_video']) }}" type="video/mp4">
                   مرورگرشما از ویدیو پشتیبانی نمی کنید مرورگر خو را بروز کنید
                </video>
            </div>
            @endif
            @if(!empty($item['link_video2']))
            <div>
                ویدیو شماره دو <br>
                <video width="100%" height="240" controls>
                    <source src="{{ url('resources/upload/images/'.$item['link_video2']) }}" type="video/mp4">
                    مرورگرشما از ویدیو پشتیبانی نمی کنید مرورگر خو را بروز کنید
                </video>
            </div>
            @endif
            @if(!empty($item['link_video3']))
            <div>
                ویدیو شماره سه <br>
                <video width="100%" height="240" controls>
                    <source src="{{ url('resources/upload/images/'.$item['link_video3']) }}" type="video/mp4">
                    مرورگرشما از ویدیو پشتیبانی نمی کنید مرورگر خو را بروز کنید
                </video>
            </div>
            @endif
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

                $cmrep = \App\Cm::where("replay_to",$item->id)->where("accept",1)->get();
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
                        {{ Form::hidden('project_type', 'tv') }}
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
              @foreach($all_tv as $item2)
                  <div class="item">
                      <a href="{{ url("project/$item2->title") }}">
                          <img src="{{ asset('resources/upload/images/'.$item2->img) }}">
                          <a href="{{ url("project/$item2->title") }}">

                              <h4>{{ $item2->title }}</h4>
                              <h5>{!!  mb_substr($item2->des, 0, 200) !!}...</h5>
                          </a>
                  </div>
              @endforeach
          </div>
            <hr id="hr1" style="margin-top:30px;">

        </div>
    </div>

 @endsection
@section('js')
        <script>
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
