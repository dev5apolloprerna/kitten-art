
<?php $__env->startSection('content'); ?>
<!-- BOM Start  -->

<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Login</h2>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>
                        </li>
                        <li>Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
                
<section class="login-area ptb-100">
            <div class="container">
                <div class="login-form">
                    <h2>New Password</h2>
<?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <form id="myForm" action="<?php echo e(route('newpasswordsubmit')); ?>" method="post" class="form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="token"value="<?php echo e($token); ?>">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label>New Password<span style="color:red">*</span></label>
                                             <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Enter New Password"
                                                id="sfpassword" required>
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
                                        </div>  
                                       
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label>Confirm Password<span style="color:red">*</span></label>
                                           <input type="password" name="confirmpassword" class="form-control" placeholder="Enter Confirm Password"
                                                id="ccpassword" required>
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
                                        </div>
                                        <?php $__errorArgs = ['password'];
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
                                  </div>
                                  
                                  <div class="col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    
</section>
<!--/ End Contact -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/newpassword.blade.php ENDPATH**/ ?>