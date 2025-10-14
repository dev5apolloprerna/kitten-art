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

                                    <a href="<?php echo e(route('student.index')); ?>" style="float: right;" class="btn btn-sm btn-primary">

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

                                                                Category Name

                                                            </th>

                                                            <td>

                                                                <?php echo e($data->categoryName ?? ''); ?>


                                                            </td>

                                                        </tr>

                                                       

                                                        <tr>

                                                            <th>

                                                                Student Name

                                                            </th>

                                                            <td>

                                                                <?php echo e($data->student_first_name ?? ''); ?> <?php echo e($data->student_last_name ?? ''); ?>


                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Student Age

                                                            </th>

                                                            <td> <?php echo e($data->student_age); ?></td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Mobile

                                                            </th>

                                                            <td> <?php echo e($data->mobile); ?></td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Email

                                                            </th>

                                                            <td> <?php echo e($data->email); ?></td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Parent Name

                                                            </th>

                                                            <td> <?php echo e($data->parent_name); ?></td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Plan Name

                                                            </th>

                                                            <td> <?php echo e($data->planName); ?></td>

                                                        </tr>

                                                       

                                                    </tbody>

                                                </table>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/trial_class/show.blade.php ENDPATH**/ ?>