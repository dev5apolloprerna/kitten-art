<?php $__env->startSection('content'); ?>

<!-- Start Page Banner -->

<div class="page-banner-area item-bg4">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-banner-content">

                    <h2>Service</h2>

                    <ul>

                        <li>

                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>

                        </li>

                        <li>Service</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Page Banner -->



<section class="class-area bg-fdf6ed pt-100 pb-70">

      <div class="container">

        <div class="section-title">

          <span>Service</span>

          <h2>Our Service</h2>

        </div>

        <div class="row">

        

        </div>

        <div class="row">

          <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <div class="col-lg-4 col-md-6">

            <div class="single-class">

              <div class="class-image">

                <a href="<?php echo e(route('FrontServiceImages',$data->service_id)); ?>">

                  <img src="<?php echo e(asset($data['image'] ? 'Service/' . $data['image'] : 'images/noImage.png')); ?>" alt="image">

                </a>

              </div>

              <div class="class-content">

                <h3>

                  <a href="#"><?php echo e($data->service_name); ?> </a>

                </h3>



                <ul class="class-list"><li><h4><?php echo e($data->plan_name); ?></h4></li></ul>

                <p>

                  <?php echo Str::limit($data->description, 200, '....'); ?>


                </p>

                

                <div class="class-btn">

                       <a href="<?php echo e(route('FrontServiceImages',$data->service_id)); ?>" class="default-btn btn" style="border:none;"> Details</a>

                </div>

              </div>

            </div>

          </div>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

      </div>

    </section>











<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/service.blade.php ENDPATH**/ ?>