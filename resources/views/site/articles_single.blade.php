@extends('layouts.site')
@section('location','مقالات کاربران')
@section('content')
<div class="row">
    <div class="large-10 small-12 columns right">
        <hr id="hr1">
        <div class="row">
            <div class="large-8 small-12 columns right">

                <br><br>
            </div>
            <div class="large-4 small-8 columns left">

                <div class="logo3"></div>
            </div>
        </div>
        <div class="part_icon">مقالات کاربران</div>
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

        @foreach($article as $item)
            <?php $title= $item['title']; $iid =$item['id'];  ?>


        <div class="post_wrap">
            <div class="post_pic"><img src="{{ asset('resources/upload/images/'.$item['img']) }}"></div>
            <div class="post_titel">{{ $item['title'] }}</div>
            {!! $item['text'] !!}
        </div>
        @endforeach


        <div class="post_wrap">
            <hr id="hr1" style="margin-top:30px;">

        </div>
    </div>

 @endsection