<?php $__env->startSection('content'); ?>
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Events</h2>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>
                        </li>
                        <li>Events</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
<section class="event-area bg-ffffff pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span>Events</span>
                    <!-- <h2>Summer Camps</h2> -->
                </div>

                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="event-box-item">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="event-image">
                                <a href="<?php echo e(asset($e->image ? 'Events/' . $e->image : 'images/noImage.png')); ?>"><img src="<?php echo e(asset($e->image ? 'Events/' . $e->image : 'images/noImage.png')); ?>" alt="image"></a>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="event-content">
                                <h2>
                                    <a href="<?php echo e(route('FrontEventsDetail',$e->event_id)); ?>">
                                    <?php echo e($e->categoryName); ?></a>
                                </h2>
                                <h3>
                                    <a href="<?php echo e(route('FrontEventsDetail',$e->event_id)); ?>">
                                    <?php echo e($e->event_name); ?></a>
                                </h3>
                                <ul class="event-list">
                                    <li>
                                        <i class="bx bx-time"></i>
                                        <?php echo e(date('h:i a',strtotime($e->from_time))); ?> - <?php echo e(date('h:i a',strtotime($e->to_time)) ?? '-'); ?>

                                    </li>
                                    <li>
                                        <i class="bx bxs-map"></i>
                                        <?php echo e($e->location); ?>

                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="event-date">
                                <h4><?php echo e(date('d',strtotime($e->from_date))); ?></h4>
                                <span><?php echo e(date('F',strtotime($e->from_date))); ?></span>
                            </div>
                            <div class="class-btn" style="float: right;padding: 10px 70px;">
                                   <a href="<?php echo e(route('FrontEventsDetail',$e->event_id)); ?>" class="default-btn btn" style="border:none;"> Details</a>
                               </div>

                        </div>
                    </div>
                </div>

               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/events.blade.php ENDPATH**/ ?>