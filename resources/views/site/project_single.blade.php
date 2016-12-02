@extends('layouts.site')
@section('location','پروژه ها')
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
        <div class="part_icon2">پروژه ها و تازه های</div>
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

        @foreach($project_single as $item)
        <div class="nav_bar">خانه - پروژه ها و تازه های  - {{$item->title}}</div>

        <div class="post_wrap">



            <div class="owl-carousel6" style="direction:ltr;">
                <?php
                    $a = 0;
                $img = \App\Image::where('project_id',$item->id)->get();
                foreach ($img as $it) { $a++?>

                <div class="item">
                    <div class="post_pic"><img src="{{ asset('resources/upload/images/'.$it->img_name) }}"></div>
                </div>
                    @if($a==1)
                        <div class="item">
                            <div class="post_pic"><img src="{{ asset('resources/upload/images/'.$it->img_name) }}"></div>
                        </div>
                    @endif
                    <?php } ?>
            </div>



            <div class="post_titel">{{ $item->title }}</div>
            {!! $item->des !!}






                @if(!empty($item->voice))
                <div id="voice">
                    <br>
                    پخش صدا
                    <br>
                    <audio style="width: 100%" controls>
                        <source src="{{ url("resources/upload/images/$item->voice") }}" type="audio/mpeg">
                        مرورگر شما از پخش موسیقی پشتیبانی نمی کند
                    </audio>
                </div>
                @endif
                <?php $img_addr=""; $iid=$item->id; $onvan=$item->title?>
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
‍‍‍
                    <span class="comment_title">ایمیل:</span>
                    {!! Form::text('email',null,['class'=>'text_input1']) !!}


                </div>
                <div class="large-9 columns left center">
                    <span class="comment_title">پیام:</span>
                    {!! Form::textarea('cm',null,['class'=>'text_input2']) !!}
                    {{ Form::hidden('id', $iid) }}
                    {{ Form::hidden('project_type', 'prjct') }}
                    {{ Form::hidden('replay_to', '',['class'=>'rep_d']) }}
                    {{ Form::hidden('onvan', $onvan ) }}

                </div>
                <div class="large-12 columns right center">
                    {!! Form::submit('ارسال نظر ',['style'=>'float:left','class'=>'button left']) !!}

                </div>
            </div>
        </div>
            {!! Form::close() !!}

        <div class="post_wrap">
            <br>
            <span class="comment_title">پروژه های دیگر</span>
            <br><br>

            <div class="owl-carousel5" style="direction:ltr;">
                @foreach($all_projects as $item2)
                    <?php
                    $img = \App\Image::where('project_id',$item2->id)->where('main',1)->get();
                    foreach ( $img as $it) {
                        $img_addr=$it->img_name;
                    }
                    ?>
                    <div class="item">
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
