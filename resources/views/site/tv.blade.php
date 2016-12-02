@extends('layouts.site')
@section('location','پروژه ها')
@section('content')
<div class="row">
    <div class="large-10 small-12 columns right">
        <hr id="hr1">
        <div style="margin-top: 13px" class="logo3"></div>
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

    </div>
</div>


<div class="row">
    <div class="large-10 small-12 columns right">
        <div class="part_icon2">تلویزیون اینترنتی</div>
        <hr class="hr3">
    </div>



</div>

<div class="row">
    <div class="large-2 small-12 columns left center">
        <div class="center">
            @if(Session::has('msg'))
                {{ Session::get('msg') }}
            @endif
            <form action="{{ url('newsletter/save') }}" method="get">
                <input name="email" type="email" placeholder="ایمیل خود را وارد کنید" class="input">
                <input name="submit" type="submit" style="display: block;width:100%; font-size: 1.1em!important;" class="button btn-block" style="font-size:1.2em;" value="عضویت در خبرنامه">
            </form>
        </div>
        <div class="filter_head">فیلتر کردن</div>
        <ul class="filtering">

            <li class="filter_order">دسته بندی</li>
            <li>  <input type="checkbox"> دسته ۱</li>
            <li>  <input type="checkbox"> دسته ۲</li>
            <li>  <input type="checkbox"> دسته ۳</li>
        </ul>



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
                <div class="item prj_item">
                    <a href="{{ url("tv/$item->title") }}">
                        <img src="{{ asset('resources/upload/images/'.$item->img) }}">
                        <h4>{{ $item->title }}</h4>
                        <h5>{!!  mb_substr($item->des, 0, 200) !!}...</h5>
                    </a>
                </div>
        @endforeach
        <hr id="hr1">
            <div class="pagination_custom text-center">
                {{ $video->render() }}
            </div>
</div>

 @endsection