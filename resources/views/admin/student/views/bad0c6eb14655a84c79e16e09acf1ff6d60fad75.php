<?php $__env->startSection('title', 'Add Service'); ?>

<?php $__env->startSection('content'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Service</h4>
                        <div class="page-title-right">
                            <a href="<?php echo e(route('service.index')); ?>"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        
                        <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="card-body">
                             <form method="POST" action="<?php echo e(route('service.store')); ?>" autocomplete="off" enctype="multipart/form-data" id="service_add">
                                <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('service_name') ? 'has-error' : ''); ?>">
                                                <label for="service_name">Service Name <span style="color:red">*</span></label>
                                                <input type="text" id="service_name" name="service_name" class="form-control" value="<?php echo e(old('service_name')); ?>" maxlength="100" required>
                                                <?php if($errors->has('service_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('service_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('image') ? 'has-error' : ''); ?>">
                                                <label for="image">Service Image<span style="color:red">*</span></label>
                                                <input type="file" id="image" name="image" class="form-control" onchange="return validateFile()" required>  
                                                <?php if($errors->has('image')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('image')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                       

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
                                                <label for="descriptionmm">Description<span style="color:red">*</span></label>
                                                <textarea class="form-control ckeditor" name="description" id="descriptionmm" required></textarea>
                                                <?php if($errors->has('description')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('description')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                    </div>  
                                    
                                <div class="mt-4">
                                     <input class="btn btn-success btn-user float-right" type="submit" value="<?php echo e('Submit'); ?>">
                                     <input class="btn btn-success btn-user float-right" type="reset" value="<?php echo e('Clear'); ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script type="text/javascript">
     function validateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('image').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('image').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#image').val("")
                }
                return isValidFile;
            }

            return true;
        }
        $("#service_add").validate({
        rules: {
            service_name: {
                required: true,
            },
            image: {
                required: true,
            },
            description: {
                required: true,
            },
            
        },
        messages: {
            service_name: {
                required: "Please Enter Service Name",
            },
            image: {
                required: "Please Select Image",
            },
            description: {
                required: "Please Enter Description",
            },
         
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
            
        }
    });
         </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/service/add.blade.php ENDPATH**/ ?>