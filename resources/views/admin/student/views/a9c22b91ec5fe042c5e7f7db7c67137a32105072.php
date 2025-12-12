<?php $__env->startSection('title', 'Add Testimonial'); ?>

<?php $__env->startSection('content'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Testimonial</h4>
                        <div class="page-title-right">
                            <a href="<?php echo e(route('testimonial.index')); ?>"
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
                             <form method="POST" action="<?php echo e(route('testimonial.store')); ?>" autocomplete="off" enctype="multipart/form-data" id="testimonial_add">
                                <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('parent_name') ? 'has-error' : ''); ?>">
                                                <label for="parent_name">Parent Name <span style="color:red">*</span></label>
                                                <input type="text" id="parent_name" name="parent_name" class="form-control" value="<?php echo e(old('parent_name')); ?>" maxlength="100" required>
                                                <?php if($errors->has('parent_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('parent_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('parent_photo') ? 'has-error' : ''); ?>">
                                                <label for="parent_photo">Parent Image<span style="color:red"></span></label>
                                                <input type="file" id="parent_photo" name="parent_photo" class="form-control" onchange="return validateFile1()">  
                                                <?php if($errors->has('parent_photo')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('parent_photo')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                       

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('student_name') ? 'has-error' : ''); ?>">
                                                <label for="student_name">Student Name <span style="color:red">*</span></label>
                                                <input type="text" id="student_name" name="student_name" class="form-control" value="<?php echo e(old('student_name')); ?>" maxlength="100">
                                                <?php if($errors->has('student_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('student_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                       <div class="col-md-6 mt-4">
                                        <div class="form-group <?php echo e($errors->has('student_photo') ? 'has-error' : ''); ?>">
                                            <label for="student_photo">Student Image<span style="color:red"></span></label>
                                            <input type="file" id="student_photo" name="student_photo" class="form-control" onchange="return validateFile()">  
                                            <?php if($errors->has('student_photo')): ?>
                                                <span class="text-danger">
                                                    <?php echo e($errors->first('student_photo')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div> 
                                    </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
                                                <label for="description">Description<span style="color:red">*</span></label>
                                                <textarea class="form-control" name="description"></textarea>
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
            var fileExtension = document.getElementById('student_photo').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('student_photo').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#student_photo').val("")
                }
                return isValidFile;
            }

            return true;
        }
         function validateFile2() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('parent_photo').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('parent_photo').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#parent_photo').val("")
                }
                return isValidFile;
            }

            return true;
        }
        $("#testimonial_add").validate({

        rules: {
            parent_name: {
                required: true,
            },
            student_name: {
                required: true,
            },
            
            description: {
                required: true,
            },
            
        },
        messages: {
             parent_name: {
                required: "Please Enter Parent Name",
            },
            student_name: {
                required: "Please Enter Student Name",
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/testimonial/add.blade.php ENDPATH**/ ?>