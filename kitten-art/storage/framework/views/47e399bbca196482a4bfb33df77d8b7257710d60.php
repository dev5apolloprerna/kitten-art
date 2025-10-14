<?php $__env->startSection('title', 'Edit Student'); ?>

<?php $__env->startSection('content'); ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                
                <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Student</h4>
                            <div class="page-title-right">
                                <a href="<?php echo e(url()->previous()); ?>"
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
                                <form action="<?php echo e(route('studentinquiry.update', $data['student_inquiry_id'])); ?>" method="POST" enctype="multipart/form-data" id="student_inquiry_edit">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="student_inquiry_id" id="student_inquiry_id" value="<?php echo e($data['student_inquiry_id']); ?>">
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo e($errors->has('category_id') ? 'has-error' : ''); ?>">
                                                <label for="category_id">Category Name<span style="color:red">*</span></label>
                                                <select class="form-control"  name="category_id" id="category_id" required>
                                                    <option value="">select category  *</option>
                                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($c->category_id); ?>" <?php echo e($data['category_id'] == $c['category_id'] ? 'selected' : ''); ?>><?php echo e($c->category_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </select>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo e($errors->has('plan_id') ? 'has-error' : ''); ?>">
                                                <label for="plan_id">Plan<span style="color:red">*</span></label>
                                                <select class="form-control" name="plan_id" id="plan_id" required>
                                                    <option value="">select plan</option>
                                                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($plan->planId); ?>" <?php echo e($data['plan_id'] == $plan->planId ? 'selected' : ''); ?>>
                                                                <?php echo e($plan->plan_name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>
                                            </div> 
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group <?php echo e($errors->has('batch_id') ? 'has-error' : ''); ?>">
                                                <label for="batch_id">Batch <span style="color:red">*</span></label>
                                                <select class="form-control" name="batch_id" id="batch_id" required>
                                                    <option value="">select batch</option>
                                                   <?php
                                                        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                                    ?>

                                                    <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($batch->batch_id); ?>" <?php echo e($data['batch_id'] == $batch->batch_id ? 'selected' : ''); ?>>
                                                            <?php echo e($batch->batch_name); ?> 
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </option>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group <?php echo e($errors->has('student_first_name') ? 'has-error' : ''); ?>">
                                                <label for="student_first_name">Student First Name <span style="color:red">*</span></label>
                                                <input type="text" id="student_first_name" name="student_first_name" class="form-control"  placeholder="Enter Student Name" maxlength="100" value="<?php echo e($data['student_first_name']); ?>">
                                                <?php if($errors->has('student_first_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('student_first_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                         <div class="col-md-4 mt-4">
                                            <div class="form-group <?php echo e($errors->has('student_last_name') ? 'has-error' : ''); ?>">
                                                <label for="student_last_name">Student Last Name <span style="color:red">*</span></label>
                                                <input type="text" id="student_last_name" name="student_last_name" class="form-control"  placeholder="Enter Student Name" maxlength="100" value="<?php echo e($data['student_last_name']); ?>">
                                                <?php if($errors->has('student_last_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('student_last_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-4 mt-4">
                                            <div class="form-group <?php echo e($errors->has('student_age') ? 'has-error' : ''); ?>">
                                                <label for="student_age">Student Age <span style="color:red">*</span></label>
                                                <input type="number" id="student_age" name="student_age" class="form-control" placeholder="Enter Student Age" maxlength="2" value="<?php echo e($data['student_age']); ?>" required>
                                                <?php if($errors->has('student_age')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('student_age')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                         
                                         <div class="col-md-4 mt-4">
                                            <div class="form-group <?php echo e($errors->has('mobile') ? 'has-error' : ''); ?>">
                                                <label for="mobile">Mobile<span style="color:red">*</span></label>
                                                <input type="text" id="mobile" name="mobile" class="form-control" minlength="10" maxlength="10" placeholder="Enter  Mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?php echo e($data['mobile']); ?>"  required>
                                                <?php if($errors->has('mobile')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('mobile')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div> 
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group <?php echo e($errors->has('mobile') ? 'has-error' : ''); ?>">
                                                <label for="mobile">Email<span style="color:red">*</span></label>
                                                <input type="email" id="email" name="email" class="form-control" value="<?php echo e($data['email']); ?>" placeholder="Enter Email" maxlength="100" required>
                                                <?php if($errors->has('email')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('email')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                        
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group <?php echo e($errors->has('parent_name') ? 'has-error' : ''); ?>">
                                                <label for="parent_name">Parent Name <span style="color:red">*</span></label>
                                                <input type="text" id="parent_name" name="parent_name" class="form-control" value="<?php echo e($data['parent_name']); ?>"  placeholder="Enter Parent Name" maxlength="100" required>
                                                <?php if($errors->has('parent_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('parent_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group <?php echo e($errors->has('communication_mode') ? 'has-error' : ''); ?>">
                                                <label for="communication_mode">Communication Mode <span style="color:red">*</span></label>
                                                <select class="form-control" name="communication_mode" id="communication_mode" required>
                                                        <option value="">Select Mode</option>
                                                        <option value="1" <?php echo e($data['communication_mode'] == 1 ? 'selected' : ''); ?>>Whats App</option>
                                                        <option value="2" <?php echo e($data['communication_mode'] == 2 ? 'selected' : ''); ?>>Email</option>
                                                        <option value="3" <?php echo e($data['communication_mode'] == 3 ? 'selected' : ''); ?>>Text SMS</option>
                                                </select>
                                                <?php if($errors->has('communication_mode')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('communication_mode')); ?>

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
                                                    href="<?php echo e(route('student.index')); ?>">Cancel</a>
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
<script>
    $(document).ready(function() 
    {
            if($('#isPaid').val() == '1') {
                  // Disable the fields with the specified ids
                  $('#student_name').prop('disabled', true);
                  $('#student_age').prop('disabled', true);
                  $('#mobile').prop('disabled', true);
                  $('#email').prop('disabled', true);
                  $('#parent_name').prop('disabled', true);
                  $('#communication_mode').prop('disabled', true);
                }


                // Get initial values for category_id, batch_id, and plan_id
    var selectedCategoryId = $('#category_id').val(); // Get selected category ID from the dropdown
    var selectedBatchId = $('#batchId').val(); // Add a custom attribute for selected batch ID
    var selectedPlanId = $('#planId').val(); // Add a custom attribute for selected plan ID

    // Function to fetch and populate the batch dropdown
    function fetchBatches(categoryid, selectedBatchId) {
        $.ajax({
            url: '../get-batch/' + categoryid,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#batch_id').empty();
                $('#batch_id').append('<option value="">Select Batch</option>');
                $.each(data, function(key, value) {
                    const isSelected = value.batch_id == selectedBatchId ? 'selected' : '';
                    $('#batch_id').append('<option value="'+ value.batch_id +'" '+ isSelected +'>'+ value.batch_name +'</option>');
                });
            }
        });
    }

    // Function to fetch and populate the plan dropdown
    function fetchPlans(categoryid, selectedPlanId) {
        $.ajax({
            url: '../get-plan/' + categoryid,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#plan_id').empty();
                $('#plan_id').append('<option value="">Select Plan</option>');
                $.each(data, function(key, value) {
                    const isSelected = value.planId == selectedPlanId ? 'selected' : '';
                    $('#plan_id').append('<option value="'+ value.planId +'" '+ isSelected +'>'+ value.plan_name +'</option>');
                });
            }
        });
    }

    // Populate dropdowns on category change
    $('#category_id').change(function() {
        var categoryid = $(this).val();
        if (categoryid) {
            fetchBatches(categoryid, null); // No pre-selected value on change
            fetchPlans(categoryid, null);
        } else {
            $('#batch_id').empty().append('<option value="">Select Batch</option>');
            $('#plan_id').empty().append('<option value="">Select Plan</option>');
        }
    });

    // Populate dropdowns on page load if category_id has a value
    if (selectedCategoryId) {
        fetchBatches(selectedCategoryId, selectedBatchId);
        fetchPlans(selectedCategoryId, selectedPlanId);
    }
        });
    $("#student_inquiry_edit").validate({

 rules: {
            category_id: {
                required: true,
            },
            plan_id: {
                required: true,
            },
            batch_id: {
                required: true,
            },
            student_first_name: {
                required: true,
            },
             student_last_name: {
                required: true,
            },
            student_age: {
                required: true,
            },
            mobile: {
                required: true,
            },
            email: {
                required: true,
            },
            parent_name: {
                required: true,
            },
            communication_mode: {
                required: true,
            },
            
        },
        messages: {
            category_id: {
                required: "Please Select Category",
            },
            plan_id: {
                required: "Please Select Plan",
            },
            batch_id: {
                required: "Please Select Batch",
            },
            student_first_name: {
                required: "Please Enter Student First Name",
            },
             student_last_name: {
                required: "Please Enter Student Last Name",
            },
            student_age: {
                required: "Please Enter Student Age",
            },
            mobile: {
                required: "Please Enter Mobile No",
            },
            email: {
                required: "Please Enter Email",
            },
            parent_name: {
                required: "Please Enter Parent Name",
            },
            communication_mode: {
                required: "Please Select Communication Mode",
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/student_inquiry/edit.blade.php ENDPATH**/ ?>