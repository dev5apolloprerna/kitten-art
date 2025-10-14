<?php                                
$role = auth()->user()->role_id;

?>
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('front/assets/images/logo.png') }}" style="width: 60px" alt="">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('front/assets/images/logo.png') }}" style="width: 170px" alt="">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('front/assets/images/logo.png') }}" style="width: 60px" alt="">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('front/assets/images/logo.png') }}" style="width: 170px" alt="">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu"></span></li>
                @if($role == '1')

                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('home')) {{ 'active' }} @endif"
                        href="{{ url('home') }}">
                        <i class="mdi mdi-speedometer"></i>
                        <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('category.index')) {{ 'active' }} @endif"
                        href="{{ route('category.index') }}">
                        <i class="fa fa-list-alt"></i>
                        <span data-key="t-category">Category</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('plan.index')) {{ 'active' }} @endif"
                        href="{{ route('plan.index') }}">
                        <i class="fa fa-bookmark"></i>
                        <span data-key="t-subscription">Plan</span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('batch.index')) {{ 'active' }} @endif"
                        href="{{ route('batch.index') }}">
                        <i class="fa fa-calendar"></i>
                        <span data-key="t-subscription">Batch</span>
                    </a>
                </li>  
               
                 <li class="nav-item">
                        <a class="nav-link menu-link {{ in_array(request()->route()->getName(), ['studentinquiry.index', 'student.index', 'student.register_student', 'student.active_student','renewPlan.renew_plan']) ? 'active' : 'collapsed' }}"  href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="{{ in_array(request()->route()->getName(), ['studentinquiry.index', 'student.index', 'student.register_student', 'student.active_student', 'student.renew_plan']) ? 'true' : 'false' }}"
                            aria-controls="sidebarDashboards">
                            <i class="fas fa-user-graduate"></i>
                            <span data-key="t-dashboards">Student</span>
                        </a>
                        <div class="menu-dropdown collapse {{ in_array(request()->route()->getName(), ['studentinquiry.index', 'student.index', 'student.register_student', 'student.active_student', 'renewPlan.renew_plan']) ? 'show' : '' }}
                        " id="sidebarDashboards" style="">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('studentinquiry.index') }}" class="nav-link menu-link"
                                        data-key="t-crm">
                                        <i class="fa fa-question-circle"></i> Student Registration </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('student.index') }}" class="nav-link menu-link "
                                        data-key="t-crm">
                                        <i class="fas fa-user-clock"></i>Student Waitlist</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('student.register_student') }}" class="nav-link menu-link "
                                        data-key="t-crm">
                                        <i class="fas fa-address-card"></i>Pending Student</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('student.active_student') }}" class="nav-link menu-link "
                                        data-key="t-crm">
                                        <i class="fas fa-credit-card"></i>Active Student</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('renewPlan.renew_plan') }}" class="nav-link menu-link "
                                        data-key="t-crm">
                                        <i class="fas fa-credit-card"></i>Renew Student Plan</a>
                                </li>
                                

                            </ul>
                        </div>
                    </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('attendance.index')) {{ 'active' }} @endif"
                        href="{{ route('attendance.index') }}">
                        <i class="fas fa-calendar-check"></i> <!-- Attendance or event tracking -->
                        <span data-key="t-subscription">Student Attendance</span>
                    </a>
                </li> 
                <li class="nav-item">
                        <a class="nav-link menu-link {{ in_array(request()->route()->getName(), ['report.upcoming_renew']) ? 'active' : 'collapsed' }}"  href="#reportsidebar" data-bs-toggle="collapse" role="button" aria-expanded="{{ in_array(request()->route()->getName(), ['report.upcoming_renew']) ? 'true' : 'false' }}"
                            aria-controls="reportsidebar">
                            <i class="fas fa-file-alt"></i>
                            <span data-key="t-dashboards">Report</span>
                        </a>
                        <div class="menu-dropdown collapse {{ in_array(request()->route()->getName(), ['report.upcoming_renew']) ? 'show' : '' }}
                        " id="reportsidebar" style="">
                            <ul class="nav nav-sm flex-column">
                               
                                <li class="nav-item">
                                    <a href="{{ route('report.upcoming_renew') }}" class="nav-link menu-link "
                                        data-key="t-crm">
                                    <i class="fa-solid fa-font-awesome"></i>Upcoming Renewal</a>
                                </li>
                                

                            </ul>
                        </div>
                    </li>  
                 <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('gallery.index')) {{ 'active' }} @endif"
                        href="{{ route('gallery.index') }}">
                        <i class="fas fa-images"></i>
                        <span data-key="t-subscription">Gallery</span>

                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('events.index')) {{ 'active' }} @endif"
                        href="{{ route('events.index') }}">
                        <i class="fas fa-gifts"></i>
                        <span data-key="t-subscription">Events</span>
                    </a>
                </li>  
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('ebook.index')) {{ 'active' }} @endif"
                        href="{{ route('ebook.index') }}">
                        <i class="fas fa-book"></i>
                        <span data-key="t-subscription">E-Book</span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('Inquiry.index')) {{ 'active' }} @endif"
                        href="{{ route('Inquiry.index') }}">
                       <i class="fa fa-users"></i>
                        <span data-key="t-users">Ebook Member Data </span>
                    </a>
                </li>   -->
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('testimonial.index')) {{ 'active' }} @endif"
                        href="{{ route('testimonial.index') }}">
                       <i class="fa fa-quote-left"></i>
                        <span data-key="t-subscription">Testimonial </span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('trialClass.index')) {{ 'active' }} @endif"
                        href="{{ route('trialClass.index') }}">
                       <i class="fas fa-users"></i>
                        <span data-key="t-subscription">Trial Class </span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('service.index')) {{ 'active' }} @endif"
                        href="{{ route('service.index') }}">
                       <i class="fa fa-cog"></i>
                        <span data-key="t-subscription">Service </span>
                    </a>
                </li>  
                  <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('page.index')) {{ 'active' }} @endif"
                        href="{{ route('page.index') }}">
                       <i class="fas fa-file-alt"></i>
                        <span data-key="t-subscription">Page </span>
                    </a>
                </li>  
               
            @endif

            </ul>   
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
