<?php                                
$role = auth()->user()->role_id;

?>
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(url('home')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(asset('front/assets/images/logo.png')); ?>" style="width: 60px" alt="">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset('front/assets/images/logo.png')); ?>" style="width: 170px" alt="">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(url('home')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(asset('front/assets/images/logo.png')); ?>" style="width: 60px" alt="">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset('front/assets/images/logo.png')); ?>" style="width: 170px" alt="">
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
                <?php if($role == '1'): ?>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('home')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(url('home')); ?>">
                        <i class="mdi mdi-speedometer"></i>
                        <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('category.index')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(route('category.index')); ?>">
                        <i class="fa fa-list-alt"></i>
                        <span data-key="t-category">Category</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('plan.index', 'plan.create', 'plan.edit')): ?> active <?php endif; ?>"
                        href="<?php echo e(route('plan.index')); ?>">
                        <i class="fa fa-bookmark"></i>
                        <span data-key="t-subscription">Plan</span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('batch.index')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(route('batch.index')); ?>">
                        <i class="fa fa-calendar"></i>
                        <span data-key="t-subscription">Batch</span>
                    </a>
                </li>  
               
                 <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(in_array(request()->route()->getName(), ['studentinquiry.index','studentinquiry.view', 'studentinquiry.edit', 'student.index', 'student.register_student', 'student.active_student','renewPlan.renew_plan','student.view','student.edit','student.active_student_view','renewPlan.edit_renew_student    ']) ? 'active' : 'collapsed'); ?>"  href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo e(in_array(request()->route()->getName(), ['studentinquiry.index', 'student.index', 'student.register_student', 'student.active_student', 'student.renew_plan','student.view','studentinquiry.view', 'studentinquiry.edit','student.edit','student.active_student_view','renewPlan.edit_renew_student']) ? 'true' : 'false'); ?>"
                            aria-controls="sidebarDashboards">
                            <i class="fas fa-user-graduate"></i>
                            <span data-key="t-dashboards">Student</span>
                        </a>
                        <div class="menu-dropdown collapse <?php echo e(in_array(request()->route()->getName(), ['studentinquiry.index', 'student.index', 'student.register_student', 'student.active_student', 'renewPlan.renew_plan','student.view','studentinquiry.view', 'studentinquiry.edit','student.edit','student.active_student_view','renewPlan.edit_renew_student']) ? 'show' : ''); ?>

                        " id="sidebarDashboards" style="">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('studentinquiry.index')); ?>" class="nav-link menu-link 
                                    <?php if(request()->routeIs('studentinquiry.index', 'studentinquiry.view', 'studentinquiry.edit')): ?> active <?php endif; ?>"
                                        data-key="t-crm">
                                        <i class="fa fa-question-circle"></i> Student Registration </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?php echo e(route('student.index')); ?>" class="nav-link menu-link "
                                        data-key="t-crm">
                                        <i class="fas fa-user-clock"></i>Student Waitlist</a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?php echo e(route('student.register_student')); ?>" class="nav-link menu-link 
                                    <?php if(request()->routeIs('student.register_student', 'student.view', 'student.edit')): ?> active <?php endif; ?>"
                                        data-key="t-crm">
                                        <i class="fas fa-address-card"></i>Pending Student</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('student.active_student')); ?>" class="nav-link menu-link 
                                    <?php if(request()->routeIs('student.active_student', 'student.active_student_view')): ?> active <?php endif; ?>"
                                        data-key="t-crm">
                                        <i class="fas fa-credit-card"></i>Active Student</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('renewPlan.renew_plan')); ?>" class="nav-link menu-link 
                                 <?php if(request()->routeIs('renewPlan.renew_plan', 'renewPlan.edit_renew_student')): ?> active <?php endif; ?>"
                                        data-key="t-crm">
                                        <i class="fas fa-credit-card"></i>Renew Student Plan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('student.inactive_student')); ?>" class="nav-link menu-link 
                                 <?php if(request()->routeIs('student.inactive_student')): ?> active <?php endif; ?>"
                                        data-key="t-crm">
                                        <i class="fas fa-credit-card"></i>Inactive Student</a>
                                </li>
                                

                            </ul>
                        </div>
                    </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('attendance.index')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(route('attendance.index')); ?>">
                        <i class="fas fa-calendar-check"></i> <!-- Attendance or event tracking -->
                        <span data-key="t-subscription">Student Attendance</span>
                    </a>
                </li> 
                <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(in_array(request()->route()->getName(), ['report.upcoming_renew','report.attendance_report','report.upcoming_view']) ? 'active' : 'collapsed'); ?>"  href="#reportsidebar" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo e(in_array(request()->route()->getName(), ['report.upcoming_renew','report.attendance_report','report.upcoming_view']) ? 'true' : 'false'); ?>"
                            aria-controls="reportsidebar">
                            <i class="fas fa-file-alt"></i>
                            <span data-key="t-dashboards">Report</span>
                        </a>
                        <div class="menu-dropdown collapse <?php echo e(in_array(request()->route()->getName(), ['report.upcoming_renew','report.attendance_report','report.upcoming_view']) ? 'show' : ''); ?>

                        " id="reportsidebar" style="">
                            <ul class="nav nav-sm flex-column">
                               
                                <li class="nav-item">
                                    <a href="<?php echo e(route('report.upcoming_renew')); ?>" class="nav-link menu-link
                                    <?php if(request()->routeIs('report.upcoming_renew', 'report.upcoming_view')): ?> active <?php endif; ?>"
                                        data-key="t-crm">
                                    <i class="fa-solid fa-font-awesome"></i>Upcoming Renewal</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('report.attendance_report')); ?>" class="nav-link menu-link <?php if(request()->routeIs('report.attendance_report')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                                        data-key="t-crm">
                                    <i class="fa-solid fa-font-awesome"></i>Attendance Report</a>
                                </li>
                            </ul>
                        </div>
                    </li>  
                 <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('gallery.index')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(route('gallery.index')); ?>">
                        <i class="fas fa-image"></i>
                        <span data-key="t-subscription">Gallery</span>

                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('banner.index')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(route('banner.index')); ?>">
                        <i class="fas fa-images"></i>
                        <span data-key="t-subscription">Banner</span>

                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('popupImage.image')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(route('popupImage.image')); ?>">
                        <i class="far fa-file-image"></i>
                        <span data-key="t-subscription">Popup Image</span>

                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('events.index', 'events.create', 'events.edit')): ?> active <?php endif; ?>"
                        href="<?php echo e(route('events.index')); ?>">
                        <i class="fas fa-gifts"></i>
                        <span data-key="t-subscription">Events</span>
                    </a>
                </li>  
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('ebook.index')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(route('ebook.index')); ?>">
                        <i class="fas fa-book"></i>
                        <span data-key="t-subscription">E-Book</span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('Inquiry.index')): ?> <?php echo e('active'); ?> <?php endif; ?>"
                        href="<?php echo e(route('Inquiry.index')); ?>">
                       <i class="fa fa-users"></i>
                        <span data-key="t-users">Ebook Member Data </span>
                    </a>
                </li>   -->
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('testimonial.index', 'testimonial.create', 'testimonial.edit')): ?> active <?php endif; ?>"
                        href="<?php echo e(route('testimonial.index')); ?>">
                       <i class="fa fa-quote-left"></i>
                        <span data-key="t-subscription">Testimonial </span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('trialClass.index', 'trialClass.view')): ?> active <?php endif; ?>"
                        href="<?php echo e(route('trialClass.index')); ?>">
                       <i class="fas fa-users"></i>
                        <span data-key="t-subscription">Trial Class </span>
                    </a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('service.index', 'service.create','service.edit','service.images')): ?> active <?php endif; ?>"
                        href="<?php echo e(route('service.index')); ?>">
                       <i class="fa fa-cog"></i>
                        <span data-key="t-subscription">Service </span>
                    </a>
                </li>  
                  <li class="nav-item">
                    <a class="nav-link menu-link <?php if(request()->routeIs('page.index', 'page.edit')): ?> active <?php endif; ?>
                        "
                        href="<?php echo e(route('page.index')); ?>">
                       <i class="fas fa-file-alt"></i>
                        <span data-key="t-subscription">Page </span>
                    </a>
                </li>  
               
            <?php endif; ?>

            </ul>   
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/common/sidebar.blade.php ENDPATH**/ ?>