<?php $__env->startSection('content'); ?>
<?php 
     $id=session()->get('student_id');
     $name=session()->get('student_name');
?>

<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Change Password</h2>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>
                        </li>
                        <li>Change Password</li>
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
                        <a href="<?php echo e(route('student_profile')); ?>" >Student Profile</a>
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
                        <a href="<?php echo e(route('changepassword')); ?>" class="active">Change Password</a>
                    </li>
                     <li>
                        <a href="<?php echo e(route('FrontStudentLogout')); ?>">Logout</a>
                    </li>
                </ul>
            </div>
                                    

            <div class="col-lg-9">
                <div class="section-title">
                    <span>Change Password</span>
                    <!--<h2>Student </h2>-->
                </div>

                <div class="event-box-item">
                    <div class="row align-items-center">
					<form action="<?php echo e(route('changepasswordsubmit')); ?>" method="post" class="form" >
         					<?php echo csrf_field(); ?>
						<div class="form-group mb-2">
							Current Password<span style="color:red";>*</span>
							<input  type="password" class="form-control" placeholder="Enter Current Password" name="current_password">
						</div>

						<div class="form-group mb-2">
							New Password<span style="color:red";>*</span>
							<input type="password" class="form-control" placeholder="Enter New Password" name="newpassword">
						</div>
						 <?php $__errorArgs = ['newpassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		                    <span class="text-danger">
		                        <strong><?php echo e($message); ?></strong>
		                    </span>
		                	<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
               				
						<div class="form-group mb-2">
							Confirm Password<span style="color:red";>*</span>
							<input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirmpassword">
						</div>
						<?php $__errorArgs = ['confirmpassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		                    <span class="text-danger">
		                        <strong><?php echo e($message); ?></strong>
		                    </span>
		                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
					<button type="submit" class="default-btn"> Submit Now </button>
            		</form>
       		   </div>
  			</div>
		</div>
	 </div>
	</div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/changepassword.blade.php ENDPATH**/ ?>