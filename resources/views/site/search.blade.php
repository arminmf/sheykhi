@extends('layouts.site')
@section('location','جست‌و‌جو')
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
    <div class="large-10 small-12 columns right">
        <div class="part_icon2">نتایج جست‌و‌جو</div>
        <hr class="hr3">
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
        @if(!empty($search_keyword))
            <div class="large-12 columns center"style="margin-bottom: 15px;">شما کلمه '{{$search_keyword}}' را جستجو کرده اید.</div>
        @endif
        @if(!empty($project))
        <div class="large-12 columns"style="margin-bottom: 15px;">نتایج جستجو در پروژه‌ها : </div>
        @endif
                @foreach($project as $prjitem)
                <?php
                    $img = \App\Image::where('project_id',$prjitem['id'])->where('main',1)->get();
                    foreach ( $img as $it) {
                        $img_addr=$it->img_name;
                    }
                ?>
                <div class="item prj_item">
                    <a href="{{ url('project/'.$prjitem['title']) }}">
                        <img src="{{ url('resources/upload/images/'.$img_addr) }}">
                        <h4>{{ $prjitem['title'] }}</h4>
                        <h5>{!!  mb_substr($prjitem['des'], 0, 200) !!}...</h5>
                    </a>
                </div>
                    <?php $img_addr =''; ?>
                @endforeach
        @if(!empty($news))
            <div class="large-12 columns"style="margin-bottom: 15px;">نتایج جستجو در اخبار :‌ </div>
        @endif
        @foreach($news as $newitem)
        <div class="item prj_item">
            <a href="{{ url('news/'.$newitem['title']) }}">
                <img src="">
                <h4>{{ $newitem['title'] }}</h4>
                <h5>{!!  mb_substr($newitem['des'], 0, 200) !!}...</h5>
            </a>
        </div>
        @endforeach
        @if(!empty($video))
            <div class="large-12 columns"style="margin-bottom: 15px;">نتایج جستجو تلوزیون اینترنتی :‌ </div>
        @endif
        @foreach($video as $viditem)
                <div class="item prj_item">
                    <a href="{{ url('tv/'.$viditem['title']) }}">
                        <img src="{{ url('resources/upload/images/'.$viditem['img']) }}">
                        <h4>{{ $viditem['title'] }}</h4>
                        <h5>{!!  mb_substr($viditem['des'], 0, 200) !!}...</h5>
                    </a>
                </div>
        @endforeach
        <hr id="hr1">
            <div class="pagination_custom text-center">

            </div>
</div>

 @endsection