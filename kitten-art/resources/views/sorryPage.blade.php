

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet">
   <link href="{{asset('front/css/bootstrap-4.5.0.min.css')}}" rel="stylesheet">
   <title>Document</title>
</head>
<body>
   



<div class="section-container" id="enquiry-section">
<div class="row">
   <div class="col-md-4">&nbsp;</div>
   <div class="error-template col-md-4">
      <div class="logo-box clearfix">
         <a href="{{route('front.homeIndex')}}">
            <img src="{{ asset('/front/images/logo.png')}}" class="main-logo" width="128" alt="VBCard India" title="VBCard India">
         </a>
      </div>
      @if($layoutFile != '')
      <h1 style="font-size:25px">Sorry Card Is Expire!!</h1>
      @else
      <h1 style="font-size:25px">Sorry Data Not Found!!</h1>
      @endif

      <a href="{{route('front.homeIndex')}}">Go To Our Website</a>
   </div>

</div>
</div>




</body>
</html>