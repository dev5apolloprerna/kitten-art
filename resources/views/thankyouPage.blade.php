<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ trans('global.site_title') }}</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="{{asset('front/css/bootstrap-4.5.0.min.css')}}" rel="stylesheet">
   <style>
       .card {
    border: 1px solid #ccc;
    box-shadow: 0 0 8px 2px #0000002e;
}
   </style>
</head>

<body>
<div class="container">
        <br>
        
        <div class="row">
            
           
        <div class="col-md-4"></div>
            <div class="col-md-4">
                <figure class="card card-product f_card thank_u">
                
                    <figcaption class="info-wrap">
                    <div class="img-wrap"><img src="{{ asset('/front/images/logo.png')}}"></div>
                    <div class="f_succes text-center">
                        <span><i class="fa fa-check"></i></span>
                        <h4 class="title text-center">payment Successfull</h4>
                    </div>
                    </figcaption>
                    <div class="bottom-wrap">
                        <div class="f_btn_bottom">
                            
                            <div class="f_btn_bottom_left f_text_center_btn">
                                <a href="{{route('user.profileList')}}">Back To Profile</a>
                            </div>
                           
                        </div>
                        <!-- price-wrap.// -->
                    </div>
                    <!-- bottom-wrap.// -->
                </figure>
            </div>
            <!-- col // -->
        </div>
        <!-- row.// -->
    </div>
    
  
</body>

</html>