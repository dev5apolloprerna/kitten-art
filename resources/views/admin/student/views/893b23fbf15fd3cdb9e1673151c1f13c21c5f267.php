<?php $__env->startSection('content'); ?>
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
                    <h2>Login</h2>
 <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form action="<?php echo e(route('FrontStudentLogin')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <!-- <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username">
                        </div> -->

                        <div class="form-group">
                            <label>Login Id</label>
                            <input type="text" class="form-control" name="loginId" placeholder="Login Id">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="row align-items-center">
                           
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <button type="submit" class="default-btn w-50">Login</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password text-right">
                                <a href="<?php echo e(route('forgotpassword')); ?>" class="lost-your-password">Forgot your password?</a>
                            </div>

                        </div>

                        
                    </form>

                    <div class="important-text">
                        <p>Don't have an account? <a href="<?php echo e(route('FrontRegistration')); ?>">Register now!</a></p>
                    </div>
                </div>
            </div>
        </section>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/login.blade.php ENDPATH**/ ?>