<?php $__env->startSection('title', 'Student Renew Plan'); ?>

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

                                <h5 class="card-title mb-0">Student Renew Plan



                                </h5>

                                

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

                                                            <th> Category Name </th>  

                                                            <th> Plan Name </th>  

                                                            <th> Batch Name </th>  

                                                            <th> Amount </th>  
                                                            <th> Renew Request Date </th>  

                                                            <th> Status </th>  

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
                                                                    <?php echo e(date('d-m-Y',strtotime($sdata->created_at)) ?? '-'); ?>

                                                                </td>

                                                                <td>
                                                                    <?php if($sdata->status == 0): ?>
                                                                    <?php echo e('Pending'); ?>

                                                                    <?php elseif($sdata->status == 1): ?>
                                                                    <?php echo e('Accepted'); ?>

                                                                    <?php else: ?>
                                                                    <?php echo e('Rejected'); ?>

                                                                    <?php endif; ?>
                                                                </td>

                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit"
                                                                            href="<?php echo e(route('renewPlan.edit_renew_student', $sdata->renewplan_id)); ?>">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>

                                                                        <a class="mx-1" title="Edit Status" href="#" 
                                                                            data-bs-toggle="modal" data-bs-target="#editModal_<?php echo e($sdata->renewplan_id); ?>">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                <div class="modal fade flip" id="editModal_<?php echo e($sdata->renewplan_id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">

                                                        <div class="modal-header bg-light p-3">

                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>

                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"

                                                                id="close-modal"></button>

                                                        </div>

                                                        <form method="POST" action="<?php echo e(route('renewPlan.updatestatus')); ?>" autocomplete="off"

                                                            enctype="multipart/form-data">

                                                            <?php echo csrf_field(); ?>

                                                            <input type="hidden" name="renewplan_id" id="renewplan_id" value="<?php echo e($sdata->renewplan_id); ?>">



                                                            <div class="modal-body">
                                                                    <div class="payment-section" id="payment_section_<?php echo e($sdata->renewplan_id); ?>" style="display: none;">
                                                                <div class="mb-3">

                                                                        <span style="color:red;">*</span>Payment Date

                                                                        <input type="date" name="payment_date" class="form-control" value="<?php echo e(date('Y-m-d')); ?>">

                                                                    </div>
                                                                    <div class="mb-3">

                                                                        <span style="color:red;">*</span>Status

                                                                        <select class="form-control" name="payment_mode" id="Editpayment_mode">
                                                                        <?php $__currentLoopData = $paymentmode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($p->id); ?>" <?php echo e($p->type == $sdata->payment_mode ? 'selected' : ''); ?>><?php echo e($p->type); ?></option>

                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select >

                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">

                                                                    <span style="color:red;">*</span>Status

                                                                    <select class="form-control status-dropdown" name="status" id="Editreview_status" data-id="<?php echo e($sdata->renewplan_id); ?>">

                                                                        <option value="0" <?php echo e($sdata['status'] == 0 ? 'selected' : ''); ?>>Pending</option>

                                                                        <option value="1" <?php echo e($sdata['status'] == 1 ? 'selected' : ''); ?>>Accepted</option>

                                                                        <option value="2" <?php echo e($sdata['status'] == 2 ? 'selected' : ''); ?>>Rejected</option>

                                                                    </select >

                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">

                                                                <div class="hstack gap-2 justify-content-end">

                                                                    <button type="submit" class="btn btn-primary mx-2" id="add-btn">Update</button>

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

        function myFunction() 

        {

            $('#search').removeAttr('value');

            $('#batch').val('');

        }

$(document).ready(function () {

    // On page load — handle each modal
    $('.status-dropdown').each(function () {
        togglePaymentFields($(this));
    });

    // When status changes
    $('.status-dropdown').on('change', function () {
        togglePaymentFields($(this));
    });

    function togglePaymentFields(elem) {
        let id = elem.data('id');
        let val = elem.val();
        let section = $("#payment_section_" + id);

        if (val == "1") {
            section.show();   // Accepted
        } else {
            section.hide();   // Pending or Rejected
        }
    }
});

    </script>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/renew_plan/renew_student_plan.blade.php ENDPATH**/ ?>