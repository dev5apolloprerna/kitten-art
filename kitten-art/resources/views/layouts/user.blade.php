<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ trans('global.site_title') }}</title>

  <link rel="stylesheet" href="{{ asset('/front/css/bootstrap-4.5.0.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/LineIcons.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/table_res.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('/front/css/style.css') }}">
  <script src="{{ asset('/front/js/jquery-1.9.1.min.js') }}"></script>
  <script src="{{ asset('/front/js/easyResponsiveTabs.js') }}"></script>
  @yield('styles')
</head>

<body>
  <header id="home" class="header">
    <div class="navbar-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="{{route('user.companyProfile')}}">
                <img src="{{ asset('/front/images/logo.png')}}" alt="{{ trans('global.site_title') }}">
              </a>
             
              <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                <ul id="nav" class="navbar-nav ml-auto">
                
                  <li class="nav-item">
                      <a href="{{route('user.companyProfile')}}"> Company Profile</a>
                    <ul >
                    <li >
                        <a  href="{{route('user.companyProfile')}}"> Company Info</a>
                      </li>
                      <li >
                          <a href="{{route('user.category')}}">Company Category</a>
                      </li>
                      <li >
                        <a  href="{{route('user.certificateListing')}}"> Company Certificate</a>
                      </li>
                      <li >
                        <a  href="{{route('user.paymentListing')}}"> Company Payment</a>
                      </li>
                      <li >
                        <a  href="{{route('user.Companyemployee')}}"> Company Employee</a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item @if(request()->routeIs('user.profileList') || request()->routeIs('user.profileEdit') || request()->routeIs('user.aboutList') || request()->routeIs('user.productList') || request()->routeIs('user.galleryList') || request()->routeIs('user.videoList') || request()->routeIs('user.brochureList') || request()->routeIs('user.offerList') || request()->routeIs('user.awardList') || request()->routeIs('user.feedbackList') || request()->routeIs('user.inquiryList')){{'active'}}@endif">
                    <a class="page-scroll" href="{{route('user.profileList')}}">My Cards</a>
                  </li>
                  <li class="nav-item @if(request()->routeIs('user.CreativeImageList') ){{'active'}}@endif"">
                    <a class="page-scroll" href="{{route('user.CreativeImageList')}}"> Creative Image</a>
                  </li>
                  <li class="nav-item ">
                    <a class="page-scroll" href="#" onclick="return userchangepassword();"> Change Password</a>
                  </li>
                  <!-- <li class="nav-item @if(request()->routeIs('user.inquiryDirectList') || request()->routeIs('user.inquirySearchList')){{'active'}}@endif">
                    <a class="page-scroll" href="{{route('user.inquiryDirectList')}}"> Inquiry</a>
                  </li> -->
                  <li class="nav-item">
                    <a class="page-scroll" href="{{route('user.logout')}}">Logout
                     
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  <section id="features" class="f_tab">

    @yield('content')

  </section>
  <!-- change password model -->

<div class="modal" id="passModal" style="margin: 8.75rem auto">
         <div class="modal-dialog">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title text-danger" id="heading">{{'Change Password'}}</h4>
                  <button type="button" class="close" onclick="closeModel()" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
                  <div class="form-group">
                     <!--<form method="POST">-->
                       <label for="name">New Password*</label>
                        <input type="password" id="pass" name="pass" class="form-control" required="">

                        <label for="name">Confirm Password*</label>
                        <input type="password" id="cpass" name="cpass" class="form-control" required="">
                        
                        
                  </div>
               </div>
               <!-- Modal footer -->
               <div class="modal-footer">
               <button type="submit" class="btn"  style="background-color:#0088c9" id="edit" onclick="updateNewPassword()">Change Password</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeModel()">Close</button>
               </div>
               <!--</form>-->
            </div>
         </div>
    </div>

<!-- end change password model -->
  <footer id="footer" class="footer-area section-padding">
     
      <div id="copyright">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="copyright-content">
                     <p>Copyright 2021 VB INDIA.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <a href="#" class="back-to-top">
      <i class="lni lni-arrow-up"></i>
   </a>
   </div>

   <script data-cfasync="false" src="{{ asset('front/js/email-decode.min.js') }}"></script>
   <script src="{{ asset('front/js/modernizr-3.5.0.min.js') }}"></script>
   <script src="{{ asset('front/js/jquery-3.5.1-min.js') }}" ></script>
   <script src="{{ asset('front/js/popper.min.js') }}" ></script>
   <script src="{{ asset('front/js/bootstrap-4.5.0.min.js') }}" ></script>
   <script src="{{ asset('front/js/owl.carousel.2.3.4.min.js') }}" ></script>
   <script src="{{ asset('front/js/wow.js') }}" ></script>
   <script src="{{ asset('front/js/main.js') }}" ></script>
   <script src="{{ asset('front/js/form-validator.min.js') }}" ></script>
   <script src="{{ asset('front/js/contact-form-script.min.js') }}" ></script>
   
   <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js"
      data-cf-settings="|49" defer=""></script>

   <script>
   function closeModel() 
  {
      $('#passModal').hide();
  }
   function userchangepassword()
   {
      $('#passModal').show();
      $('#heading').text('Change Password');
   }
   function updateNewPassword(){
        var pass = $('#pass').val();
        var cpass = $('#cpass').val();
        
        if(pass == cpass){
           var url = "{{route('user.changePassword')}}";
           //alert(url);
           $.ajax({
                url : url,
                type : 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} ,
                data : {pass : pass},
                success:function(data){
                  //alert(data);
                  if(data == 1)
                  {
                    alert('Password Change Successfully');
                    window.location = "{{route('user.logout')}}";
                  }
                  else
                  {
                    alert('Something Went Wrong');
                    window.location = "{{route('user.logout')}}";
                  }
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    $('#post').html(msg);
                },
            });
        }else{
            alert("New Password and Confirm Password not match.");
            window.location.href = "";
        }
    }
   </script>
    @yield('scripts')
</body>

</html>