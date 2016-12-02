@extends('layouts.site')
@section('location','رویدادها')
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
        <div class="part_icon2">رویدادها مرکز</div>
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
        <div class="filter__wrap">
        @foreach($event as $item)
            <?php
            $img = \App\Image::where('event_id',$item['id'])->get();
            foreach ( $img as $it) {
                $img_addr=$it->img_name;
            }
            ?>
                <div class="item prj_item">
                    <a href="{{ url("event/".$item['title']) }}">
                        <img src="{{ asset('resources/upload/images/'.$img_addr) }}">
                        <h4>{{ $item['title'] }}</h4>
                        <h5>{!!  mb_substr($item['des'], 0, 200) !!}...</h5>
                    </a>
                </div>
            <?php $img_addr=""; ?>
        @endforeach
        </div>
        <hr id="hr1">
        <div class="pagination_custom text-center">
            {{ $event->render() }}
        </div>

</div>

 @endsection
@section('js')
        <script>
            var count = 0;
            function filter(filter_name,action){
                if(action == false){
                    $.ajax({
                        url:'{{ url('api/filter') }}',
                        type:"GET",
                        data:'filter_name='+filter_name,
                        success:function(data)
                        {
                            $(".filter__wrap").html(data);
                        }
                    });
                    $(".iran").attr("onchange","filter('"+filter_name+"',true)");
                }else{
                    $.ajax({
                        url:'{{ url('api/all') }}',
                        type:"GET",
                        data:'filter_name='+filter_name,
                        success:function(data)
                        {
                            $(".filter__wrap").html(data);
                        }
                    });
                    $(".iran").attr("onchange","filter('"+filter_name+"',false)");
                }
               /* if(count >= 1){
                    $(".iran").attr("onchange","filter("+filter_name+",true)");
                }*/



            }
        </script>
@endsection