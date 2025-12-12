<div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th width="50"> Sr No </th>
                                                            <th> Student Name </th>  
                                                            <th> Student Age </th>  
                                                            <th> Age Group </th>  
                                                            <th> Plan Name </th>  
                                                            <th> Total Session </th>  
                                                            <th> Used Session </th>  
                                                            <th> Available Session </th>  
                                                            <th> Status </th>  
                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                     <?php if(count($Student) > 0): ?>

                                                    <?php $i = 1;
                                                    $dbalance=0;

                                                    ?>

                                                        <?php $__currentLoopData = $Student; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php 
                                                            $dbalance=$sdata->totalUsedSessions;
                                                        $usedsession = min($sdata->planSession, $dbalance);

                                                        $remainingSession = $sdata->planSession - $usedsession;

                                                        $dbalance -= $usedsession; // Deduct used sessions from balance

                                                

                                                        // If dbalance goes negative, show the remaining session correctly

                                                        if ($dbalance < 0) {

                                                            $remainingSession = $dbalance;

                                                        }
                                                        ?>

                                                            <tr data-entry-id="<?php echo e($sdata->student_id); ?>" class="text-center">
                                                                <td>
                                                                    <?php echo e($i + $Student->perPage() * ($Student->currentPage() - 1)); ?>

                                                                </td>
                                                                <td>
                                                                <?php echo e($sdata->student_first_name ?? ''); ?> <?php echo e($sdata->student_last_name ?? ''); ?>

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
                                                                    <?php echo e($sdata->planSession ?? '0'); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->totalUsedSessions ?? '-'); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($remainingSession ?? '-'); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->attendance); ?>

                                                                </td>
                                                                
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                         <tr>
                                                            <td colspan="9">
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
                                              

                                                    <!--end modal -->
                                                </div>
                                            </div>

                                        </div><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/report/ajax_attendance.blade.php ENDPATH**/ ?>