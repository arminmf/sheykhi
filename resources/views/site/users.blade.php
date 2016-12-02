@extends('layouts.site')
@section('location','پروژه ها')
@section('content')
<div class="row">
    <div class="large-10 small-12 columns right">
        <hr id="hr1">

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
        <div class="part_icon2">لیست کاربران</div>
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

            <li class="filter_order">انتخاب کارگروه : </li>
            <li>  <input type="checkbox"> شهر سازی</li>
            <li>  <input type="checkbox"> معماری و معماری داخلی</li>
            <li>  <input type="checkbox"> طراحی صنعتی</li>
            <li> <input type="checkbox"> نقاشی و مجسمه سازی</li>
            <li> <input type="checkbox"> گرافیک محیطی</li>
            <li> <input type="checkbox"> منظر و پایداری</li>
            <li> <input type="checkbox"> نورپردازی</li>

            <li class="filter_order">نوع عضویت : </li>
            <li> <input type="checkbox"> فعال</li>
            <li> <input type="checkbox"> افتخاری</li>


        </ul>

        <br><br><br><br><br>

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
            <a href="{{url("users/".$item->id)}}">
        <div class="item prf_item"><img src="{{ asset('resources/dist-front/images/avatar.jpg') }}">
            <h4>کارگروه :</h4>
            <h4>
                <?php
                    switch($item->kargoroh){
                        case 'shahr_sazi': echo 'شهرسازی'; break;
                        case 'memari': echo 'معماری و معماری داخلی'; break;
                        case 'tarahi_sanaati': echo 'طراحی صنعتی'; break;
                        case 'graphic_mohit': echo 'گرافیک محیطی'; break;
                        case 'paydari': echo 'منظر و پایداری'; break;
                        case 'norpardazi': echo 'نورپردازی'; break;
                        case 'naghashi': echo 'نقاشی و مجسمه‌سازی'; break;
                    }
                ?>
            </h4>
            <h5>
                <ul>
                    <li>نام : {{ $item->name }}</li>
                    <li> نام خانوادگی : {{ $item->lname }}</li>
                    <li>نوع عضویت : فعال</li>
                    <li> تاریخ عضویت {{ jDate::forge($item->created_at->format('Y-m-d'))->format('%d  %B  %Y',true)  }}</li>
                    <li>پایان عضویت 1/5/1396</li>
                </ul>
            </h5>
        </div>
            </a>

        @endforeach


    <hr id="hr1">
            <div class="pagination_custom text-center">
                {{ $users->render() }}
            </div>
</div>

 @endsection