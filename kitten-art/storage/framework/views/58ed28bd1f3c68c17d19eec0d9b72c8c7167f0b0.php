<?php $__env->startSection('content'); ?>
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Gallery</h2>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>
                        </li>
                        <li>Gallery</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
        <div class="gallery-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-gallery-box">
                            <img src="<?php echo e(asset($g->image ? 'Gallery/' . $g->image : 'images/noImage.png')); ?>" alt="image">
    
                            <a href="<?php echo e(asset($g->image ? 'Gallery/' . $g->image : 'images/noImage.png')); ?>" class="gallery-btn" data-imagelightbox="popup-btn">
                                <i class="bx bx-search-alt"></i>
                            </a>
                        </div>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- <div class="view-btn">
                    <a href="#" class="default-btn">View More</a>
                </div> -->
            </div>
        </div>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/gallery.blade.php ENDPATH**/ ?>