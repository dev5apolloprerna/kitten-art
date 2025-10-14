@extends('include')
@section('content')

<head>
        <meta chartset="UTF-8">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui">
        <meta name="description" content="Vb Card India Provide facility to manage your digital business card using your login details">
        <meta name="title" content="Digital Business Card - login, Maninagar, Ahmedabad,Gujarat / NearMeTrade">
        <meta name="keywords" content="Digital Business Card, Electronic Business Card, Virtual Business Card, E-Card, Digi Card">
        <meta property="og:image" itemprop="image" content="{{ asset('/front/images/intro-mobile2.png')}}"/>
        <meta property="og:type" content="website" />
        <meta property="og:description" content="Vb Card India Provide facility to manage your digital business card using your login details" />
        
        <title>Digital Business Card - login, Maninagar, Ahmedabad,Gujarat / NearMeTrade</title>
        <link rel="manifest" id="manifest-placeholder">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Shadows+Into Light&amp;display=swap" media="all" id="shr-font-shadows-into light">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link href="{{asset('front/css/bootstrap-4.5.0.min.css')}}" rel="stylesheet">
        <link href="{{asset('front/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('front/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('front/css/responsive.css')}}" rel="stylesheet">
        
        <!-- <link rel="stylesheet" href="{{asset('front/css/intlTelInput.min.css')}}"> -->
        <script async defer crossorigin="anonymous" src="{{asset('front/js/sdk.js#xfbml=1&version=v5.0')}}"></script>
    </head>

    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> <img src="/front/images/logo.png" class="logo"> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="{{ asset('/front/images/intro-mobile2.png')}}" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
            
                <div class="card2 card border-0 px-4 py-2">

                <h1 class="f_login_heading">Login</h1>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                @if(session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form action="{{ route('front.loginuser') }}" id="loginForm" novalidate="true" method="post" >
                {{ csrf_field() }}
                    <div class="row px-3">
                     <label class="mb-1">
                            <h6 class="mb-0 text-sm">Mobile Number</h6>
                        </label>
                        <input class="mb-4" type="text" placeholder="Enter Your Mobile Number" name="iMobile" value="" id="iMobile" required>
                     </div>
                    <div class="row px-3">
                     <label class="mb-1">
                            <h6 class="mb-0 text-sm">Password</h6>
                        </label>
                        <input class="mb-4" type="password" placeholder="Enter a Password" name="password" id="password" value="" required>
                     </div> 
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Remember me</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                    </div>
                    <div class="row px-3 mb-4"> 
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <button type="submit" class="btn btn-blue text-center">Login</button> 
                        </div> <a href="{{route('front.freeTrial')}}" class="ml-auto mb-0 text-sm">Registered Now</a>
                    </div>
                </form>
                    <!-- <div class="row mb-4 px-3"> <small class="font-weight-bold text-right">Register and create your virual business card Now? <a  class="btn btn-blue text-center" href="{{route('front.freeTrial')}}">Create Card</a></small> </div> -->
                </div>
            </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright 2021 {{ env('APP_NAME') }}..</small>
                <div class="social-contact ml-4 ml-sm-auto">
                  <a href="/">Back To home</a>
               </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="back-to-top">
        <i class="lni lni-arrow-up"></i>
    </a>
    </div>
    <script data-cfasync="false" src="js/email-decode.min.js"></script>
    <script src="{{asset('front/js/vendor/modernizr-3.5.0.min.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="{{asset('front/js/vendor/jquery-3.5.1-min.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="{{asset('front/js/popper.min.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="{{asset('front/js/bootstrap-4.5.0.min.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="{{asset('front/js/owl.carousel.2.3.4.min.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="{{asset('front/js/wow.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="{{asset('front/js/main.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="{{asset('front/js/form-validator.min.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="{{asset('front/js/contact-form-script.min.js')}}" type="a7908079abbf435af98f34d8-text/javascript"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="a7908079abbf435af98f34d8-|49" defer=""></script>
@section('scripts')
@parent
<script>

</script>
@endsection
@endsection