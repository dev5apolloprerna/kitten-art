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
                             <form method="POST" action="<?php echo e(route('service.update',$data['service_id'])); ?>" autocomplete="off" enctype="multipart/form-data" id="service_edit">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="service_id" value="<?php echo e($data['service_id']); ?>">
                               <div class="row">
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('service_name') ? 'has-error' : ''); ?>">
                                                <label for="service_name">Service Name <span style="color:red">*</span></label>
                                                <input type="text" id="service_name" name="service_name" class="form-control" value="<?php echo e($data['service_name']); ?>" maxlength="100" required>
                                                <input type="hidden" id="slug" name="slug" class="form-control" value="<?php echo e($data['slug']); ?>" maxlength="100" required>

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
                                                <input type="file" id="image" name="image" class="form-control" onchange="return validateFile()"> 
                                                <input type="hidden" name="hiddenImage" class="form-control"
                                                        value="<?php echo e(old('image') ? old('image') : $data['image']); ?>"
                                                        id="hiddenImage">
                                                    <div id="viewimg">
                                                        <img src="
                                                        <?php echo e(asset($data['image'] ? 'Service/' . $data['image'] : 'images/noImage.png')); ?>"
                                                        alt="" height="70" width="70">
                                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                <?php if($errors->has('image')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('image')); ?>

                                                    </span>
                                                <?php endif; ?> 
                                                <?php if($errors->has('image')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('image')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                       

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
                                                <label for="description">Description<span style="color:red">*</span></label>
                                                <textarea class="form-control ckeditor" name="description"><?php echo e($data['description']); ?></textarea>
                                                <?php if($errors->has('description')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('description')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                    </div> 
                                    
                                <div class="mt-4">
                                 <div class="card-footer mt-2">
                                        <div class="mb-3" style="float: right;">
                                            <button type="submit"
                                            class="btn btn-success btn-user float-right" >Update</button>
                                            <a class="btn btn-primary float-right mr-3"
                                                href="<?php echo e(route('service.index')); ?>">Cancel</a>
                                        </div>
                                    </div>
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
     $(document).ready(function()
            {
                  $('#service_name').on('input', function(){
                    var originalName = $(this).val();
                    var formattedName = originalName.replace(/\s+/g, '-');
                    $('#slug').val(formattedName);
                  });
            });
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
        $("#service_edit").validate({
            rules: {
            service_name: {
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/service/edit.blade.php ENDPATH**/ ?>