<?php 
  $id=session()->get('student_id');
  $name=session()->get('student_name');
?>

<div class="navbar-area">
      <div class="main-responsive-nav">
        <div class="container-fluid">
          <div class="main-responsive-menu">
            <div class="logo">
              <a href="{{route('FrontIndex')}}">
                <img src="{{ asset('front/assets/images/logo.png')}}" class="black-logo" alt="image">
                <!-- <img src="assets/images/logo.png" class="white-logo" alt="image"> -->
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="main-navbar">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-md navbar-light">
            <a class="navbar-brand" href="{{route('FrontIndex')}}">
              <img src="{{ asset('front/assets/images/logo.png')}}" class="black-logo" alt="image" width="140px">
              <!-- <img src="assets/images/logo.png" class="white-logo" alt="image" width="140px"> -->
            </a>
            <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="{{route('FrontIndex')}}" class="nav-link @if (request()->routeIs('FrontIndex')) {{ 'active' }} @endif"> Home </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('FrontAbout')}}" class="nav-link @if (request()->routeIs('FrontAbout')) {{ 'active' }} @endif"> About us </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('FrontClass') }}" class="nav-link @if (request()->routeIs('FrontClass')) {{ 'active' }} @endif"> Classes <!--<i class="bx bx-chevron-down"></i>-->
                  </a>
                  <ul class="dropdown-menu">
                   
                    <li class="nav-item">
                  <a href="{{ asset('front/Supplies_List.pdf') }}" target="_blank" class="nav-link"> Supply List </a>
                </li>
                <li class="nav-item">
                  <a href="{{ asset('front/Payment_Info.pdf') }}" target="_blank" class="nav-link "> Payment Information </a>
                </li>
                  </ul>
                </li>
               <!--  <li class="nav-item">
                  <a href="{{route('FrontEbooks')}}" class="nav-link @if (request()->routeIs('FrontEbooks')) {{ 'active' }} @endif"> Ebooks </a>
                </li> -->

                <li class="nav-item">
                  <?php 
                      $Service = App\Models\Service::where(['service_id'=>2])->first();
                      ?>
                    <a href="{{ route('FrontServiceImages', $Service->slug) }}"
                       id="service-{{ $Service->slug }}"
                       class="nav-link @if (request()->routeIs('FrontServiceImages') && request()->route('id') == 'paint-party') active @endif">
                        {{ $Service->service_name }}
                    </a>
                    <!--<i class="bx bx-chevron-down"></i>--> </a>
                  <!--<ul class="dropdown-menu">
                    <?php
                      $Event = App\Models\Events::orderBy('event_name', 'asc')->get();
                     ?>
                     @foreach ($Event as $e)
                    <li class="nav-item">
                      <a href="{{route('FrontEventsDetail',$e->event_id)}}" class="nav-link "> {{ $e->event_name }}</a>
                    </li>
                    @endforeach
                  </ul>-->
                </li>
                <!-- <li class="nav-item">
                  <a href="#" class="nav-link @if (request()->routeIs('FrontServiceImages') && request()->route('id') != 'paint-party') {{ 'active' }} @endif"> Service <i class="bx bx-chevron-down"></i></a>
                  <ul class="dropdown-menu">
                    <?php
                      $Service = App\Models\Service::where('service_id','!=',2)->orderBy('service_name', 'asc')->get();
                     ?>
                     @foreach ($Service as $e)
                    <li class="nav-item">
                      <a href="{{route('FrontServiceImages',$e->slug)}}" class="nav-link "> {{ $e->service_name }}</a>
                    </li>
                    @endforeach
                  </ul>
                </li>  -->
                <li class="nav-item">
                  <a href="{{route('FrontGallery')}}" class="nav-link @if (request()->routeIs('FrontGallery')) {{ 'active' }} @endif"> Gallery </a>
                </li>
               <li class="nav-item">
                  <a href="{{route('FrontEventCalander')}}" class="nav-link @if (request()->routeIs('FrontEventCalander')) {{ 'active' }} @endif"> Calendar </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('FrontContact')}}" class="nav-link @if (request()->routeIs('FrontContact')) {{ 'active' }} @endif"> Contact </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('FrontTrialClass')}}" class="nav-link @if (request()->routeIs('FrontTrialClass')) {{ 'active' }} @endif"> Free Trial Class </a>
                </li>
               
              </ul>
               {{-- Header auth block --}}
              @auth('student')
                  @php
                      $u = Auth::guard('student')->user();
                      $displayName = trim(($u->student_first_name ?? '').' '.($u->student_last_name ?? ''));
                      if ($displayName === '') {
                          $displayName = session('student_name'); // fallback if needed
                      }
                  @endphp

                 <div class="others-options d-flex align-items-center" style="margin-right:10px">
                   <div class="option-item">
                    <a href="{{route('student_profile')}}" class="default-btn">My Account</a>
                  </div>
                  <!--<div class="option-item">-->
                  <!--  <a href="{{route('FrontStudentLogout')}}" class="">Logout</a>-->
                  <!--</div>-->
                </div>
              @else
                  <div class="others-options d-flex align-items-center" style="margin-right:10px">
                    <div class="option-item">
                      <a href="{{route('FrontLogin')}}" class="default-btn">Student Login</a>
                    </div>
                  </div>
              @endauth

              <div class="others-options d-flex align-items-center">
                <div class="option-item">
                  <a href="{{route('FrontRegistration')}}" class="default-btn">Register Now</a>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
