@extends('layouts.site')
@section('location','اخبار')
@section('content')
<div class="row">
    <div class="large-10 small-12 columns right">
        <hr id="hr1">
        <br><br>
        <div class="part_icon2">اعضای کارگروه</div>
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

        @foreach($users as $item)
            <?php $title=$item->title; $iid =$item->id;  ?>
        <div class="post_wrap">
            <?php
            /*$img = \App\Image::where('project_id',$item->id)->where('main',1)->get();
            foreach ($img as $it) {
                $img_addr=$it->img_name;
            }*/
            ?>
            <div class="avatar"><img src="{{ asset('resources/dist-front/images/avatar.jpg') }}"></div>
                <br>
                <div class="post_titel">نام و نام خانوادگی:‌ {{ $item->name }} {{ $item->lname }}</div>
                <div class="post_titel">سال تولد:‌ {{ $item->name }}</div>
                <div class="post_titel">میزان تحصیلات:‌ {{ $item->name }}</div>
                <div class="post_titel">تخصص ها:‌ {{ $item->name }}</div>
                <div class="post_titel">مدارک تحصیلی تخصصی:‌ {{ $item->name }}</div>
                <div class="post_titel">حضور در همایش ها:‌ {{ $item->name }}</div>
                <div class="post_titel">فعالیت های صورت گرفته در مرکز:‌ {{ $item->name }}</div>
                <div class="post_titel">ارایه مقاله:‌ {{ $item->name }}</div>
                <div class="post_titel">عضو کارگروه فرعی:‌ {{ $item->name }}</div>
                <div class="post_titel">تاریخ پایان عضویت:‌ {{ $item->name }}</div>
                <div class="post_titel">کدعضویت:‌ {{ $item->name }}</div>
                <div class="post_titel">مطالب منتشرشده از ...</div>
                <ul class="user_incr">
                    @foreach($articles as $article)
                        <li><a href="{{url('article/'.$article->title)}}">{{$article->title}}</a></li>
                    @endforeach
                </ul>
                <br>
            <div class="cv center">
                <?php if($item['pdf'] and $item['pdfacc']==1){?>
                    <a href="{{url('resources/upload/images/'. $item['pdf'])}}" style="font-weight: bold; font-size:1.2em;">دریافت رزومه {{ $item->name }} {{ $item->lname }}</a>
         <?php } ?>
            </div>
        </div>
        @endforeach
        <div class="post_wrap">
            <span class="comment_title">نظرات</span>



        <div class="post_wrap">
            <hr id="hr1" style="margin-top:30px;">
        </div>
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
            function vote(cm_id,vote){
                if(vote === '+'){
                    //ajax req

                    //update when sucess
                    $('.show_vote_p_'+cm_id).text('13');
                }else{
                    //ajax req

                    //update when sucess
                    $('.show_vote_n_'+cm_id).text('1');
                }
            }
        </script>
@endsection