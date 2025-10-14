<?php $__env->startSection('title', 'Pending Student List'); ?>
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
                                <h5 class="card-title mb-0">Pending Student List
                                    
                                </h5>
                                
                            </div> 
                            <div class="card-body">
                                <form method="post" action="<?php echo e(route('student.register_student')); ?>" id="myForm">
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
                                                <input type="text" name="search" id="search" placeholder="Search By Student Name" class="form-control" value="<?php echo e($search ?? ''); ?>">
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
                                                            <th> Action </th>
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
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit"
                                                                            href="<?php echo e(route('student.edit', $sdata->student_id)); ?>">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                        
                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Mark As Paid" data-bs-target="#paymentModal"
                                                                            onclick="paymentData(<?= $sdata->student_id ?>);">
                                                                            <i class="fa fa-dollar" aria-hidden="true"></i>
                                                                        </a>

                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $sdata->student_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>
                                                                       <!--  <a class="mx-1" title="change password" href="<?php echo e(route('student.changepassword', $sdata->student_id)); ?>">
                                                                            <i class="fa-solid fa-key"></i>
                                                                        </a> -->
                                                                        <a class="" title="View"
                                                                            href="<?php echo e(route('student.view', $sdata->student_id)); ?>">
                                                                            <i class="fa fa-info"></i>
                                                                        </a> 
                                                                       
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                         <tr>
                                                            <td colspan="10">
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
                                                                            onclick="event.preventDefault(); document.getElementById('student-delete-form').submit();">
                                                                            Yes,
                                                                            Delete It!
                                                                        </a>
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        
                                                                        <form id="student-delete-form" method="POST" action="<?php echo e(route('student.delete')); ?>">
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


                                                    <div class="modal fade zoomIn" id="paymentModal" tabindex="-1" aria-hidden="true">
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
                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Confirm this Student Payment
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
                                                                        
                                                                        <form id="request-form" method="POST" action="<?php echo e(route('student.updatepaid_student')); ?>">
                                                                            <?php echo csrf_field(); ?>
                                                                            <input type="hidden" name="student_request_id" id="paymentid" value="">


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
        function paymentData(id) {
            $("#paymentid").val(id);
        }
        function myFunction() 
        {
            $('#search').removeAttr('value');
            $('#batch').val('');
        }
$('#confirm-payment').click(function () 
{
    // Show loader
    $('#loader-overlay').show();
    $('#loader').show();           // Show spinner
    
    // Submit the form after showing the loader
    $('#request-form').submit();
});

// Hide loader on modal close
$('#paymentModal').on('hidden.bs.modal', function () {
    $('#loader-overlay').hide();
    $('#loader').hide(); 
});

    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/student/register_student.blade.php ENDPATH**/ ?>