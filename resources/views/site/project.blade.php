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
        <div class="part_icon2">پروژه ها و تازه های</div>
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
            <li class="filter_order">موقعیت پروژه : </li>
            <li>  <input type="checkbox"  id="36" class="iran" onchange=""> ایران</li>
            <li>  <input type="checkbox" id="37" class="asia" onchange=""> آسیا</li>
            <li>  <input type="checkbox" id="38" onchange=""> اروپا</li>
            <li> <input type="checkbox" id="39" onchange=""> آفریقا</li>
            <li> <input type="checkbox" id="40" onchange=""> آمریکا</li>

            <li class="filter_order">حوضه  : </li>
            <li> <input type="checkbox" id="1" onchange=""> معماری</li>
            <li> <input type="checkbox" id="2" onchange=""> طراحی صنعتی</li>
            <li> <input type="checkbox" id="3" onchange=""> طراحی داخلی</li>
            <li> <input type="checkbox" id="4" onchange=""> بسته بندی</li>
            <li> <input type="checkbox" id="5" onchange=""> منظر  و فضای سبز</li>
            <li> <input type="checkbox" id="6" onchange=""> طراحی شهری</li>
            <li> <input type="checkbox" id="7" onchange=""> مبلمان</li>



            <li class="filter_order">خصوصیت  : </li>
            <li> <input type="checkbox" id="15" onchange=""> پایداری</li>
            <li> <input type="checkbox" id="16" onchange=""> سبز</li>
            <li> <input type="checkbox" id="17" onchange=""> شهری</li>
            <li> <input type="checkbox" id="18" onchange=""> خلاقانه</li>
            <li> <input type="checkbox" id="19" onchange=""> هوشمند</li>
            <li> <input type="checkbox" id="20" onchange=""> آینده</li>
            <li> <input type="checkbox" id="21" onchange=""> ایکس</li>
            <li> <input type="checkbox" id="22" onchange=""> پلان</li>
            <li> <input type="checkbox" id="23" onchange=""> محصولات</li>
            <li> <input type="checkbox" id="24" onchange=""> لوکس</li>
            <li> <input type="checkbox" id="25" onchange=""> کوچک</li>

            <li class="filter_order">کاربری  : </li>

            <li> <input type="checkbox" id="26" onchange=""> مسکونی</li>
            <li> <input type="checkbox" id="27" onchange=""> اداری</li>
            <li> <input type="checkbox" id="28" onchange=""> تجاری</li>
            <li> <input type="checkbox" id="29" onchange=""> آموزشی</li>
            <li> <input type="checkbox" id="30" onchange=""> مراکز تفریحی</li>
            <li> <input type="checkbox" id="31" onchange=""> مراکز درمانی</li>
            <li>  خدمات:</li><br>
            <li> <input type="checkbox" id="32" onchange=""> هتل</li>
            <li> <input type="checkbox" id="33" onchange=""> رستوران</li>


            <li class="filter_order">سبک پروژه : </li>
            <li> <input type="checkbox" id="41" onchange=""> مدرن</li>
            <li> <input type="checkbox" id="42" onchange=""> کلاسیک</li>
            <li> <input type="checkbox" id="45" onchange=""> بومی</li>
            <li> <input type="checkbox" id="46" onchange=""> پایدار</li>
            <li> <input type="checkbox" id="43" onchange=""> نئوکلاسیک</li>
            <li> <input type="checkbox" id="44" onchange=""> گوتیک</li>
            <li> <input type="checkbox" id="47" onchange=""> فولرنیگ</li>
            <li> <input type="checkbox" id="48" onchange=""> ارگانیک</li>
            <li> <input type="checkbox" id="49" onchange=""> اسلامی</li>
            <li> <input type="checkbox" id="50" onchange=""> معماری دیجیتال</li>
            <li> <input type="checkbox" id="51" onchange=""> معماری بیونیک</li>
            <li> <input type="checkbox" id="52" onchange=""> اکوتک</li>
            <li> <input type="checkbox" id="53" onchange=""> دینامیک</li>
            <li> <input type="checkbox" id="54" onchange=""> دیکانستراکشن</li>
            <li>  ایرانی:</li><br>
            <li> <input type="checkbox" id="55" onchange=""> خراسانی</li>
            <li> <input type="checkbox" id="56" onchange=""> آذری</li>
            <li> <input type="checkbox" id="57" onchange=""> اصفهانی</li>

            <li class="filter_order">نوع نوشتار  : </li>
            <li> <input type="checkbox" id="58" onchange=""> مقاله</li>
            <li> <input type="checkbox" id="59" onchange=""> پروژه</li>
            <li> <input type="checkbox" id="60" onchange=""> گزارش</li>
            <li> <input type="checkbox" id="61" onchange=""> اخبار</li>


            <li>  <div class="arrow_down"></div> </li>
            <li style="text-align: center;"><button onclick="" class="button btn-block">اعمال فیلتر</button></li>
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
        <div class="filter__wrap">
        @foreach($project as $item)
            <?php
            $img = \App\Image::where('project_id',$item['id'])->where('main',1)->get();
            foreach ( $img as $it) {
                $img_addr=$it->img_name;
            }
            ?>
                <div class="item prj_item">
                    <a href="{{ url("project/".$item['title']) }}">
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
            {{ $project->render() }}
        </div>

</div>

 @endsection
@section('js')
        <script>
            $("input:checkbox").change(function() {
                var filter = {};
                filter.filter_checked = [];
                filter.filter_Denied = [];

                $("input:checkbox").each(function() {
                    if ($(this).is(":checked")) {
                        filter.filter_checked.push($(this).attr("id"));
                    } else {
                        filter.filter_Denied.push($(this).attr("id"));
                    }
                });
                var filter_str = filter.filter_checked.toString();
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{ url('api/filter') }}',
                    type:'GET',
                    data:'str='+filter_str,
                    success:function(data){
                       $('.filter__wrap').html(data);
                    }
            });
            });
        </script>
@endsection
