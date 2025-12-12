<?php 
  $id=session()->get('student_id');
  $name=session()->get('student_name');
?>

<div class="navbar-area">
      <div class="main-responsive-nav">
        <div class="container-fluid">
          <div class="main-responsive-menu">
            <div class="logo">
              <a href="<?php echo e(route('FrontIndex')); ?>">
                <img src="<?php echo e(asset('front/assets/images/logo.png')); ?>" class="black-logo" alt="image">
                <!-- <img src="assets/images/logo.png" class="white-logo" alt="image"> -->
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="main-navbar">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-md navbar-light">
            <a class="navbar-brand" href="<?php echo e(route('FrontIndex')); ?>">
              <img src="<?php echo e(asset('front/assets/images/logo.png')); ?>" class="black-logo" alt="image" width="140px">
              <!-- <img src="assets/images/logo.png" class="white-logo" alt="image" width="140px"> -->
            </a>
            <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="<?php echo e(route('FrontIndex')); ?>" class="nav-link <?php if(request()->routeIs('FrontIndex')): ?> <?php echo e('active'); ?> <?php endif; ?>"> Home </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('FrontAbout')); ?>" class="nav-link <?php if(request()->routeIs('FrontAbout')): ?> <?php echo e('active'); ?> <?php endif; ?>"> About us </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('FrontClass')); ?>" class="nav-link <?php if(request()->routeIs('FrontClass')): ?> <?php echo e('active'); ?> <?php endif; ?>"> Classes <!--<i class="bx bx-chevron-down"></i>-->
                  </a>
                  <ul class="dropdown-menu">
                   
                    <li class="nav-item">
                  <a href="<?php echo e(asset('front/Supplies_List.pdf')); ?>" target="_blank" class="nav-link"> Supply List </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(asset('front/Payment_Info.pdf')); ?>" target="_blank" class="nav-link "> Payment Information </a>
                </li>
                  </ul>
                </li>
               <!--  <li class="nav-item">
                  <a href="<?php echo e(route('FrontEbooks')); ?>" class="nav-link <?php if(request()->routeIs('FrontEbooks')): ?> <?php echo e('active'); ?> <?php endif; ?>"> Ebooks </a>
                </li> -->

                <li class="nav-item">
                  <?php 
                      $Service = App\Models\Service::where(['service_id'=>2])->first();
                      ?>
                    <a href="<?php echo e(route('FrontServiceImages', $Service->slug)); ?>"
                       id="service-<?php echo e($Service->slug); ?>"
                       class="nav-link <?php if(request()->routeIs('FrontServiceImages') && request()->route('id') == 'paint-party'): ?> active <?php endif; ?>">
                        <?php echo e($Service->service_name); ?>

                    </a>
                    <!--<i class="bx bx-chevron-down"></i>--> </a>
                  <!--<ul class="dropdown-menu">
                    <?php
                      $Event = App\Models\Events::orderBy('event_name', 'asc')->get();
                     ?>
                     <?php $__currentLoopData = $Event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                      <a href="<?php echo e(route('FrontEventsDetail',$e->event_id)); ?>" class="nav-link "> <?php echo e($e->event_name); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>-->
                </li>
                <!-- <li class="nav-item">
                  <a href="#" class="nav-link <?php if(request()->routeIs('FrontServiceImages') && request()->route('id') != 'paint-party'): ?> <?php echo e('active'); ?> <?php endif; ?>"> Service <i class="bx bx-chevron-down"></i></a>
                  <ul class="dropdown-menu">
                    <?php
                      $Service = App\Models\Service::where('service_id','!=',2)->orderBy('service_name', 'asc')->get();
                     ?>
                     <?php $__currentLoopData = $Service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                      <a href="<?php echo e(route('FrontServiceImages',$e->slug)); ?>" class="nav-link "> <?php echo e($e->service_name); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </li>  -->
                <li class="nav-item">
                  <a href="<?php echo e(route('FrontGallery')); ?>" class="nav-link <?php if(request()->routeIs('FrontGallery')): ?> <?php echo e('active'); ?> <?php endif; ?>"> Gallery </a>
                </li>
               <li class="nav-item">
                  <a href="<?php echo e(route('FrontEventCalander')); ?>" class="nav-link <?php if(request()->routeIs('FrontEventCalander')): ?> <?php echo e('active'); ?> <?php endif; ?>"> Calendar </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('FrontContact')); ?>" class="nav-link <?php if(request()->routeIs('FrontContact')): ?> <?php echo e('active'); ?> <?php endif; ?>"> Contact </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo e(route('FrontTrialClass')); ?>" class="nav-link <?php if(request()->routeIs('FrontTrialClass')): ?> <?php echo e('active'); ?> <?php endif; ?>"> Free Trial Class </a>
                </li>
               
              </ul>
               
              <?php if(auth()->guard('student')->check()): ?>
                  <?php
                      $u = Auth::guard('student')->user();
                      $displayName = trim(($u->student_first_name ?? '').' '.($u->student_last_name ?? ''));
                      if ($displayName === '') {
                          $displayName = session('student_name'); // fallback if needed
                      }
                  ?>

                 <div class="others-options d-flex align-items-center" style="margin-right:10px">
                   <div class="option-item">
                    <a href="<?php echo e(route('student_profile')); ?>" class="default-btn">My Account</a>
                  </div>
                  <!--<div class="option-item">-->
                  <!--  <a href="<?php echo e(route('FrontStudentLogout')); ?>" class="">Logout</a>-->
                  <!--</div>-->
                </div>
              <?php else: ?>
                  <div class="others-options d-flex align-items-center" style="margin-right:10px">
                    <div class="option-item">
                      <a href="<?php echo e(route('FrontLogin')); ?>" class="default-btn">Student Login</a>
                    </div>
                  </div>
              <?php endif; ?>

              <div class="others-options d-flex align-items-center">
                <div class="option-item">
                  <a href="<?php echo e(route('FrontRegistration')); ?>" class="default-btn">Register Now</a>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
<?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/common/frontheader.blade.php ENDPATH**/ ?>