<?php $__env->startSection('title', 'View Student Details'); ?>



<?php $__env->startSection('content'); ?>



      <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">



                

                <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-header">

                                <h5 class="card-title mb-0">Student Details

                                    <a href="<?php echo e(url()->previous()); ?>" style="float: right;" class="btn btn-sm btn-primary">

                                        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back

                                    </a>



                                </h5>

                                

                            </div>

                             <div class="row">

                                <div class="col-lg-12">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="table-responsive">

                                                <table class=" table table-bordered table-striped table-hover datatable">

                                                        <tr>

                                                            <th>

                                                                Student Name

                                                            </th>

                                                            <th>

                                                               Student Age

                                                            </th>

                                                            <th>

                                                               Mobile

                                                            </th>

                                                            <th>

                                                               Email

                                                            </th>

                                                            <th>

                                                               Parent Name

                                                            </th>

                                                            <th>

                                                               Login Id

                                                            </th>

                                                            <th>

                                                               Communication Mode

                                                            </th>

                                                        </tr>

                                                        <tr>

                                                            <td>
                                                                    <?php echo e($data->student_first_name ?? ''); ?> <?php echo e($data->student_last_name ?? ''); ?>

                                                                </td>

                                                            <td> <?php echo e($data->student_age); ?></td>

                                                            <td> <?php echo e($data->mobile); ?></td>

                                                            <td> <?php echo e($data->email); ?></td>

                                                            <td> <?php echo e($data->parent_name); ?></td>

                                                            <td> <?php echo e($data->login_id); ?></td>

                                                            <td>

                                                                <?php if($data->communication_mode == 1): ?>

                                                                    <?php echo e('Whats App'); ?>


                                                                <?php elseif($data->communication_mode == 2): ?>

                                                                 <?php echo e('Email'); ?>


                                                                <?php elseif($data->communication_mode == 3): ?>

                                                                 <?php echo e('Text SMS'); ?>


                                                                <?php endif; ?>



                                                            </td>

                                                        </tr>



                                                    </tbody>

                                                </table>

                                               <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><?php echo e($sub->planName); ?></h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4"><strong>Plan Amount:</strong> <?php echo e($sub->planAmount); ?></div>
                <div class="col-md-4"><strong>Total Sessions:</strong> <?php echo e($sub->total_session); ?></div>
                <div class="col-md-4"><strong>Used Sessions:</strong> <?php echo e($sub->debit_balance); ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><strong>Remaining Sessions:</strong> <?php echo e($sub->total_session-$sub->debit_balance); ?></div>
                <div class="col-md-4"><strong>Activation Date:</strong> <?php echo e(date('d-m-Y', strtotime($sub->activate_date))); ?></div>
                <div class="col-md-4"><strong>Batch Name:</strong> <?php echo e($sub->batchName); ?></div>
            </div>
        </div>
    </div>

    
    <h6 class="mt-3">Student Attendance Details</h6>
    <table class="table table-bordered table-striped table-hover datatable">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Batch Name</th>
                <th>Day</th>
                <th>Attendance</th>
                <th>Attendance Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $sub->attendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($a->categoryName); ?></td>
                    <td><?php echo e($a->batchName); ?></td>
                    <td>
                        <?php
                            $daysOfWeek = [1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thursday',5=>'Friday',6=>'Saturday',7=>'Sunday'];
                        ?>
                        <?php echo e($daysOfWeek[$a->day] ?? 'Invalid Day'); ?>

                    </td>
                    <td><?php echo e($a->attendance); ?></td>
                    <td><?php echo e(date('d-m-Y', strtotime($a->attendance_date))); ?></td>
                    <td>
                        <?php if($loop->first && $sub->status == 1): ?> 
                            <a title="Change Attendance Status" href="#"  
                               data-bs-toggle="modal" 
                               data-bs-target="#attendanceModal_<?php echo e($a->attendence_id); ?>" 
                               onclick="attendanceData(<?php echo e($a->attendence_id); ?>);" 
                               class="mx-2">
                               <i class="fas fa-edit"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>

                
                <div class="modal fade flip" id="attendanceModal_<?php echo e($a->attendence_id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Attendance</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="<?php echo e(route('attendance.edit')); ?>" autocomplete="off"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="attendence_id" value="<?php echo e($a->attendence_id); ?>">
                                <input type="hidden" name="subscription_id" value="<?php echo e($a->subscription_id); ?>">

                                <div class="modal-body text-center">
                                    <h4>Are you sure?</h4>
                                    <p class="text-muted">
                                        You want to update attendance from 
                                        <?php if($a->attendance == 'P'): ?> 
                                            <input type="hidden" name="status" value="A">
                                            <strong>Present</strong> to <strong>Absent</strong>?
                                        <?php elseif($a->attendance == 'A'): ?> 
                                            <input type="hidden" name="status" value="P">
                                            <strong>Absent</strong> to <strong>Present</strong>?
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">No attendance records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/student/active_student_view.blade.php ENDPATH**/ ?>