<?php use Illuminate\Support\Facades\Input; ?>
@extends('layouts.site')
@section('location','عضویت')
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
        </div>
    </div>


    <div class="row">
        <div class="large-10 small-12 columns right">
            <div class="part_icon2">عضویت در سایت</div>
            <hr class="hr3">
        </div>


    </div>

    <div class="row">
        <div class="large-2 small-12 columns left center">
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
            <div class="pages_des">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="large-4 control-label">نام</label>

                                <div class="large-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                                <label for="lname" class="large-4 control-label">نام خانوادگی</label>

                                <div class="large-6">
                                    <input id="name" type="text" class="form-control" name="lname" value="{{ old('lname') }}">

                                    @if ($errors->has('lname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('kargoroh') ? ' has-error' : '' }}">
                                <label for="kargoroh" class="large-4 control-label">کارگروه</label>

                                <div class="large-6">
                                    <select name="kargoroh" id="kargoroh" class="form-control">
                                        <option value="shahr_sazi">شهرسازی</option>
                                        <option value="memari">معماری و معماری داخلی</option>
                                        <option value="tarahi_sanaati">طراحی صنعتی</option>
                                        <option value="graphic_mohit">گرافیک محیطی</option>
                                        <option value="paydari">منظر و پایداری</option>
                                        <option value="norpardazi">نورپردازی</option>
                                        <option value="naghashi">نقاشی و مجسمه سازی</option>
                                    </select>
                                    @if ($errors->has('kargoroh'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('kargoroh') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="large-4 control-label">آدرس ایمیل</label>

                                <div class="large-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="large-4 control-label">رمزعبور</label>

                                <div class="large-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="large-4 control-label">تایید رمزعبور</label>

                                <div class="large-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="large-6">
                                    <button style="font-size: 0.9em!important;padding-top: 10px;padding-bottom: 10px;" type="submit" class="button">
                                        <i class="fa fa-btn fa-user"></i> عضویت
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr id="hr1">
        </div>
@endsection
