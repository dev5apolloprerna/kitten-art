<?php $__env->startSection('content'); ?>

 <style type="text/css">
     .readonly {
    pointer-events: none; /* Prevent clicking */
    background-color: #f1f1f1; /* Light gray background */
    color: #666; /* Dim text color */
}

 </style>
 <body>
  <div class="loading" style="display:none"></div>
</body>
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



                    <h2>Forgot Password</h2>

                    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



                    <form action="<?php echo e(route('forgotpasswordsubmit')); ?>" method="post" id="forgot_password">

                        <?php echo csrf_field(); ?>



                        <div class="form-group">

                            <label>Email <span style="color:red">*</span></label>

                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Register Email" required>

                        </div>



                        <button type="submit">Send Mail</button>

                    </form>



                    <div class="important-text">

                        <p>Don't have an account? <a href="<?php echo e(route('FrontRegistration')); ?>">Register now!</a></p>

                    </div>

                </div>

            </div>

        </section>
            <div id="loader-overlay"></div>
    <div id="loader">
        <div class="spinner"></div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script type="text/javascript">
    $("#forgot_password").validate({
        rules: {
            email: {
                required: true,
            }
        },
        messages: {
            email: {
                required:"Please Enter Email Address",
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.css("color", "red"); // Set error message color to red
        },
        submitHandler: function (form) {
            form.submit();
            $('section').addClass('blurred'); // Blur the page
            $('#loader-overlay').show();   // Show overlay
            $('#loader').show();           // Show spinner
            
            // Simulate processing delay
            setTimeout(() => {
                this.submit(); // Submit the form
            }, 2000);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/forgotpassword.blade.php ENDPATH**/ ?>