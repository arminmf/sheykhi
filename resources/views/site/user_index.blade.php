@extends('layouts.site')
@section('location','پنل کاربران')
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
        <div class="part_icon2">پنل کاربران سایت</div>
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
    <div class="large-2 small-12 columns right">
            <ul class="tab-user">
                <li><a class="event-btn" data-active="false" onclick="show('event')">ایونت های عضو شده</a></li>
                <li><a class="post-btn" data-active="true" onclick="show('post')">ارسال مطلب</a></li>
                <li><a class="settings-btn" data-active="false" onclick="show('settings')"> تنظیمات</a></li>
            </ul>
    </div>
    <div class="large-8 small-12 columns right">
        <div id="event" style="display: none;">
            <div class="user-action">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>عنوان</th>
                        <th>مکان</th>
                        <th>تاریخ برگذاری</th>
                        <th>تاریخ ثبت</th>
                        <th style="width:180px;">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $i=0; ?>

                    @foreach($event2 as $item2)





                    <?php
                    $event=\App\Event::where('id',$item2->event_id)->get();

                    ?>
                    @foreach($event as $item)
                        <?php $i++ ?>
                        <tr id="<?php echo $item->id ?>">
                            <td>{{ $i }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{$item->location}}
                            </td>
                            <?php
                            $unixTimeStamp = ($item->tarikh - 2440587.5) * 86400;


                            ?>

                            <td><?php if ($item->tarikh) echo jDate::forge( $unixTimeStamp)->format('%d  %B  %Y',true) ?>
                            <td>{{ jDate::forge($item->time)->format('%d  %B  %Y',true)  }}
                            </td>
                            <td>
                                <a class="btn btn-sm btn-danger" onclick="del(<?= $item->id ?>,'<?= $item->title ?>')">حذف</a>
                                <a class="btn btn-sm btn-success" href="{{ url("admin/event/$item->id/edit/") }}">ویرایش</a>
                                <a class="btn btn-sm btn-success" href="{{ url("admin/event/create/members?id=$item->id/") }}">اعضا</a>

                                </br></br>
                                <?php
                                if($item->important == 1){
                                    $action = 0;
                                }else{
                                    $action = 1;
                                }
                                ?>

                                <a class="btn btn-sm btn-info" id="important-<?php echo $item->id ?>" onclick="important('<?= $item->id ?>',<?php echo $action ?>)">
                                    @if($item->important == 0)
                                        نمایش در بخش مهم ها
                                    @else
                                        عدم نمایش در بخش مهم ها
                                @endif
                                <!-- /end important button -->
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>









        <div id="post">
            <div class="user-action">
                {{ Form::open(['url' => 'user/store_post','files' => true]) }}
                {{ Form::label('title','عنوان نوشته') }}
                <br>
                {{ Form::text('title',null) }}
                {{ Form::label('des','متن نوشته') }}
                <br>
                {!! Form::textarea('text',null,['class'=>'form-control']) !!}<br>
                {!! Form::label('myfile','آپلود تصویر ') !!}
                {!! Form::file('myfile') !!}

                {{ Form::submit('ارسال',['class'=>'button left']) }}
                {{ Form::close() }}
            </div>
        </div>






        <div id="settings">
<h2>            آپلود رزومه(pdf)
</h2>
            <br>
            {!! Form::open(array('url' => 'user/settings','files' => true)) !!}

            {!! Form::file('myfile') !!}
            {{ Form::submit('ارسال',['class'=>'button left']) }}
            {{ Form::close() }}


        </div>




    </div>
    <div class="large-10 small-12 columns right">
        <hr id="hr1">
    </div>
 @endsection
@section('js')

        <script src="{{ url('resources/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
        <script>
            CKEDITOR.replace('text',{
                language: 'fa'
            });
            function show(type){
                var event = $("#event");
                var post = $("#post");
                var settings = $("#settings");
                if(type == 'event'){
                    event.show(200);
                    settings.hide(200);
                    post.hide(200);
                    $(".event-btn").data('active','true');
                    $(".event-btn").attr("data-active",$(".event-btn").data('active'));
                    $(".post-btn").attr("data-active",'false');
                    $(".settings-btn").attr("data-active",'false');

                }else if(type == 'post'){
                    event.hide(200);
                    settings.hide(200);
                    post.show(200);
                    $(".post-btn").data('active','true');
                    $(".post-btn").attr("data-active",$(".post-btn").data('active'));
                    $(".event-btn").attr("data-active",'false');
                    $(".settings-btn").attr("data-active",'false');
                }else if(type == 'settings'){
                    event.hide(200);
                    post.hide(200);
                    settings.show(200);

                    $(".settings-btn").data('active','true');
                    $(".settings-btn").attr("data-active",$(".settings-btn").data('active'));
                    $(".event-btn").attr("data-active",'false');
                    $(".post-btn").attr("data-active",'false');
                }

            }
        </script>
@endsection
