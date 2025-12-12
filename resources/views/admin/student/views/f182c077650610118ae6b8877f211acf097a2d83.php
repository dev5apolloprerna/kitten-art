<?php $__env->startSection('title', 'Active Student List'); ?>

<?php $__env->startSection('content'); ?>



<?php $profileId = Request::segment(3);?>



    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">



                

                <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-header">

                                <h5 class="card-title mb-0">Active Student List



                                </h5>

                                

                            </div> 

                            <div class="card-body">

                                <form method="post" action="<?php echo e(route('student.active_student')); ?>" id="myForm">

                                    <?php echo csrf_field(); ?>

                                     <div class="row"> 

                                        <div class="col-md-4"> 

                                            <div class="form-group">

                                                <label for="name">Search By Batch Name</label>

                                                <select name="batch" id="batch" class="form-control"  > 

                                                    <option value="">Select Batch</option>

                                                    <?php $__currentLoopData = $batchdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <option value="<?php echo e($b->batch_id); ?>" <?php echo e($b->batch_id == $batch ? 'selected' : ''); ?>><?php echo e($b->batch_name); ?></option>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>   



                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <label for="name">Search By Student Name </label>

                                                <input type="text" name="search" id="search" class="form-control" value="<?php echo e($search ?? ''); ?>">

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                            <input class="btn btn-primary" style="margin-top: 10%;" type="submit" value="<?php echo e('Search'); ?>">

                                            <input class="btn btn-primary" style="margin-top: 10%;" type="submit" onclick="myFunction()" value="<?php echo e('Reset'); ?>">



                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div> 

                             <div class="row">

                                <div class="col-lg-12">

                                        <div class="card-body">

                                            <div class="table-responsive">

                                                <table class=" table table-bordered table-striped table-hover datatable">

                                                    <thead>

                                                        <tr class="text-center">

                                                            <th width="50"> Sr No </th>

                                                            <th> Student Name </th>  

                                                            <th> Mobile </th>  

                                                            <th> Email </th>  

                                                            <th> Student Age </th>  

                                                            <th> Category Name </th>  

                                                            <th> Plan Name </th>  

                                                            <th> Batch Name </th>  

                                                            <th> Amount </th>  

                                                            <th> Total Session </th>  

                                                            <th> Used Session </th>  

                                                            <th> Available Session </th>  
                                                            <th> Payment Date </th>  
                                                            <th> Payment Mode</th>  

                                                            <th width="90"> Action </th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                     <?php if(count($Student) > 0): ?>

                                                    <?php $i = 1;

                                                    ?>

                                                        <?php $__currentLoopData = $Student; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <tr data-entry-id="<?php echo e($sdata->student_id); ?>" class="text-center">

                                                                <td>

                                                                    <?php echo e($i + $Student->perPage() * ($Student->currentPage() - 1)); ?>


                                                                </td>

                                                                <td>
                                                                    <?php echo e($sdata->student_first_name ?? ''); ?> <?php echo e($sdata->student_last_name ?? ''); ?>

                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->mobile ?? ''); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->email ?? ''); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->student_age ?? ''); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->categoryName ?? '-'); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->planName ?? '-'); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->batchname ?? '-'); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->amount ?? '-'); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->total_session ?? '0'); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->debit_balance ?? '-'); ?>


                                                                </td>

                                                                <td>

                                                                    <?php echo e($sdata->total_session  - $sdata->debit_balance ?? '-'); ?>


                                                                </td>
                                                                <td>

                                                                    <?php echo e($sdata->payment_date ? date('d-m-Y', strtotime($sdata->payment_date)) : '-'); ?>


                                                                </td>
                                                                <td>

                                                                    <?php echo e($sdata->payment_mode ?? '-'); ?>


                                                                </td>
                                                                

                                                                <td>

                                                                    <div class="d-flex gap-2">

                                                                        <!--<a class="" title="Edit"

                                                                            href="<?php echo e(route('student.edit', $sdata->student_id)); ?>">

                                                                            <i class="far fa-edit"></i>

                                                                        </a>-->

                                                                        <a class="" href="#" data-bs-toggle="modal"

                                                                            title="Delete" data-bs-target="#deleteRecordModal"

                                                                            onclick="deleteData(<?= $sdata->student_id ?>);">

                                                                            <i class="fa fa-trash" aria-hidden="true"></i>

                                                                        </a>

                                                                        <a class="mx-1" title="change password" href="<?php echo e(route('student.changepassword', $sdata->student_id)); ?>">

                                                                            <i class="fa-solid fa-key"></i>

                                                                        </a>

                                                                        <a class="" title="View"

                                                                            href="<?php echo e(route('student.active_student_view', ['id' => $sdata->student_id, 'ctx' => 'inactive'])); ?>">

                                                                            <i class="fa fa-info"></i>
                                                                        </a>
                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Renew Plan Form" data-bs-target="#RenewModal_<?php echo e($sdata->student_id); ?>">
                                                                            <i class="fas fa-rotate-right"></i>
                                                                        </a>
                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Rewnew plan" data-bs-target="#renewModal"
                                                                            onclick="renewPlan(<?= $sdata->student_id ?>);">
                                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                                        </a>

                                                                    </div>

                                                                </td>

                                                            </tr>


                                                    <div class="modal fade zoomIn" id="renewModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                        id="btn-close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mt-2 text-center">
                                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                                                                        </lord-icon>
                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                            <h4>Are you Sure ?</h4>
                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want Send Renew Plan Request For This Student
                                                                                ?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <a class="btn btn-danger" id="confirm-payment" href="<?php echo e(route('logout')); ?>"
                                                                            onclick="event.preventDefault(); document.getElementById('request-form').submit();">
                                                                            Yes,
                                                                            Confirm It!
                                                                        </a>
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        
                                                                        <form id="request-form" method="POST" action="<?php echo e(route('renewPlan.create')); ?>">
                                                                            <?php echo csrf_field(); ?>
                                                                            <input type="hidden" name="student_id" id="renew_student_id" value="">


                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end modal -->

                                                    <div class="modal fade flip" id="RenewModal_<?php echo e($sdata->student_id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title" id="exampleModalLabel">Renew Student Plan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <form method="post" action="<?php echo e(route('renewPlan.admin_submit_renew_plan')); ?>">

                                                            <?php echo csrf_field(); ?> 

                                                            <input type="hidden" name="student_id"  id="student_id"value="<?php echo e($sdata->student_id); ?>"> 

                                                            <input type="hidden"  id="planId"value="<?php echo e($sdata->plan_id); ?>"> 

                                                            <input type="hidden"   id="batchId"value="<?php echo e($sdata->batch_id); ?>"> 
                                                    <div class="modal-body">
                                                                <div class="mb-3">
                                                            <div class="mb-3">
                                                              <select class="form-control"  name="category_id" id="category_id" required>

                                                                <option value="">Select Class *</option>

                                                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                    <option value="<?php echo e($c->category_id); ?>" <?php echo e($sdata->category_id == $c->category_id ? 'selected' : ''); ?>><?php echo e($c->category_name); ?></option>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                              </select>

                                                            </div>

                                                            <div class="mb-3">
                                                              <select class="form-control" name="plan_id" id="plan_id" required>

                                                                <option value="">select plan</option>

                                                            </select>

                                                            </div>

                                                            <div class="mb-3">
                                                              <select class="form-control" name="batch_id" id="batch_id" required>

                                                                <option value="">select batch</option>

                                                            </select>

                                                            </div>

                                                            <div class="mb-3">
                                                                <input type="text" value="" name="amount" id="amount" placeholder="Plan Amount" class="form-control" readonly> 

                                                            </div>

                                                            <div class="mb-3">
                                                                <input type="text" value="" name="plan_session" placeholder="Plan Session" id="plan_session" class="form-control" readonly> 

                                                            </div>
                                                        </div>


                                                         <div class="modal-footer">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="submit" class="btn btn-primary mx-2" id="add-btn">Submit</button>
                                                                    <button type="button" class="btn btn-primary mx-2"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                     </form>
                                                    </div>
                                                </div>
                                            </div>
                                                        <?php $i++; ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php else: ?>

                                                         <tr>

                                                            <td colspan="12">

                                                                <center>

                                                            No data Found

                                                        </center>

                                                            <td>



                                                        </tr>

                                                        <?php endif; ?>

                                                    </tbody>

                                                </table>

                                             <div class="d-flex justify-content-center mt-3">

                                                <?php echo e($Student->links()); ?>


                                            </div>

                                                <?php if(count($Student) > 0): ?>



                                                     <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">

                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">

                                                                <div class="modal-header">

                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"

                                                                        id="btn-close"></button>

                                                                </div>

                                                                <div class="modal-body">

                                                                    <div class="mt-2 text-center">

                                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"

                                                                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">

                                                                        </lord-icon>

                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">

                                                                            <h4>Are you Sure ?</h4>

                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record

                                                                                ?</p>

                                                                        </div>

                                                                    </div>

                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">

                                                                        <a class="btn btn-danger" href="<?php echo e(route('logout')); ?>"

                                                                            onclick="event.preventDefault(); document.getElementById('bus-delete-form').submit();">

                                                                            Yes,

                                                                            Delete It!

                                                                        </a>

                                                                        <button type="button" class="btn w-sm btn-light"

                                                                            data-bs-dismiss="modal">Close</button>

                                                                        

                                                                        <form id="bus-delete-form" method="POST" action="<?php echo e(route('student.delete')); ?>">

                                                                            <?php echo csrf_field(); ?>

                                                                            <?php echo method_field('DELETE'); ?>

                                                                            <input type="hidden" name="student_id" id="deleteid" value="">



                                                                        </form>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <!--end modal -->

                                                    <?php endif; ?>

                                                </div>

                                            </div>



                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>

        function deleteData(id) {

            $("#deleteid").val(id);

        }

        function myFunction() 

        {

            $('#search').removeAttr('value');

            $('#batch').val('');

        }

        function renewPlan(id) {
            $("#renew_student_id").val(id);
        }

 $(document).ready(function() 

{

    

  var selectedCategoryId = $('#category_id').val(); // Get selected category ID from the dropdown

    var selectedBatchId = $('#batchId').val(); // Add a custom attribute for selected batch ID

    var selectedPlanId = $('#planId').val(); // Add a custom attribute for selected plan ID



    // Function to fetch and populate the batch dropdown

    function fetchBatches(categoryid, selectedBatchId) {

        $.ajax({

            url: '../../get-batch/' + categoryid,

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

            url: '../../get-plan/' + categoryid,

            type: "GET",

            dataType: "json",

            success: function(data) {

                $('#plan_id').empty();

                $('#plan_id').append('<option value="">Select Plan</option>');

                $.each(data, function(key, value) 

                {

                    const isSelected = value.planId == selectedPlanId ? 'selected' : '';

                    $('#plan_id').append('<option value="'+ value.planId +'" '+ isSelected +'>'+ value.plan_name +'</option>');

                     $('#amount').val(value.plan_amount);

                    $('#plan_session').val(value.plan_session);



                });

            }

        });

    }

    function fetchPlanAmount(planId) {

        $.ajax({

            url: '../../get-plan-amount/' + planId,

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

    $('#plan_id').change(function() {

        var planId = $(this).val();

        if (planId) {

            // Fetch the plan amount when the plan is changed

            fetchPlanAmount(planId);

        }

    });



    // Populate dropdowns on page load if category_id has a value

    if (selectedCategoryId) {

        fetchBatches(selectedCategoryId, selectedBatchId);

        fetchPlans(selectedCategoryId, selectedPlanId);

    }

});


    </script>





<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/student/inactive_student.blade.php ENDPATH**/ ?>