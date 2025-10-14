<?php $__env->startSection('title', 'Edit Student Plan'); ?>

<?php $__env->startSection('content'); ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                
                <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Student Plan</h4>
                            <div class="page-title-right">
                                <a href="<?php echo e(route('plan.index')); ?>"
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
                            <div class="card-body">
                                    <form action="<?php echo e(route('plan.update', $data['planId'])); ?>" method="POST" enctype="multipart/form-data" id="editplanForm">

                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="planId" id="planId" value="<?php echo e($data['planId']); ?>">
                                     <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group <?php echo e($errors->has('planName') ? 'has-error' : ''); ?>">
                                                <label for="planName">Category Name <span style="color:red">*</span></label>
                                                <select class="form-control" name="category_id" id="category_idd" required>
                                                    <option value="">select category</option>
                                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($c['category_id']); ?>" <?php echo e($data['category_id'] == $c['category_id'] ? 'selected' : ''); ?>><?php echo e($c['category_name']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group <?php echo e($errors->has('plan_name') ? 'has-error' : ''); ?>">
                                                <label for="plan_name">Plan Name <span style="color:red">*</span></label>
                                                <input type="text" id="plan_name" name="plan_name" class="form-control"  maxlength="50" value="<?php echo e($data['plan_name']); ?>" placeholder="Enter Plan Name" required>
                                                <?php if($errors->has('plan_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('plan_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('plan_session') ? 'has-error' : ''); ?>">
                                                <label for="plan_session">Plan Session <span style="color:red">*</span></label>
                                                <input type="text" id="plan_session" name="plan_session" class="form-control"  maxlength="11" placeholder="Enter Plan Session" value="<?php echo e($data['plan_session']); ?>"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                <?php if($errors->has('plan_session')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('plan_session')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                         
                                         <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('plan_amount') ? 'has-error' : ''); ?>">
                                                <label for="plan_amount">Plan Amount <span style="color:red">*</span></label>
                                                <input type="text" id="plan_amount" name="plan_amount" class="form-control"  maxlength="10" value="<?php echo e($data['plan_amount']); ?>" placeholder="Enter Plan Amount" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                <?php if($errors->has('plan_amount')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('plan_amount')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('plan_image') ? 'has-error' : ''); ?>">
                                                <label for="plan_image">Plan Image <span style="color:red">*</span></label>
                                                <input type="file" id="plan_image" name="plan_image" class="form-control" value="<?php echo e(old('plan_image')); ?>" onchange="return validateFile()">
                                                    <input type="hidden" name="hiddenImage" class="form-control"
                                                        value="<?php echo e(old('plan_image') ? old('plan_image') : $data['plan_image']); ?>"
                                                        id="hiddenImage">
                                                    <div id="viewimg">
                                                        <img src="<?php echo e(asset($data['plan_image'] ? 'plan_image/' . $data['plan_image'] : 'images/noImage.png')); ?>"
                                                            alt="" height="70" width="70">
                                                        <?php $__errorArgs = ['plan_image'];
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

                                                <?php if($errors->has('plan_image')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('plan_image')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group <?php echo e($errors->has('plan_description') ? 'has-error' : ''); ?>">
                                                <label for="plan_description"> Plan Description <span style="color:red">*</span></label>
                                                <textarea id="plan_description" rows="10" cols="10" name="plan_description" class="form-control ckeditor" value="<?php echo e(old('plan_description')); ?>" required><?php echo e($data['plan_description']); ?></textarea>
                                                <?php if($errors->has('plan_description')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('plan_description')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group <?php echo e($errors->has('detail_description') ? 'has-error' : ''); ?>">
                                                <label for="detail_description"> Detail Description <span style="color:red">*</span></label>
                                                <textarea id="detail_description" rows="10" cols="10" name="detail_description" class="form-control ckeditor" value="<?php echo e(old('detail_description')); ?>" required><?php echo e($data['detail_description']); ?></textarea>
                                                <?php if($errors->has('detail_description')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('detail_description')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                    </div>
                                        <div class="card-footer mt-2">
                                            <div class="mb-3" style="float: right;">
                                                <button type="submit"
                                                class="btn btn-success btn-user float-right" >Update</button>
                                                <a class="btn btn-primary float-right mr-3"
                                                    href="<?php echo e(route('plan.index')); ?>">Cancel</a>
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
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script type="text/javascript">
      function validateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('plan_image').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('plan_image').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#plan_image').val("")
                }
                return isValidFile;
            }

            return true;
        }
         $("#editplanForm").validate({
    ignore: "", // Include all form elements, even hidden ones

            rules: {
            category_id: {
                required: true,
            },
            plan_name: {
                required: true,
            },
            plan_amount: {
                required: true,
            },
            plan_session: {
                required: true,
            },
            plan_description: {
                required: true,
            },detail_description: {
                required: true,
            },
           
        },
        messages: {
            category_id: {
                required: "Please Select Category",
            },
            plan_name: {
                required: "Please Enter Plan Name",
            },
            
             plan_session: {
                required: "Please Enter Plan Session",
            },plan_amount: {
                required: "Please Enter Plan Amount",
            },
            plan_description: {
                required: "Please Enter Plan Description",
            }, detail_description: {
                required: "Please Enter Detail Description",
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/plan/edit.blade.php ENDPATH**/ ?>