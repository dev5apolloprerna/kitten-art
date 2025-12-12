<?php $__env->startSection('content'); ?>

<!-- Start Page Banner -->

<div class="page-banner-area item-bg4">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-banner-content">

                    <h2>Student Profile</h2>

                    <ul>

                        <li>

                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>

                        </li>

                        <li>Student Profile</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Page Banner -->

<section class="event-area bg-ffffff pt-100 pb-70">

    <div class="container">

        <div class="row">

            <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="col-lg-3 left-menu pt-70">

                <ul>

                    <li>

                        <a href="<?php echo e(route('student_profile')); ?>" class="active">Student Profile</a>

                    </li>

                    <li>

                        <a href="<?php echo e(route('student_dashboard')); ?>" >Dashboard</a>

                    </li>

                    <li>

                        <a href="<?php echo e(route('student_active_plan')); ?>">Current Active Plan</a>

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

                    <span>Student Profile</span>

                    <!--<h2>Student </h2>-->

                </div>



                <div class="event-box-item">

                    <div class="row align-items-center">

                         <table class="datatable table table-hover">
                                <tr>
                                    <th>Student Name</th>    
                                    <td><?php echo e($Student->student_first_name); ?> <?php echo e($Student->student_Last_name); ?></td>
                                </tr> 
                                <tr>
                                    <th>Parent Name</th>    
                                    <td><?php echo e($Student->parent_name); ?></td>
                                </tr>                 
                                <tr>
                                    <th>Student Age</th>    
                                    <td><?php echo e($Student->student_age); ?></td>
                                </tr>                  
                                <tr>
                                    <th>Mobile</th>    
                                    <td><?php echo e($Student->mobile); ?></td>
                                </tr>     
                                <tr>
                                    <th>Email</th>    
                                    <td><?php echo e($Student->email); ?></td>
                                </tr>      
                                <tr>
                                    <th>Contact Preference</th>    
                                    <td><?php if($Student->communication_mode == 1): ?>
                                        <?php echo e('Whats App'); ?>

                                        <?php elseif($Student->communication_mode == 2): ?>
                                        <?php echo e('Email'); ?>

                                        <?php elseif($Student->communication_mode == 3): ?>
                                        <?php echo e('Text SMS'); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>                  
                            
                        </table>

             </div>

         </div>

     </div>

 </div>

 </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">

      document.querySelector('input[name="student_age"]').addEventListener('input', function (e) {

    if (this.value < 0) {

      this.value = 0;

    }

  });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/user_profile.blade.php ENDPATH**/ ?>