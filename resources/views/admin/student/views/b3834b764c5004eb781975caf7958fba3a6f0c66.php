<?php $__env->startSection('title', 'Upcoming Renewals - Last 2 Subscriptions'); ?>

<?php $__env->startSection('content'); ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="row">
                <div class="col-lg-12">

                    <div class="card shadow-sm">
                       <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Renewal Report<!-- – Last 2 Subscription Details --></h5>
                            </div>

        <div class="card-body">
            <form method="GET" action="<?php echo e(route('report.renewal_report')); ?>" id="filterForm">
                <div class="row g-3">

                    
                    <div class="col-md-4">
                        <label class="form-label">Search by Batch</label>
                        <select name="batch" id="batch" class="form-control">
                            <option value="">Select Batch</option>
                            <?php $__currentLoopData = $batchdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($b->batch_id); ?>" 
                                    <?php echo e(request('batch') == $b->batch_id ? 'selected' : ''); ?>>
                                    <?php echo e($b->batch_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label">Search by Student Name</label>
                        <input type="text" 
                               name="search" 
                               id="search"
                               placeholder="Enter student name"
                               value="<?php echo e(request('search')); ?>"
                               class="form-control">
                    </div>

                    
                    <div class="col-md-4 d-flex align-items-end">
                        <div>
                            <button type="submit" class="btn btn-primary me-2">Search</button>

                            <a href="<?php echo e(route('report.renewal_report')); ?>" 
                               class="btn btn-secondary">
                                Reset
                            </a>
                        </div>
                    </div>

                </div>
            </form>
        </div>


                        <div class="card-body">

                            <?php
                                $grouped = $Student->groupBy('student_id');
                            ?>

                            <?php $__empty_1 = true; $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student_id => $records): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                
                                <?php
                                    $stu = $records->first();
                                ?>

                                <div class="border rounded p-3 mb-4">

                                    <h5 class="text-primary mb-2">
                                        <?php echo e($stu->student_first_name); ?> <?php echo e($stu->student_last_name); ?>

                                    </h5>

                                    <div class="row mb-3">
                                        <!-- <div class="col-md-3"><strong>ID:</strong> <?php echo e($stu->student_id); ?></div> -->
                                        <div class="col-md-3"><strong>Mobile:</strong> <?php echo e($stu->mobile); ?></div>
                                        <div class="col-md-3"><strong>Email:</strong> <?php echo e($stu->email); ?></div>
                                        <div class="col-md-3"><strong>Age:</strong> <?php echo e($stu->categoryName ?? '-'); ?></div>
                                        <div class="col-md-3"><strong>Batch:</strong> <?php echo e($stu->batch_name ?? '-'); ?></div>
                                    </div>

                                    
                                    <table class=" table table-bordered table-striped table-hover datatable">
                                        <thead class="text-center">
                                            <tr>
                                                <!-- <th>Subscription ID</th> -->
                                                <th>Plan</th>
                                                <th>Batch</th>
                                                <th>Subscription Date</th>
                                                <th>Payment Date</th>
                                                <th>Payment Mode</th>
                                                <th>Total Sessions</th>
                                                <th>Amount</th>
                                                <th>Used Session</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">

                                            <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <!-- <td><span class="badge bg-info"><?php echo e($sub->subscription_id); ?></span></td> -->

                                                    <td><?php echo e($sub->plan_name); ?></td>
                                                    <td><?php echo e($sub->batch_name); ?></td>

                                                    <td><?php echo e(date('d-m-Y', strtotime($sub->activate_date))); ?></td>
                                                    <td>
                                                        <?php echo e($sub->payment_date ? date('d-m-Y', strtotime($sub->payment_date)) : '-'); ?>

                                                    </td>
                                                    <td><?php echo e($sub->payment_mode ?? '-'); ?></td>


                                                    <td><?php echo e($sub->total_session); ?></td>

                                                    <td>₹<?php echo e(number_format($sub->amount)); ?></td>

                                                    <td>
                                                        <?php
                                                            $balance = $sub->debit_balance;
                                                        ?>

                                                        <?php if($balance > 0): ?>
                                                            <span class="badge bg-danger"><?php echo e($balance); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-success">0</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>

                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-center text-muted">No renewal data found.</p>
                            <?php endif; ?>

                            
                            <div class="mt-3">
                                <?php echo e($Student->appends(request()->query())->links()); ?>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/report/renewal_report.blade.php ENDPATH**/ ?>