<?php $__env->startSection('content'); ?>

<!-- Start Page Banner -->

<div class="page-banner-area item-bg4">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-banner-content">

                    <h2>Student Detail</h2>

                    <ul>

                        <li>

                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>

                        </li>

                        <li>Student Detail</li>

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

                        <a href="<?php echo e(route('student_renew_plan')); ?>" class="active">Renew Plan</a>

                    </li>

                    <li>

                        <a href="<?php echo e(route('student_testimonial')); ?>" >Add Testimonial</a>

                    </li>

                    <li>

                        <a href="<?php echo e(route('changepassword')); ?>">Change Password</a>

                    </li>

                     <li>

                        <a href="<?php echo e(route('FrontStudentLogout')); ?>">Logout</a>

                    </li>

                </ul>

            </div>

                                    



            <div class="col-lg-9">

                <div class="section-title">

                    <span>Renew Subscription</span>

                    <!--<h2>Student </h2>-->

                </div>



                <div class="event-box-item">

                    <div class="row align-items-center">



            <form method="post" action="<?php echo e(route('student_submit_renew_plan')); ?>">

                        <?php echo csrf_field(); ?>

            <input type="hidden" name="student_id"  id="student_id"value="<?php echo e($id); ?>">

            <input type="hidden"  id="batchId" value="<?php echo e($plan->batch_id); ?>">

            <input type="hidden"  id="planId" value="<?php echo e($plan->plan_id); ?>">


                      <div class="form-group py-2"><label>Category Name <span style="color:red;">*</span></label>

              <select class="form-control"  name="category_id" id="category_id" required>

                <option value="">Select Class *</option>

                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($c->category_id); ?>" <?php echo e($plan->category_id == $c->category_id ? 'selected' : ''); ?>><?php echo e($c->category_name); ?></option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </select>

            </div>

            <div class="form-group py-2"><label>Plan Name <span style="color:red;">*</span></label>

              <select class="form-control" name="plan_id" id="plan_id" required>

                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($plan->planId); ?>" <?php echo e($plan->plan_id == $plan->planId ? 'selected' : ''); ?>>

                        <?php echo e($plan->plan_name); ?>


                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            </div>

            <div class="form-group py-2"><label>Batch Name <span style="color:red;">*</span></label>

              <select class="form-control" name="batch_id" id="batch_id" required>

                <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($batch->batch_id); ?>" <?php echo e($plan->batch_id == $batch->batch_id ? 'selected' : ''); ?>>

                            <?php echo e($batch->batch_name); ?> 

                        </option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            </div>

            <div class="form-group py-2"><label>Plan Amount <span style="color:red;">*</span></label>

                <input type="text" value="" name="amount" id="amount" class="form-control" readonly> 

            </div>

            <div class="form-group py-2"><label>Plan Session <span style="color:red;">*</span></label>

                <input type="text" value="" name="plan_session" id="plan_session" class="form-control" readonly> 

            </div>



                     <button type="submit" class="default-btn"> Submit Now </button>

                 </form>

             </div>

         </div>

     </div>

 </div>

 </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>

<script>

    $(document).ready(function() 

    {

            var selectedCategoryId = $('#category_id').val(); // Get selected category ID from the dropdown

    var selectedBatchId = $('#batchId').val(); // Add a custom attribute for selected batch ID

    var selectedPlanId = $('#planId').val(); // Add a custom attribute for selected plan ID



    // Function to fetch and populate the batch dropdown

    function fetchBatches(categoryid, selectedBatchId) {

        $.ajax({

            url: './get-batch/' + categoryid,

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

    function fetchPlans(categoryid, selectedPlanId) 

    {

        $.ajax({

            url: './get-plan/' + categoryid,

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



         $.ajax({

                    url: './get-plan-amount/' + selectedPlanId,

                    type: "GET",

                    dataType: "json",

                    success: function(data) {

                        console.log('Response:', data);

                        $('#amount').val(data.plan_amount);

                        $('#plan_session').val(data.plan_session);

                    },

                    error: function(xhr, status, error) {

                        console.error("Error:", error);

                    }

                });

    }



    $('#plan_id').change(function() 

        { 

                var plan_id = $(this).val();

                

                $.ajax({

                    url: './get-plan-amount/' + plan_id,

                    type: "GET",

                    dataType: "json",

                    success: function(data) {

                        console.log('Response:', data);

                        $('#amount').val(data.plan_amount);

                        $('#plan_session').val(data.plan_session);

                    },

                    error: function(xhr, status, error) {

                        console.error("Error:", error);

                    }

                });

            });





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

            /*$('#category_id').change(function() 

            {

                var categoryid = $(this).val();

                if(categoryid) 

                {

                    $.ajax({

                        url: './get-batch/' + categoryid,

                        type: "GET",

                        dataType: "json",

                        success:function(data) {

                            $('#batch_id').empty();

                            $('#batch_id').append('<option value="">Select Batch</option>');

                            $.each(data, function(key, value) {

                            const weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];



                            $('#batch_id').append('<option value="'+ value.batch_id +'">'+ weekdays[value.batch_day - 1] +'</option>');

                            });

                        }

                    });





                    $.ajax({

                        url: './get-plan/' + categoryid,

                        type: "GET",

                        dataType: "json",

                        success:function(data) {

                            $('#plan_id').empty();

                            $('#plan_id').append('<option value="">Select Plan</option>');

                            $.each(data, function(key, value) {

                                $('#plan_id').append('<option value="'+ value.planId +'">'+ value.plan_name +'</option>');

                            });

                        }

                    });

                } else {

                    $('#plan_id').empty();

                    $('#plan_id').append('<option value="">Select Batch</option>');

                }

            });

        });

        

        $('#plan_id').change(function() 

        {

                var plan_id = $(this).val();

                console.log('Selected Plan ID:', plan_id);

                

                $.ajax({

                    url: './get-plan-amount/' + plan_id,

                    type: "GET",

                    dataType: "json",

                    success: function(data) {

                        console.log('Response:', data);

                        $('#amount').val(data.plan_amount);

                        $('#plan_session').val(data.plan_session);

                    },

                    error: function(xhr, status, error) {

                        console.error("Error:", error);

                    }

                });

            });*/



    

        

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/student_renew_plan.blade.php ENDPATH**/ ?>