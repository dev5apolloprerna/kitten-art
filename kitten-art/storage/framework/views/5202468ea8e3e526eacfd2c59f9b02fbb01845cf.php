<?php $__env->startSection('content'); ?>

<?php
  $id=session()->get('student_id');
?>

<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Active Plan</h2>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>
                        </li>
                        <li>Current Active Plan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<!-- End Page Banner -->

<section class="event-area bg-ffffff pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 left-menu pt-70">
                <ul>
                    <li>
                        <a href="<?php echo e(route('student_profile')); ?>">Student Profile</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('student_dashboard')); ?>">Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('student_active_plan')); ?>" class="active">Current Active Plan</a>
                    </li>
                     <li>
                        <a href="<?php echo e(route('student_renew_plan')); ?>">Renew Plan</a>

                    </li>
                    <li>
                        <a href="<?php echo e(route('student_testimonial')); ?>">Add Testimonial</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('changepassword')); ?>">Change Password</a>
                    </li>
                     <li>
                        <a href="<?php echo e(route('FrontStudentLogout')); ?>">Logout</a>
                    </li>                   

                </ul>

            </div>

            <div class="col-lg-9">

                <div class="section-title">

                    <span>Current Active Plan</span>

                    <!-- <h2>Summer Camps</h2> -->

                </div>

                <div class="event-box-item">
                    <div class="row align-items-center">
                        <?php
                            $messageDisplayed = true;
                        ?>
                <?php $__currentLoopData = $active_plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($debit_balance != $plan1->total_session): ?>
                    <div class="card mb-5 p-2">
                    <div class="row align-items-center">
                        <!-- <div class="col-lg-4">
                            <div class="event-image">
                                <a href="#">
                                    <img src="<?php echo e(asset('plan_image') . '/' . $plan1->plan_image); ?>" alt="image"></a>
                            </div>
                        </div> -->

                        <div class="col-lg-6">
                            <div class="event-content">
                                <h3>
                                    <a href="#"><?php echo e($plan1->planName); ?></a>
                                </h3>
                                <ul class="event-list">
                                    <li>
                                         <i class="bi bi-person"></i>
                                        <?php echo e($plan1->categoryName); ?>

                                    </li>
                                    <li>
                                        <i class="fa fa-thin fa-child"></i>
                                        <?php echo e($plan1->batchname); ?>

                                    </li>

                                    <li>
                                        <i class="fa fa-thin fa-credit-card"></i>
                                        <?php echo e($plan1->plan_name); ?>

                                    </li>

                                    <li>
                                        <i class="bx bx-time"></i>
                                        <?php echo e(date('h:i a',strtotime($plan1->batch_from_time))); ?> - <?php echo e(date('h:i a',strtotime($plan1->batch_to_time))); ?>

                                    </li>

                                    <li>
                                        <i class="bx bx-dollar"></i>
                                        <?php echo e($plan1->amount); ?> - <?php echo e($plan1->total_session); ?> session
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </div>
                        </div>
                        <?php else: ?>
                        <?php
                            $messageDisplayed = false;
                            
                        ?>
                        <?php endif; ?>

                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!$messageDisplayed): ?>
                        <div class="event-content mb-5">
                            <ul class="event-list">
                                <li>
                                    No Current Active Plan Please Renew Plan 
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <!-- <div class="col-md-3">
                            <div class="event-date">
                                <h4></h4>
                                <span>                                   
                                <a  class="default-btn" data-bs-toggle="modal" data-bs-target="#ebookform">Renew Plan</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/student_plan.blade.php ENDPATH**/ ?>