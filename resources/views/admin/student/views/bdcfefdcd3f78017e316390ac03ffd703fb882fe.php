<?php $__env->startSection('title', 'Add Student Plan'); ?>



<?php $__env->startSection('content'); ?>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">



<div class="main-content">

    <div class="page-content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0">Add Student Plan</h4>

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

                        

                        <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



                        <div class="card-body">

                            <form action="<?php echo e(route('plan.store')); ?>" method="POST" enctype="multipart/form-data" id="planForm">

                                <?php echo csrf_field(); ?>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group <?php echo e($errors->has('category_id') ? 'has-error' : ''); ?>">

                                                <label for="category_id">Category Name <span style="color:red">*</span></label>

                                                <select class="form-control" name="category_id" id="category_idd" required>

                                                    <option value="">select category</option>

                                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <option value="<?php echo e($c->category_id); ?>"><?php echo e($c->category_name); ?></option>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>

                                            </div> 

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group <?php echo e($errors->has('plan_name') ? 'has-error' : ''); ?>">

                                                <label for="plan_name">Plan Name <span style="color:red">*</span></label>

                                                <input type="text" id="plan_name" name="plan_name" class="form-control" value="<?php echo e(old('plan_name')); ?>" placeholder="Enter Plan Name" maxlength="50" required>

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

                                                <input type="text" id="plan_session" name="plan_session" class="form-control" value="<?php echo e(old('plan_session')); ?>" placeholder="Enter Plan Session" maxlength="11" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

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

                                                <input type="text" id="plan_amount" name="plan_amount" class="form-control" value="<?php echo e(old('plan_amount')); ?>" placeholder="Enter Plan Amount" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

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

                                                <input type="file" id="plan_image" name="plan_image" placeholder="Eneter Plan Image" class="form-control" value="<?php echo e(old('plan_image')); ?>" onchange="return validateFile()" required>

                                                <?php if($errors->has('plan_image')): ?>

                                                    <span class="text-danger">

                                                        <?php echo e($errors->first('plan_image')); ?>


                                                    </span>

                                                <?php endif; ?>

                                            </div> 

                                        </div>



                                        <div class="col-md-12 mt-4">

                                            <div class="form-group <?php echo e($errors->has('plan_description') ? 'has-error' : ''); ?>">

                                                <label for="plan_descriptionn"> Plan Description <span style="color:red">*</span></label>

                                                <textarea id="plan_descriptionn" rows="10" cols="10" name="plan_description" class="form-control ckeditor" value="<?php echo e(old('plan_description')); ?>" required></textarea>

                                                <?php if($errors->has('plan_description')): ?>

                                                    <span class="text-danger">

                                                        <?php echo e($errors->first('plan_description')); ?>


                                                    </span>

                                                <?php endif; ?>

                                            </div> 

                                        </div>

                                    </div> 



                                    <div class="col-md-12 mt-4">

                                            <div class="form-group <?php echo e($errors->has('detail_description') ? 'has-error' : ''); ?>">

                                                <label for="detail_descriptionn"> Detail Description <span style="color:red">*</span></label>

                                                <textarea id="detail_descriptionn" rows="10" cols="10" name="detail_description" class="form-control ckeditor" value="<?php echo e(old('detail_description')); ?>" required></textarea>

                                                <?php if($errors->has('detail_description')): ?>

                                                    <span class="text-danger">

                                                        <?php echo e($errors->first('detail_description')); ?>


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
$("#planForm").validate({
        rules: {
            category_id: {
                required: true,
            },
            plan_name: {
                required: true,
            },
            plan_image: {
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
            plan_image: {
                required: "Please Select Plan Image",
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/plan/add.blade.php ENDPATH**/ ?>